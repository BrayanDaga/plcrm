<template>
  <div>
    <section>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Payments</div>
            <div class="card-body">
              <div class="demo-spacing-0">This table lists all the Promolider Payments</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section v-if="!loading">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="data-table-list-payments" class="table table-hover-animation">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>User</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Operation Number</th>
                  <th>Date of Purchase</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tempPayment in payments" :key="tempPayment.id">
                  <td>{{ tempPayment.id_user_membreship }}</td>
                  <td>{{ tempPayment.id_user_membreship }}</td>
                  <td>{{ tempPayment.description }}</td>
                  <td>{{ tempPayment.amount }}</td>
                  <td>{{ tempPayment.id_payment_method }}</td>
                  <td>{{ tempPayment.operation_number }}</td>
                  <td>{{ tempPayment.created_at | formatDate }}</td>
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
import apiPayment from '../../api/api.payment';
import CustomSpinner from '../../common/custom-spinner/CustomSpinner';

export default {
  name: 'Payment',
  components: { CustomSpinner },
  data: () => ({
    payments: [],
    loading: false,
  }),
  /*  mounted() {
    this.listPayments();
  },*/
  methods: {
    loadDatatable() {
      this.$nextTick(function () {
        $('#data-table-list-payments').DataTable();
      });
    },
    listPayments() {
      this.loading = true;
      apiPayment.list().then((response) => {
        this.loading = false;
        this.payments = response.data;
        this.loadDatatable();
      });
    },
  },
  mounted() {
    this.listPayments();
  },
};
</script>

<style lang="css" scoped></style>
