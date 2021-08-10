<template>
  <div>
    <custom-delete-modal
      @confirm-delete="confirmDeleteAdvertisement"
      :advertisement="selectAdvertisement"
    ></custom-delete-modal>

    <!-- Alert With Icon start -->
    <section v-if="totalMessages" id="alerts-with-icons">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="demo-spacing-0">
                <div
                  class="alert"
                  :class="
                    totalMessages <= 5
                      ? 'alert-primary'
                      : totalMessages > 5 && totalMessages <= 8
                      ? 'alert-info'
                      : 'alert-danger'
                  "
                  role="alert"
                >
                  <div class="alert-body">
                    <i data-feather="star"></i>
                    <span> Total Messages {{ totalMessages }}/10 </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Alert With Icon end -->
    <section class="basic-textarea">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                {{ editMode ? 'Edit Advertisement' : 'Add Advertisement' }}
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="text-area-message">Message :</label>
                    <textarea
                      ref="message-advertisement"
                      v-model="form.message"
                      class="form-control"
                      id="text-area-message"
                      rows="3"
                      placeholder="Add Message"
                      :class="rules ? '' : 'is-invalid'"
                    />
                    <div class="invalid-feedback" v-if="!rules">This field is required</div>
                  </div>
                </div>
                <div class="col-sm-9 offset-sm-8">
                  <button
                    @click.prevent="submit()"
                    type="reset"
                    class="btn btn-primary mr-1"
                    :disabled="loading"
                  >
                    <span
                      class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"
                      v-if="loading"
                    ></span>
                    <span class="ml-25 align-middle">
                      {{ editMode ? 'Edit' : 'Add' }}
                    </span>
                  </button>
                  <button @click.prevent="resetForm" type="reset" class="btn btn-outline-secondary">
                    Reset
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Advertisement</h4>
            </div>
            <div class="card-body">
              <div class="demo-spacing-0">This table lists all the Promolider Advertisements</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section v-if="!initialLoading">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table
              id="data-table-list-payments"
              class="table table-hover-animation table-striped table-bordered"
            >
              <thead>
                <tr>
                  <th>Nro</th>
                  <th>Message</th>
                  <th>Create</th>
                  <th>Status</th>
                  <th>Actions</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(tempAdvertisement, index) in advertisements"
                  :key="tempAdvertisement.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td style="width: 360px">{{ tempAdvertisement.message }}</td>
                  <td>{{ tempAdvertisement.created_at | formatDate }}</td>
                  <td>
                    <div :class="tempAdvertisement.status === '1' ? 'text-danger' : 'text-success'">
                      {{ tempAdvertisement.status === '1' ? 'Disable' : 'Enable' }}
                    </div>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn round"
                      @click="deleteAdvertisement(tempAdvertisement.id)"
                      data-toggle="modal"
                      data-target="#delete-modal"
                      :class="
                        tempAdvertisement.status === '0'
                          ? 'btn-outline-danger'
                          : 'btn-outline-success'
                      "
                    >
                      {{ tempAdvertisement.status === '0' ? 'Disable' : 'Activate' }}
                    </button>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-outline-secondary round"
                      @click.prevent="editAdvertisement(tempAdvertisement.id)"
                    >
                      Edit
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <custom-spinner v-else></custom-spinner>

  </div>
</template>

<script>
import apiAdvertisement from '../../../api/api.advertisement';
import CustomSpinner from '../../../common/custom-spinner/CustomSpinner.vue';
import CustomDeleteModal from './components/CustomDeleteModal';

const formAdvertisement = {
  id: null,
  message: '',
  state: '',
  created_at: null,
};

export default {
  components: { CustomSpinner, CustomDeleteModal },
  mounted() {
    this.listAdvertisements();
  },
  data() {
    return {
      rules: true,
      totalMessages: null,
      form: { ...formAdvertisement },
      selectAdvertisement: {},
      editMode: false,
      initialLoading: false,
      loading: false,
      advertisements: [],
    };
  },
  methods: {
    loadDataTable() {
      this.$nextTick(function () {
        $('#data-table-list-payments').DataTable();
      });
    },
    submit() {
      if (this.form.message === '') {
        this.rules = false;
        this.$refs['message-advertisement'].focus();
        return;
      }

      if (this.totalMessages === 10 && !this.editMode) {
        this.showToast('error', 'Sorry you have reached the limit to add ads');
        return;
      }

      this.rules = true;
      this.loading = true;
      const advertisement = {
        id: this.form.id,
        message: this.form.message,
      };
      if (advertisement.id && this.editMode) {
        apiAdvertisement.edit(advertisement).then((response) => {
          this.successfully(response, true);
          this.showToast('success', `Advertisement was successfully Updated`);
        });
      } else {
        apiAdvertisement.add(advertisement).then((response) => {
          this.successfully(response, false);
          this.showToast('success', `Advertisement was successfully Added`);
        });
      }
    },
    deleteAdvertisement(id) {
      if (id) {
        this.selectAdvertisement = this.advertisements.find(
          (tempAdvertisement) => tempAdvertisement.id === id
        );
      }
    },
    confirmDeleteAdvertisement(confirm, status) {
      if (confirm) {
        const message = status === '1' ? 'Disable' : 'Activate';
        this.listAdvertisements();
        this.resetForm();
        this.showToast('success', `Advertisement was successfully ${message}`);
      }
    },
    editAdvertisement(id) {
      if (id) {
        this.editMode = true;
        this.form = this.advertisements.find((tempAdvertisement) => tempAdvertisement.id === id);
        this.$refs['message-advertisement'].focus();
      }
    },
    listAdvertisements() {
      this.initialLoading = true;
      apiAdvertisement.list().then((response) => {
        this.initialLoading = false;
        this.advertisements = response.data;
        this.totalMessages = this.advertisements.length;
        this.loadDataTable();
      });
    },
    successfully(response, edit) {
      this.selectAdvertisement = response.data;
      this.selectAdvertisement.isEdit = edit;
      this.loading = false;
      // $('#success-modal').modal('show');
      this.listAdvertisements();
      this.resetForm();
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type.toUpperCase()}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false,
      });
    },
    resetForm() {
      this.form = { ...formAdvertisement };
      this.editMode = false;
      this.rules = true;
    },
  },
  name: 'Advertisement',
};
</script>

<style lang="scss" scoped></style>
