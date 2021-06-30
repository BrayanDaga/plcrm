<template>
  <div>
    <custom-delete-modal
      @confirm-delete="confirmDeletePaymentMethod"
      :payment-method="selectPaymentMethod"
    ></custom-delete-modal>
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
                        />
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
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn btn-outline-secondary round"
                        @click.prevent="editPaymentMethod(tempPaymentMethod.id)"
                      >
                        Edit
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-danger round"
                        @click="deletePaymentMethod(tempPaymentMethod.id)"
                        data-toggle="modal"
                        data-target="#delete-modal"
                      >
                        Delete
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-info round"
                        @click="detailBank(tempPaymentMethod.id)"
                      >
                        Detail
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

const formPaymentMethod = {
  id: null,
  name: '',
};
export default {
  components: { CustomDeleteModal, CustomSpinner },
  mounted() {
    this.listPaymentMethods();
  },
  data() {
    return {
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
    },
    deletePaymentMethod(id) {
      this.selectPaymentMethod = this.paymentMethods.find(
        (tempPaymentMethod) => tempPaymentMethod.id === id
      );
    },
    confirmDeletePaymentMethod(confirm) {
      if (confirm) {
        this.reload();
      }
    },
    detailBank(id) {
      /*this.loading = true;*/
      /*apiPaymentMethod.detail(id).then(response => {
          this.loading = false;
      });*/
    },
    submit() {
      this.loading = true;
      const paymentMethod = {
        id: this.form.id,
        name: this.form.name,
      };
      if (paymentMethod.id && this.editMode) {
        apiPaymentMethod.edit(paymentMethod).then(() => {
          this.loading = false;
          this.reload();
        });
      } else {
        apiPaymentMethod.add(paymentMethod).then(() => {
          this.loading = false;
          this.reload();
        });
      }
    },
    reload() {
      this.listPaymentMethods();
      this.resetForm();
    },
  },
  name: 'PaymentMethod',
};
</script>

<style scoped></style>
