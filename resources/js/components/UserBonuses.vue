<template>
  <div class="col-xl-8 col-md-6 col-12">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title">Statistics</h4>
        <div class="d-flex align-items-center">
          <p class="card-te xt font-small-2 mr-25 mb-0">Updated 1 month ago</p>
        </div>
      </div>
      <div class="card-body statistics-body">
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="media">
              <div class="avatar bg-light-primary mr-2">
                <div class="avatar-content">
                  <i data-feather="trending-up" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Growth Bonus</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="media">
              <div class="avatar bg-light-info mr-2">
                <div class="avatar-content">
                  <i data-feather="user" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Start Bonus</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
            <div class="media">
              <div class="avatar bg-light-danger mr-2">
                <div class="avatar-content">
                  <i data-feather="box" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">{{ bonuses.fast_cash_bonus }}</h4>
                <p class="card-text font-small-3 mb-0">Fast Cash Bonus</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
            <div class="media">
              <div class="avatar bg-light-danger mr-2">
                <div class="avatar-content">
                  <i data-feather="box" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Residual Marketing Bonus</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="media">
              <div class="avatar bg-light-success mr-2">
                <div class="avatar-content">
                  <i data-feather="dollar-sign" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Marketing Bonus</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../api/api';
export default {
  name: 'UserBonuses',
  data() {
    return {
      bonuses: {
        fast_cash_bonus: 0,
        start_bonus: 0,
        marketing_bonus: 0,
        residual_marketing_bonus: 0,
        growth_bonus: 0,
      },
    };
  },
  mounted() {
    this.get_bonuses();
  },

  methods: {
    get_bonuses() {
      api.get(`/users/get-bonuses`).then((response) => {
        this.bonuses = response.data;
      });
    },
  },
};
</script>

<style>
</style>