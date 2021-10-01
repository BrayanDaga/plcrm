<template>
  <div>
    <table id="datatable" class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Name</th>
          <th>Subcription Date</th>
          <th>Account Type</th>
          <th>Request</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in dataUsers" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.user }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.created_at | formatDate }}</td>
          <td>{{ user.account_type.account }}</td>
          <td>
            <span
              class="badge"
              :class="
                user.request == 1
                  ? 'badge-warning'
                  : user.request == 2
                  ? 'badge-success'
                  : 'badge-danger'
              "
              v-text="user.request == 1 ? 'Pending ' : user.request == 2 ? 'Accepted' : 'Rejected'"
            ></span>
          </td>
          <td><button class="btn btn-info" @click="modalUser(user.id)">Ver Detalles</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Modal View Request -->
    <div class="modal fade" id="modalViewRequest" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">User Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <p><strong>User</strong> {{ dataUser.user }}</p>
            </div>
            <div class="form-group">
              <p><strong>Sponsor</strong> {{ sponsor.user }}</p>
            </div>
            <div class="form-group">
              <p><strong>Total Amount</strong> {{ payments.amount }}</p>
            </div>
            <div class="form-group">
              <p><strong>Type Document</strong> {{ typeDocuments.document }}</p>
            </div>
            <div class="form-group">
              <p><strong>Nro Document</strong> {{ dataUser.nro_document }}</p>
            </div>
            <div class="form-group">
              <p><strong>Method Payment</strong> {{ paymentMethod.name }}</p>
            </div>
          </div>
          <div class="modal-footer">
            <div v-if="dataUser.request == 1">
              <button
                v-if="dataUser.request != 3"
                type="button"
                class="btn btn-danger"
                @click="approveDeny(dataUser.id, 3)"
              >
                Deny
              </button>
              <button
                v-if="dataUser.request != 2"
                type="button"
                class="btn btn-primary"
                @click="approveDeny(dataUser.id, 2)"
              >
                Approve
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import api from '../../api/api';
export default {
  data() {
    return {
      initialLoading: true,
      dataUsers: [],
      dataUser: [],
      sponsor: Object,
      payments: [],
      typeDocuments: [],
      paymentMethod: [],
    };
  },
  mounted() {
    this.listUsers();
  },
  methods: {
    modalUser(id) {
      $('#modalViewRequest').modal('show');
      axios.get(`user-request/get-user-by-id/${id}`).then((r) => {
        this.dataUser = r.data;
        this.sponsor = this.dataUser.sponsor;
        this.payments = this.dataUser.payments;
        this.typeDocuments = this.dataUser.document_type;
        this.paymentMethod = this.dataUser.payments.payment_method;
      });
    },
    approveDeny(id, status) {
      const form = {
        id: id,
        status: status,
      };

      axios.post(`user-request/update-request`, form).then((r) => {
        if (r.data.response == 200) {
          alert('Request accepted!');
          $('#modalViewRequest').modal('hide');
          this.initialLoading = false;
          this.listUsers();
        } else {
          alert('Rejected request!');
          $('#modalViewRequest').modal('hide');
          this.initialLoading = false;
          this.listUsers();
        }
      });
    },
    loadDataTable() {
      this.$nextTick(function () {
        $('#datatable').DataTable({
          responsive: true,
          processing: true,
          destroy: true,
          select: false,
        });
      });
    },
    listUsers() {
      this.initialLoading = true;
      api.get(`user-request/list`).then((response) => {
        this.initialLoading = false;
        this.dataUsers = response.data;
        $('#datatable').DataTable().destroy();
        this.loadDataTable();
      });
    },
  },
};
</script>