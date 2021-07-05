<template>
  <div>
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
                      class="form-control"
                      id="text-area-message"
                      rows="3"
                      placeholder="Add Message"
                    ></textarea>
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

    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                {{ editMode ? 'Edit Advertisement' : 'Add Advertisement' }}
              </h4>
            </div>
            <div class="card-body">
              <form class="form">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label">
                        <label for="bank-name"> Message </label>
                      </div>
                      <div class="col-sm-9">
                        <textarea
                          v-model="form.message"
                          id="bank-name"
                          class="form-control"
                          name="name"
                          placeholder="Advertisement"
                          autocomplete="false"
                          ref="message-advertisement"
                          :class="rules ? '' : 'is-invalid'"
                        />
                        <div class="invalid-feedback" v-if="!rules">This field is required</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-9 offset-sm-3">
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
                    <button
                      @click.prevent="resetForm"
                      type="reset"
                      class="btn btn-outline-secondary"
                    >
                      Reset
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="row" id="basic-table">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Advertisement</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider Advertisements</div>
          </div>

          <div class="table-responsive">
            <table class="table">
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
              <tbody v-if="!initialLoading">
                <tr
                  v-for="(tempAdvertisement, index) in advertisements"
                  :key="tempAdvertisement.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td style="width: 360px">{{ tempAdvertisement.message }}</td>
                  <td>{{ tempAdvertisement.created_at | formatDate }}</td>
                  <td>
                    <div :class="tempAdvertisement.status === '1' ? 'text-danger' : 'text-success'">
                      {{ tempAdvertisement.status === '1' ? 'Disabled' : 'Enable' }}
                    </div>
                  </td>
                  <td>
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn round"
                        @click="deleteBank(tempAdvertisement.id)"
                        :class="
                          tempAdvertisement.status === '0'
                            ? 'btn-outline-danger'
                            : 'btn-outline-success'
                        "
                      >
                        {{ tempAdvertisement.status === '0' ? 'Desactivate' : 'Activate' }}
                      </button>
                    </div>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-outline-secondary round"
                      @click.prevent="editBank(tempAdvertisement.id)"
                    >
                      Edit
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="m-10" v-if="initialLoading">
              <custom-spinner></custom-spinner>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiAdvertisement from '../../../api/api.advertisement';
import CustomSpinner from '../../../common/custom-spinner/CustomSpinner.vue';

const formAdvertisement = {
  id: null,
  message: '',
  state: '',
  created_at: null
};

export default {
  components: { CustomSpinner },
  mounted() {
    this.listAdverstisment();
  },
  data() {
    return {
      rules: true,
      form: { ...formAdvertisement },
      editMode: false,
      initialLoading: false,
      loading: false,
      advertisements: []
    };
  },
  methods: {
    submit() {},
    listAdverstisment() {
      this.initialLoading = true;
      apiAdvertisement.list().then(response => {
        this.initialLoading = false;
        this.advertisements = response.data;
      });
    }
  },
  name: 'Advertisement'
};
</script>

<style lang="scss" scoped></style>
