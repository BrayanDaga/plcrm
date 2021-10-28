<template>
  <div>
    <custom-delete-modal
      @confirm-delete="confirmDeleteAccountType"
      :account-type="selectAccountType"
    ></custom-delete-modal>
    <custom-success-modal :account-type="selectAccountType"></custom-success-modal>
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Account Type</h4>
            </div>
            <div class="card-body">
              <form class="form">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="account"> Account </label>
                      <input
                        v-model="form.account"
                        type="text"
                        id="account"
                        class="form-control"
                        name="account"
                        placeholder="Account"
                        autocomplete="false"
                        ref="account-account-type"
                        :class="errors.hasOwnProperty('account') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('account')">
                        {{ errors.account[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="price"> Price</label>
                      <input
                        type="text"
                        id="price"
                        class="form-control"
                        name="price"
                        placeholder="Price"
                        autocomplete="false"
                        ref="price-account-type"
                        v-model="form.price"
                        :class="errors.hasOwnProperty('price') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('price')">
                        {{ errors.price[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="comission"> Comissionable </label>
                      <input
                        type="text"
                        id="comissiona"
                        class="form-control"
                        name="comission"
                        placeholder="comissionable (optional)"
                        autocomplete="false"
                        ref="comission-account-type"
                        v-model="form.comission"
                        :class="errors.hasOwnProperty('comission') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('comission')">
                        {{ errors.comission[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="iva"> Iva</label>
                      <input
                        type="text"
                        id="iva"
                        class="form-control"
                        name="iva"
                        placeholder="iva(optional)"
                        autocomplete="false"
                        ref="iva-account-type"
                        v-model="form.iva"
                        :class="errors.hasOwnProperty('iva') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('iva')">
                        {{ errors.iva[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="pay_in_binary">Disc on purchases</label>
                      <input
                        type="text"
                        id="pay_in_binary"
                        class="form-control"
                        name="pay_in_binary"
                        placeholder="Discount on EJ purchase: 20 (20% without the symbol)"
                        autocomplete="false"
                        ref="pay_in_binary-account-type"
                        v-model="form.pay_in_binary"
                        :class="errors.hasOwnProperty('pay_in_binary') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('pay_in_binary')">
                        {{ errors.pay_in_binary[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="disc_purchases">% in binary cut</label>
                      <input
                        type="text"
                        id="disc_purchases"
                        class="form-control"
                        name="disc_purchases"
                        placeholder="% in binary cut EJ: 15 (15% without the symbol)"
                        autocomplete="false"
                        ref="disc_purchases-account-type"
                        v-model="form.disc_purchases"
                        :class="errors.hasOwnProperty('disc_purchases') ? 'is-invalid' : ''"
                      />
                      <div class="invalid-feedback" v-if="errors.hasOwnProperty('disc_purchases')">
                        {{ errors.disc_purchases[0] }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="profit_on_purchases">Gain on Purchases</label>
                      <input
                        type="text"
                        id="profit_on_purchases"
                        class="form-control"
                        name="profit_on_purchases"
                        placeholder="% Profit on Purchases"
                        autocomplete="false"
                        ref="profit_on_purchases-account-type"
                        v-model="form.profit_on_purchases"
                        :class="errors.hasOwnProperty('profit_on_purchases') ? 'is-invalid' : ''"
                      />
                      <div
                        class="invalid-feedback"
                        v-if="errors.hasOwnProperty('profit_on_purchases')"
                      >
                        {{ errors.profit_on_purchases[0] }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="fast_cash_bonus">Gain on 2nd Generation Purchases</label>
                      <input
                        type="text"
                        id="profit_on_purchases_2"
                        class="form-control"
                        name="profit_on_purchases_2"
                        placeholder="% Gain on 2nd Generation Purchases"
                        autocomplete="false"
                        ref="profit_on_purchases_2-account-type"
                        v-model="form.profit_on_purchases_2"
                        :class="errors.hasOwnProperty('profit_on_purchases_2') ? 'is-invalid' : ''"
                      />
                      <div
                        class="invalid-feedback"
                        v-if="errors.hasOwnProperty('profit_on_purchases_2')"
                      >
                        {{ errors.profit_on_purchases_2[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="fast_cash_bonus">Fast cash bonus</label>
                      <input
                        type="text"
                        id="fast_cash_bonus"
                        class="form-control"
                        name="fast_cash_bonus"
                        placeholder="% Gain on 2nd Generation Purchases"
                        autocomplete="false"
                        ref="fast_cash_bonus-account-type"
                        v-model="form.fast_cash_bonus"
                        :class="errors.hasOwnProperty('fast_cash_bonus') ? 'is-invalid' : ''"
                      />
                      <div
                        class="invalid-feedback"
                        v-if="errors.hasOwnProperty('fast_cash_bonus')"
                      >
                        {{ errors.fast_cash_bonus[0] }}
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
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

    <div class="row" id="table-small">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Account Types</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider Account Types</div>
          </div>

          <div class="table-responsive">
            <table class="table-hover table-striped table-bordered"  id="datatable">
              <thead>
                <tr>
                  <th>Nro</th>
                  <th>Account</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Iva</th>
                  <th>% Discount on purchases</th>
                  <th>payment in binary cut%</th>
                  <th>Gain on Purchases</th>
                  <th>% Gain on 2nd Generation Purchases</th>
                  <th>% Fast Cash Bonus</th>
                  <th>Commission</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody v-if="!initialLoading">
                <tr v-for="accountType in accountTypes" :key="accountType.id">
                  <td>{{ accountType.id }}</td>
                  <td>{{ accountType.account }}</td>
                  <td>{{ accountType.price }}</td>
                  <td>
                    <div :class="accountType.status === '0' ? 'text-danger' : 'text-success'">
                      {{ accountType.status === '0' ? 'Deleted' : 'Activate' }}
                    </div>
                  </td>

                  <td>{{ accountType.iva }}</td>
                  <td>{{ accountType.disc_purchases }}</td>
                  <td>{{ accountType.pay_in_binary }}</td>
                  <td>{{ accountType.profit_on_purchases }}</td>
                  <td>{{ accountType.profit_on_purchases_2 }}</td>
                  <td>{{ accountType.fast_cash_bonus }}</td>
                  <td>{{ accountType.comission }}</td>

                  <td>
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn round btn-sm"
                        @click="deleteAccountType(accountType.id)"
                        data-toggle="modal"
                        data-target="#delete-modal"
                        :class="
                          accountType.status === '1' ? 'btn-outline-danger' : 'btn-outline-success'
                        "
                      >
                        {{ accountType.status === '1' ? 'Delete' : 'Activate' }}
                      </button>

                      <button
                        type="button"
                        class="btn btn-outline-secondary btn-sm round"
                        @click.prevent="editAccountType(accountType.id)"
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
import apiAccountType from '../../../api/api.account-type';
import CustomSpinner from '../../../common/custom-spinner/CustomSpinner';
import CustomDeleteModal from './components/CustomDeleteModal';
import CustomSuccessModal from './components/CustomSuccessModal';
const formAccountType = {
  id: null,
  account: '',
  price: 0,
  iva: 0,
  disc_purchases: 0,
  pay_in_binary: 0,
  profit_on_purchases: 0,
  profit_on_purchases_2: 0,
  fast_cash_bonus: 0,
  comission: 0,
  state: '',
};

export default {
  components: { CustomSuccessModal, CustomDeleteModal, CustomSpinner },
  data() {
    return {
      form: { ...formAccountType },
      selectAccountType: {},
      initialLoading: true,
      loading: false,
      accountTypes: [],
      editMode: false,
      errors: {},
    };
  },
  mounted: function () {
    this.listAccountTypes();
  },
  methods: {
    datatable() {
      this.$nextTick(function () {
        $('#datatable').DataTable();
      });
    },
    resetForm() {
      this.form = { ...formAccountType };
      this.editMode = false;
      this.errors = {};
    },
    errorsMessage(err) {
      if (err.response.data.hasOwnProperty('errors')) {
        const errors = err.response.data.errors;
        this.errors = errors;

        if (this.errors.account) {
          this.$refs['account-account-type'].focus();
          return;
        }
        if (this.errors.price) {
          this.$refs['price-account-type'].focus();
          return;
        }

        if (this.errors.comission) {
          this.$refs['comission-account-type'].focus();
          return;
        }

        if (this.errors.pay_in_binary) {
          this.$refs['pay_in_binary-account-type'].focus();
          return;
        }
        if (this.errors.disc_purchases) {
          this.$refs['disc_purchases-account-type'].focus();
          return;
        }
        if (this.errors.profit_on_purchases) {
          this.$refs['profit_on_purchases-account-type'].focus();
          return;
        }
        if (this.errors.profit_on_purchases_2) {
          this.$refs['profit_on_purchases_2-account-type'].focus();
          return;
        } 
        
        if (this.errors.fats_cash_bonus) {
          this.$refs['fats_cash_bonus-account-type'].focus();
          return;
        }
      }
    },
    submit() {
      this.errors = {};

      this.loading = true;
      const accountType = {
        id: this.form.id,
        account: this.form.account,
        price: this.form.price,
        iva: this.form.iva,
        disc_purchases: this.form.disc_purchases,
        pay_in_binary: this.form.pay_in_binary,
        profit_on_purchases: this.form.profit_on_purchases,
        profit_on_purchases_2: this.form.profit_on_purchases_2,
        fast_cash_bonus: this.form.fast_cash_bonus,
        comission: this.form.comission,
      };
      if (accountType.id && this.editMode) {
        apiAccountType
          .edit(accountType)
          .then((response) => {
           $('#datatable').DataTable().destroy();
            this.listAccountTypes();
            this.successfully(response, true);
            this.showToast(
              'success',
              `Account Type method ${response.data.name} was successfully Updated`
            );
          })
          .catch((err) => {
            console.log(err.response.data.errors);

            this.errorsMessage(err);
          })
          .finally(() => {
            this.loading = false;
          });
      } else {
        apiAccountType
          .add(accountType)
          .then((response) => {
            $('#datatable').DataTable().destroy();
            this.listAccountTypes();
            this.successfully(response, false);
            this.showToast(
              'success',
              `Account type ${response.data.account} was successfully Added`
            );
          })
          .catch((err) => {
            console.log(err.response.data.errors);
            this.errorsMessage(err);
          })
          .finally(() => {
            this.loading = false;
          });
      }
    },
    editAccountType(id) {
      this.errors = {};
      this.editMode = true;
      this.form = this.accountTypes.find((accountType) => accountType.id === id);
      this.$refs['account-account-type'].focus();
    },
    deleteAccountType(id) {
      this.selectAccountType = this.accountTypes.find((AccountType) => AccountType.id === id);
    },
    listAccountTypes() {
      this.initialLoading = true;
      apiAccountType.list().then((response) => {
        this.initialLoading = false;
        this.accountTypes = response.data;
        this.datatable();
      });
    },
    confirmDeleteAccountType(confirm, status) {
      if (confirm) {
        const message = status === '0' ? 'Deleted' : 'Activated';
        $('#datatable').DataTable().destroy();
        this.listAccountTypes();
        this.resetForm();
        this.showToast('success', `Account type was successfully ${message}`);
      }
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false,
      });
    },
    successfully(response, edit) {
      this.selectAccountType = response.data;
      this.selectAccountType.isEdit = edit;
      this.loading = false;
      this.listAccountTypes();
      this.resetForm();
    },
    changePage: function () {
      this.listAccountTypes();
    },
  },
  name: 'AccountType',
};
</script>

<style scoped></style>
