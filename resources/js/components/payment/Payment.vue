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
            <table
              id="data-table-list-payments"
              class="table table-hover-animation table-striped table-bordered"
            >
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
                  <td height="30px">
                    {{
                      tempPayment.user_membreship.name + ' ' + tempPayment.user_membreship.last_name
                    }}
                  </td>
                  <td height="30px">{{ tempPayment.user_membreship.user }}</td>
                  <td height="30px">{{ tempPayment.description }}</td>
                  <td height="30px">{{ tempPayment.amount }}</td>
                  <td height="30px">{{ tempPayment.payment_method.name }}</td>
                  <td height="30px">{{ tempPayment.operation_number }}</td>
                  <td height="30px">{{ tempPayment.created_at | formatDate }}</td>
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
    loadDataTable() {
      this.$nextTick(function () {
        $('#data-table-list-payments').DataTable();
      });
    },
    listPayments() {
      this.loading = true;
      apiPayment.list().then((response) => {
        this.loading = false;
        this.payments = response.data;
        this.loadDataTable();
      });
    },
  },
  mounted() {
    this.listPayments();
  },
};
</script>

<style lang="css" scoped></style>
