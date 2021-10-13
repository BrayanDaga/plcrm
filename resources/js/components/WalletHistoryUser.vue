<template>
  <div>
    <h3>Wallet for {{ username }}</h3>
    <div class="table-responsive" v-if="!initialLoading">
      <table class="table table-bordered" id="example">
        <thead>
          <tr>
            <td>Amount</td>
            <td>reason</td>
            <td>Date</td>
          </tr>
        </thead>

        <tbody>
          <tr v-for="wallet in wallets" :key="wallet.id">
            <td>
              <span
                class="font-weight-bolder"
                :class="wallet.amount < 0 ? 'text-danger' : 'text-success'"
                v-text="wallet.amount > 0 ? '+' + wallet.amount : wallet.amount"
              >
              </span>
            </td>
            <td>{{ wallet.reason }}</td>
            <td>{{ wallet.created_at | formatDate }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  name: 'WalletHistoryUser',
  props: {
    username: {
      type: String,
      required: true,
    },
  },
  
  data() {
    return {
      wallets: [],
      initialLoading: false,
    };
  },
  mounted() {
    this.listWallets();
  },
  methods: {
    listWallets() {
      this.initialLoading = true;
      api.get(`/reports/mywalletinfo/${this.username}`).then((response) => {
        this.initialLoading = false;
        this.wallets = response.data;
        $('#example').DataTable().destroy();
        this.loadDataTable();
      });
    },
    loadDataTable() {
      this.$nextTick(function () {
        $('#example').DataTable({
          responsive: true,
          processing: true,
        });
      });
    },
  },
};
</script>

<style>
</style>