<template>
  <div>
    <custom-delete-modal
      @confirm-delete="confirmDeletePaymentMethod"
      :payment-method="selectPaymentMethod"
    ></custom-delete-modal>
    <custom-success-modal :payment-method="selectPaymentMethod"></custom-success-modal>
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                {{ editMode ? 'Edit Payment Method' : 'Add Payment Method' }}
              </h4>
            </div>
            <div class="card-body">
              <form class="form form-horizontal">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label">
                        <label for="bank-name"> Payment Method Name </label>
                      </div>
                      <div class="col-sm-9">
                        <input
                          v-model="form.name"
                          type="text"
                          id="bank-name"
                          class="form-control"
                          name="name"
                          placeholder="Payment Method"
                          autocomplete="false"
                          ref="name-payment-method"
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
            <h4 class="card-title">Payment Methods</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider Payment Methods</div>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nro</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody v-if="!initialLoading">
                <tr
                  v-for="(tempPaymentMethod, index) in paymentMethods"
                  :key="tempPaymentMethod.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td style="width: 220px">{{ tempPaymentMethod.name }}</td>
                  <td>
                    <div :class="tempPaymentMethod.status === '1' ? 'text-danger' : 'text-success'">
                      {{ tempPaymentMethod.status === '1' ? 'Delete' : 'Activate' }}
                    </div>
                  </td>
                  <td>
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn round"
                        @click="deletePaymentMethod(tempPaymentMethod.id)"
                        data-toggle="modal"
                        data-target="#delete-modal"
                        :class="
                          tempPaymentMethod.status === '0'
                            ? 'btn-outline-danger'
                            : 'btn-outline-success'
                        "
                      >
                        {{ tempPaymentMethod.status === '0' ? 'Delete' : 'Activate' }}
                      </button>

                      <button
                        type="button"
                        class="btn btn-outline-secondary round"
                        @click.prevent="editPaymentMethod(tempPaymentMethod.id)"
                      >
                        Edit
                      </button>
                    </div>
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
import apiPaymentMethod from '../../../api/api.payment-method';
import CustomSpinner from '../../../common/custom-spinner/CustomSpinner';
import CustomDeleteModal from './components/CustomDeleteModal';
import CustomSuccessModal from './components/CustomSuccessModal';

const formPaymentMethod = {
  id: null,
  name: '',
  state: '',
};
export default {
  components: { CustomSuccessModal, CustomDeleteModal, CustomSpinner },
  mounted() {
    this.listPaymentMethods();
  },
  data() {
    return {
      rules: true,
      selectPaymentMethod: {},
      initialLoading: true,
      loading: false,
      paymentMethods: [],
      form: { ...formPaymentMethod },
      editMode: false,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
    };
  },
  methods: {
    resetForm() {
      this.form = { ...formPaymentMethod };
      this.editMode = false;
      this.rules = true;
    },
    listPaymentMethods() {
      this.initialLoading = true;
      apiPaymentMethod.list().then((response) => {
        this.initialLoading = false;
        this.paymentMethods = response.data;

        /*Agregando al date pagination*/
        this.pagination = response.meta;
        delete this.pagination.links;
        delete this.pagination.path;
      });
    },
    editPaymentMethod(id) {
      this.editMode = true;
      this.form = this.paymentMethods.find((tempPaymentMethod) => tempPaymentMethod.id === id);
      this.$refs['name-payment-method'].focus();
    },
    deletePaymentMethod(id) {
      this.selectPaymentMethod = this.paymentMethods.find(
        (tempPaymentMethod) => tempPaymentMethod.id === id
      );
    },
    confirmDeletePaymentMethod(confirm, status) {
      if (confirm) {
        const message = status === '1' ? 'Deleted' : 'Activated';
        this.listPaymentMethods();
        this.resetForm();
        this.showToast('success', `Payment method was successfully ${message}`);
      }
    },
    /*    detailBank(id) {
      /!*this.loading = true;*!/
      /!*apiPaymentMethod.detail(id).then(response => {
          this.loading = false;
      });*!/
    },*/
    submit() {
      if (this.form.name === '') {
        this.rules = false;
        this.$refs['name-payment-method'].focus();
        return;
      }
      this.rules = true;

      this.loading = true;
      const paymentMethod = {
        id: this.form.id,
        name: this.form.name,
      };
      if (paymentMethod.id && this.editMode) {
        apiPaymentMethod.edit(paymentMethod).then((response) => {
          this.successfully(response, true);
          this.showToast(
            'success',
            `Payment method ${response.data.name} was successfully Updated`
          );
        });
      } else {
        apiPaymentMethod.add(paymentMethod).then((response) => {
          this.successfully(response, false);
          this.showToast('success', `Payment method ${response.data.name} was successfully Added`);
        });
      }
    },
    successfully(response, edit) {
      this.selectPaymentMethod = response.data;
      this.selectPaymentMethod.isEdit = edit;
      this.loading = false;
      // $('#success-modal').modal('show');
      this.listPaymentMethods();
      this.resetForm();
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false,
      });
    },
  },
  name: 'PaymentMethod',
};
</script>

<style scoped></style>
