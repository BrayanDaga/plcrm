<template>
  <div>
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">{{ editMode ? 'Edit Bank' : 'Add Bank' }}</h4>
            </div>
            <div class="card-body">
              <form class="form form-horizontal">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label">
                        <label for="bank-name"> Bank Name </label>
                      </div>
                      <div class="col-sm-9">
                        <input
                          v-model="form.name"
                          type="text"
                          id="bank-name"
                          class="form-control"
                          name="name"
                          placeholder="Bank Name"
                          ref="name-bank"
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

    <section>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Bank</h4>
            </div>
            <div class="card-body">
              <div class="demo-spacing-0">This table lists all the Promolider banks</div>
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
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(tempBank, index) in banks" :key="tempBank.id">
                  <td>{{ index + 1 }}</td>
                  <td style="width: 220px">{{ tempBank.name }}</td>
                  <td>
                    <div class="row">
                      <div class="demo-inline-spacing">
                        <button
                          type="button"
                          class="btn btn-outline-secondary round"
                          @click.prevent="editBank(tempBank.id)"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-outline-danger round"
                          @click="deleteBank(tempBank.id)"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <custom-spinner v-else></custom-spinner>

<!--    <div class="row" id="basic-table">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">BANK</h4>
          </div>
          <div class="card-body">
            <div class="card-text">This table lists all the Promolider banks</div>
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
                <tr v-for="(tempBank, index) in banks" :key="tempBank.id">
                  <td>{{ index + 1 }}</td>
                  <td style="width: 220px">{{ tempBank.name }}</td>
                  <td>
                    <div class="demo-inline-spacing">
                      <button
                        type="button"
                        class="btn btn-outline-secondary round"
                        @click.prevent="editBank(tempBank.id)"
                      >
                        Edit
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-danger round"
                        @click="deleteBank(tempBank.id)"
                      >
                        Delete
                      </button>
                      &lt;!&ndash;                      <button
                        type="button"
                        class="btn btn-outline-info round"
                        @click="detailBank(tempBank.id)"
                      >
                        Detail
                      </button>&ndash;&gt;
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
    </div>-->
  </div>
</template>

<script>
import apiBank from '../../../api/api.bank';
import CustomSpinner from '../../../common/custom-spinner/CustomSpinner';

const formBank = {
  id: null,
  name: '',
};
export default {
  components: { CustomSpinner },
  mounted() {
    this.listBanks();
  },
  data() {
    return {
      rules: true,
      initialLoading: true,
      loading: false,
      loadingDelete: false,
      banks: [],
      form: { ...formBank },
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
    loadDataTable() {
      this.$nextTick(function () {
        $('#data-table-list-payments').DataTable();
      });
    },
    resetForm() {
      this.form = { ...formBank };
      this.editMode = false;
    },
    listBanks() {
      this.initialLoading = true;
      apiBank.list().then((response) => {
        this.initialLoading = false;
        this.banks = response.data;
        this.loadDataTable();
      });
    },
    editBank(id) {
      this.editMode = true;
      this.form = this.banks.find((tempBank) => tempBank.id === id);
      this.$refs['name-bank'].focus();
    },
    deleteBank(id) {
      this.loadingDelete = true;
      apiBank.delete(id).then(() => {
        this.loadingDelete = false;
        this.listBanks();
      });
    },
    /*        detailBank(id) {
            /!*this.loading = true;*!/
            /!*apiBank.detail(id).then(response => {
                this.loading = false;
            });*!/
        },*/
    submit() {
      if (this.form.name === '') {
        this.rules = false;
        this.$refs['name-bank'].focus();
        return;
      }
      this.rules = true;
      this.loading = true;
      const bank = {
        id: this.form.id,
        name: this.form.name,
      };
      if (bank.id && this.editMode) {
        apiBank.edit(bank).then(() => {
          this.loading = false;
          this.listBanks();
          this.resetForm();
        });
      } else {
        apiBank.add(bank).then(() => {
          this.loading = false;
          this.listBanks();
          this.resetForm();
        });
      }
    },
  },
  name: 'Bank',
};
</script>

<style scoped></style>
