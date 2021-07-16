<template>
  <div>
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add {{ title }}</h4>
            </div>
            <div class="card-body">
              <form class="form form-horizontal">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label">
                        <label for="bank-name"> Price bonus </label>
                      </div>
                      <div class="col-sm-9">
                        <input
                          v-model="form.price"
                          type="text"
                          id="price"
                          class="form-control"
                          name="price"
                          placeholder="Price"
                          autocomplete="false"
                          ref="price"
                         :class="errors.hasOwnProperty('price') ? 'is-invalid' : ''"
                        />
                         <div class="invalid-feedback" v-if="errors.hasOwnProperty('price')">
                        {{ errors.price[0] }}
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-9 offset-sm-3">
                    <button
                      @click.prevent="add()"
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
                      <span class="ml-25 align-middle">Add
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
            <h4 class="card-title">{{ title }}</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider {{ title }}</div>
          </div>

          <div class="table-responsive">
            <table class="table" id="datatable">
              <thead>
                <tr>
                  <th>Nro</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody v-if="!initialLoading">
                <tr v-for="bonus in bonuses" :key="bonus.id">
                  <td>{{ bonus.id }}</td>
                  <td>{{ bonus.price }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn round btn-sm btn-outline-danger"
                      data-toggle="modal"
                      data-target="#delete-modal"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiGrowthBonus from '../../../api/api.growth-bonus';

const formBonus = {
  id: null,
  price: 0,
};


export default {
  name: 'GrowthBonus',

    props: {
    title: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
       form: { ...formBonus },
      selectBonus: {},
      initialLoading: true,
      loading: false,
      bonuses: [],
      errors: {},
    editMode: false,

    };
  },
  mounted: function () {
    this.listBonus();
  },
  methods: {
    datatable() {
      this.$nextTick(function () {
        $('#datatable').DataTable();
      });
    },
    listBonus() {
      this.initialLoading = true;
      apiGrowthBonus.list().then((response) => {
        this.initialLoading = false;
        this.bonuses = response.data;
        this.datatable();
      });
    },
    resetForm() {
      this.form = { ...formBonus };
      this.editMode = false;
      this.errors = {};
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false,
      });
    },
    successfully(response, edit) {
      this.selectBonus = response.data;
      this.selectBonus.isEdit = edit;
      this.loading = false;
      this.listBonus();
      this.resetForm();
    },
     errorsMessage(err) {
      if (err.response.data.hasOwnProperty('errors')) {
        const errors = err.response.data.errors;
        this.errors = errors;
        if (this.errors.price) {
          this.$refs['price'].focus();
          return;
        }
      }
    },
    add() {
     this.errors = {};
      this.loading = true;

      const bonus = {
        id: this.form.id,
        price: this.form.price,
      };
      
        apiGrowthBonus
          .add(bonus)
          .then((response) => {
            $('#datatable').DataTable().destroy();
            this.listBonus();
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
    },
    
    
  },
};
</script>

<style scoped></style>
