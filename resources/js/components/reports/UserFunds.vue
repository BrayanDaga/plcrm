<template>
  <section>
    <div class="row" id="basic-table">
      <div class="col-12">
        <div class="card" v-if="!loading">
          <div class="card-header">
            <h4 class="card-title">$ Users' Wallet Funds</h4>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" >
              <thead class="thead-dark">
                <tr>
                  <th>UserMembreship</th>
                  <th>Amount available</th>
                </tr>
              </thead>
              <tbody v-if="!loading">
                <tr v-for="wallet in wallets" :key="wallet.id">
                  <td>{{ wallet.user_membreship }}</td>
                  <td> <span class="text-primary font-weight-bold">$ {{ wallet.amount }}</span></td>
                </tr>
              </tbody>
              <div class="text-center mt-5" v-if="loading">
                <div class="spinner-border text-primary" role="status">
                  <span class="sr-only">Loading..</span>
                </div>
              </div>
            </table>

            <div class="card-footer">
              <h4 class="d-inline">Total: </h4>
              <h3 class="mb-75 mt-2 pt-50 d-inline"><a href="javascript:void(0);">$ {{ total}}</a></h3>
            </div>
          </div>
        </div>
          <custom-spinner v-else></custom-spinner>

      </div>
    </div>
  </section>
</template>

<script>
import api from '../../api/api';
import CustomSpinner from '../../common/custom-spinner/CustomSpinner';

export default {
  components: { CustomSpinner },
  data() {
    return {
      wallets: [],
      loading: true,
    };
  },
  mounted() {
    this.getWallets();
  },
  methods: {
    getWallets() {
      api
        .get('/wallet/wallets')
        .then((response) => {
          this.wallets = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },

  computed: {
    total() {
      let total = 0;
      this.wallets.forEach((wallet) => {
        total += wallet.amount;
      });
      return total;
    },
  },
};
</script>

<style>
</style>