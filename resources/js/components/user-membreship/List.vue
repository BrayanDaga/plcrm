<template>
  <div>
    <section>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">User List</h4>
            </div>
            <div class="card-body">
              <div class="demo-spacing-0">This table lists all the Promolider User List</div>
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
                  <th>Name</th>
                  <th>Position</th>
                  <th>Sponsor</th>
                  <th>Document Type</th>
                  <th>Account Type</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>Enrollment date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tempUsers in this.usersMembreship" v-bind:key="tempUsers.id">
                  <td>
                    <p style="width: 220px">
                      {{ tempUsers.name + ' ' + tempUsers.last_name }}
                    </p>
                  </td>
                  <td>
                    {{ tempUsers.position === '1' ? 'Izquierda' : 'Derecha' }}
                  </td>
                  <td>{{ tempUsers.binary_sponsor }}</td>
                  <td>{{ tempUsers.document_type.document }}</td>
                  <td>{{ tempUsers.account_type.account }}</td>
                  <td>{{ tempUsers.phone }}</td>
                  <td>{{ tempUsers.email }}</td>
                  <td>{{ tempUsers.country.name }}</td>
                  <td>{{ tempUsers.created_at | formatDate }}</td>
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
import apiUserMembreship from '../../api/api.user-membreship';
import CustomSpinner from '../../common/custom-spinner/CustomSpinner';

export default {
  components: { CustomSpinner },
  created() {
    this.getUsersMembreship();
  },
  data() {
    return {
      initialLoading: false,
      usersMembreship: [],
    };
  },
  mounted() {
    this.getUsersMembreship();
  },
  methods: {
    loadDataTable() {
      this.$nextTick(function () {
        $('#data-table-list-payments').DataTable();
      });
    },
    getUsersMembreship: function () {
      this.initialLoading = true;
      apiUserMembreship.listUserMembreship().then((response) => {
        this.usersMembreship = response.data;
        this.initialLoading = false;
        this.loadDataTable();
      });
    },
  },
  name: 'List',
};
</script>

<style scoped></style>
