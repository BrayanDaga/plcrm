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
              <h4 class="card-title">
                Add Account Type
              </h4>
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
                            :class="rules ? '' : 'is-invalid'"
                        />
                   <div class="invalid-feedback" v-if="!rules">This field is required</div>

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
                          :class="rules ? '' : 'is-invalid'"
                        />
                    <div class="invalid-feedback" v-if="!rules">This field is required</div>

                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                        <label for="comissionable"> Comissionable </label>  
                        <input
                          type="text"
                          id="comissionable"
                          class="form-control"
                          name="comissionable"
                          placeholder="comissionable (optional)"
                          autocomplete="false"
                          ref="comissionable-account-type"
                          v-model="form.comission"
                        />             
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
                        />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                        <label for="pay_in_binary">Discount on purchases</label>
                 <input
                          type="text"
                          id="pay_in_binary"
                          class="form-control"
                          name="pay_in_binary"
                          placeholder="Discount on EJ purchase: 20 (20% without the symbol)"
                          autocomplete="false"
                          ref="pay_in_binary-account-type"
                          v-model="form.pay_in_binary"
                        />
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
                        />
                </div>
              </div>

              <div class="col-md-6 col-12">
                <div class="form-group">
                        <label for="disc_purchases">Gain on Purchases</label>
                   <input
                          type="text"
                          id="disc_purchases"
                          class="form-control"
                          name="disc_purchases"
                          placeholder="% Profit on Purchases"
                          autocomplete="false"
                          ref="disc_purchases-account-type"
                          v-model="form.profit_on_purchases"
                        />
                </div>
              </div>

              <div class="col-md-6 col-12">
                <div class="form-group">
                        <label for="disc_purchases">Gain on 2nd Generation Purchases</label>
 <input
                          type="text"
                          id="disc_purchases"
                          class="form-control"
                          name="disc_purchases"
                          placeholder="% Gain on 2nd Generation Purchases"
                          autocomplete="false"
                          ref="disc_purchases-account-type"
                          v-model="form.profit_on_purchases_2"
                        />
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
                    </button>              </div>
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
            <h4 class="card-title">Account Types</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider Account Types</div>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th >Nro</th>
                  <th>Account</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Iva</th>
                  <th>Discount on purchases%</th>
                  <th>payment in binary cut%</th>
                  <th>Gain on Purchases</th>
                  <th>% Gain on 2nd Generation Purchases</th>
                  <th>Commissionable</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody v-if="!initialLoading">
                <tr
                  v-for="(accountType, index) in accountTypes"
                  :key="accountType.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ accountType.account }}</td>
                  <td> {{ accountType.price }}  </td>
                    <td>
                    <div :class="accountType.status === '1' ? 'text-danger' : 'text-success'">
                      {{ accountType.status === '1' ? 'Deleted' : 'Activate' }}
                    </div>
                <td> {{ accountType.iva }}  </td>
                <td> {{ accountType.disc_purchases }}  </td>
                <td> {{ accountType.pay_in_binary }}  </td>
                <td> {{ accountType.profit_on_purchases }}  </td>
                <td> {{ accountType.profit_on_purchases_2 }}  </td>
                <td> {{ accountType.comission }}  </td>

                  <td>
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn round btn-sm"
                        @click="deleteAccountType(accountType.id)"
                        data-toggle="modal"
                        data-target="#delete-modal"
                        :class="
                          accountType.status === '0'
                            ? 'btn-outline-danger'
                            : 'btn-outline-success'
                        "
                      >
                        {{ accountType.status === '0' ? 'Delete' : 'Activate' }}
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
  price:0,
  iva:0,
  disc_purchases:0,
  pay_in_binary:0,
  profit_on_purchases: 0,
  profit_on_purchases_2: 0,
  comission: 0,
  state: ''
};
export default {
  components: { CustomSuccessModal, CustomDeleteModal, CustomSpinner },
  data(){
      return {
      rules: true,
      form: { ...formAccountType },
      selectAccountType: {},
      initialLoading: true,
      loading: false,
      accountTypes : [],
      editMode: false,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      }
    };
  },
  created() {
      this.listAccountTypes();
  },
  methods: {
    resetForm() {
      this.form = { ...formAccountType };
      this.editMode = false;
      this.rules = true;
    },
    submit() {
      if (this.form.account === '') {
        this.rules = false;
        this.$refs['account-account-type'].focus();
        return;
      }
      if (this.form.price < 0 ) {
        this.rules = false;
        this.$refs['price-account-type'].focus();
        return;
      }
      this.rules = true;

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
        comission: this.form.comission,
      };
       if (accountType.id && this.editMode) {
         apiAccountType.edit(accountType).then(response => {
           this.successfully(response, true);
           this.showToast(
             'success',
             `Account Type method ${response.data.name} was successfully Updated`
           );
         });
       } 
       else{
         apiAccountType.add(accountType).then(response => {
          this.successfully(response, false);
          this.showToast('success', `Account type ${response.data.account} was successfully Added`);
        });
       }
        
      
    },
    editAccountType(id) {
      this.editMode = true;
      this.form = this.accountTypes.find(accountType => accountType.id === id);
      this.$refs['account-account-type'].focus();
    },
     deleteAccountType(id) {
      this.selectAccountType = this.accountTypes.find(
        AccountType => AccountType.id === id
      );
    },
      listAccountTypes() {
      this.initialLoading = true;
      apiAccountType.list().then(response => {
        this.initialLoading = false;
        this.accountTypes = response.data;

        /*Agregando al date pagination*/
        this.pagination = response.meta;
        delete this.pagination.links;
        delete this.pagination.path;
      });
    },
    confirmDeleteAccountType(confirm, status) {
      if (confirm) {
        const message = status === '1' ? 'Deleted' : 'Activated';
        this.listAccountTypes();
        this.resetForm();
        this.showToast('success', `Account type was successfully ${message}`);
      }
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false
      });
    },
     successfully(response, edit) {
      this.selectAccountType = response.data;
      this.selectAccountType.isEdit = edit;
      this.loading = false;
      // $('#success-modal').modal('show');
      this.listAccountTypes();
      this.resetForm();
    },
  
  },
  name: 'AccountType'
};
</script>

<style scoped></style>
