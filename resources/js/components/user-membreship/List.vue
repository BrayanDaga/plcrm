<template>
  <div>
    <custom-spinner v-if="initialLoading"></custom-spinner>
    <div v-if="!initialLoading">
      <div class="row" id="basic-table">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">User List</h4>
            </div>
            <div class="card-body">
              <div class="card-text">
                <div id="account-details" class="active">
                  <form novalidate="novalidate">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="form-label"> Search: </label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button
                              type="button"
                              class="btn btn-outline-primary waves-effect"
                              @click="getUsersMembreship"
                            >
                              <i data-feather="search"></i>
                            </button>
                          </div>
                          <input
                            v-model="searchName"
                            type="text"
                            placeholder="Button on both side"
                            aria-label="Amount"
                            class="form-control"
                          />
                          <div class="input-group-append">
                            <button
                              type="button"
                              class="btn btn-outline-primary waves-effect"
                              @click="getUsersMembreship"
                            >
                              Search !
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-5">
                        <label for="order-by" class="form-label"> Order by: </label>
                        <select
                          v-model="orderBy"
                          class="custom-select"
                          id="order-by"
                          @change="getUsersMembreship"
                        >
                          <option
                            v-for="(item, index) in orderObject.orderName"
                            :value="orderObject.orderBy[index]"
                            :selected="index === 0"
                            :key="index"
                          >
                            {{ item }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Posicion</th>
                    <th>Patrocinador</th>
                    <th>Tipo de Documento</th>
                    <th>Tipo de Cuenta</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Pais</th>
                    <th>Fecha de inscripcion</th>
                  </tr>
                </thead>
                <tbody v-if="usersMembreship.length > 0">
                  <tr v-for="tempUsers in this.usersMembreship" v-bind:key="tempUsers.id">
                    <td>
                      <p style="width: 220px">
                        {{ tempUsers.name }}
                      </p>
                    </td>

                    <td>
                      {{ tempUsers.position === '1' ? 'Izquierda' : 'Derecha' }}
                    </td>
                    <td>{{ tempUsers.referrer_sponsor }}</td>
                    <td>{{ tempUsers.document_type.document }}</td>
                    <td>{{ tempUsers.account_type.account }}</td>
                    <td>{{ tempUsers.phone }}</td>
                    <td>{{ tempUsers.email }}</td>
                    <td>{{ tempUsers.country.name }}</td>
                    <td>{{ tempUsers.created_at | formatDate }}</td>
                  </tr>
                </tbody>
              </table>
              <div
                v-if="usersMembreship.length === 0"
                role="alert"
                class="alert alert-warning text-center m-5"
              >
                <h1 class="alert-heading">No results found</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-xl-4 col-lg-12">
                  <div class="form-group row mt-1">
                    <div class="col-sm-7 col-form-label">
                      <label for="items-for-page"> Items for page: </label>
                    </div>
                    <div class="col-sm-5">
                      <select
                        v-model="pageSize"
                        id="items-for-page"
                        class="custom-select"
                        @change="getUsersMembreship"
                      >
                        <option
                          v-for="(item, index) in itemForPage"
                          :value="item"
                          :selected="index === 0"
                          :key="index"
                        >
                          {{ item }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-2">
                      <li v-if="pagination.current_page > 1" class="page-item prev-item">
                        <a
                          href="#"
                          @click.prevent="changePage(pagination.current_page - 1)"
                          class="page-link"
                        ></a>
                      </li>
                      <template v-for="(page, index) in pagesNumber">
                        <li
                          class="page-item"
                          v-bind:class="[page === isActive && 'active']"
                          :key="index"
                        >
                          <a href="#" class="page-link" @click.prevent="changePage(page)">
                            {{ page }}
                          </a>
                        </li>
                      </template>
                      <li
                        v-if="pagination.current_page < pagination.last_page"
                        class="page-item next-item"
                      >
                        <a
                          href="#"
                          @click.prevent="changePage(pagination.current_page + 1)"
                          class="page-link"
                        ></a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <div class="col-xl-4 col-lg-12"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiUserMembreship from '../../api/api.user-membreship';
import CustomSpinner from '../../common/custom-spinner/CustomSpinner';

export default {
  components: { CustomSpinner },
  created() {
    this.getUsersMembreship();
  },
  data() {
    return {
      searchName: '',
      orderObject: {
        orderName: ['Fecha de subscripcion', 'Nombre', 'Tipo de Documento'],
        orderBy: ['created_at', 'name', 'id_document_type'],
      },
      orderBy: 'created_at',
      itemForPage: [5, 10, 15],
      pageSize: 5,
      initialLoading: true,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 2,
      usersMembreship: [],
    };
  },
  computed: {
    isActive: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      let to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      const pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    getUsersMembreship: function (page) {
      const params = {
        search: this.searchName,
        pageSize: this.pageSize,
        order: this.orderBy,
        page: page,
      };
      this.initialLoading = true;
      apiUserMembreship.listUserMembreship(params).then((response) => {
        this.usersMembreship = response.result.data;
        this.pagination = response.pagination;
        this.initialLoading = false;
      });
    },
    changePage: function (page) {
      this.pagination.current_page = page;
      this.getUsersMembreship(page);
    },
  },
  name: 'List',
};
</script>

<style scoped></style>
