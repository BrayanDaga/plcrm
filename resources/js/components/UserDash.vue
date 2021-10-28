<template>
  <div>
    <adjust-leg></adjust-leg>
    <user-status :user="user"></user-status> 
  </div>
</template>

<script>
import api from '../api/api';
import AdjustLeg from './AdjustLeg.vue';
import UserStatus from './UserStatus.vue';
export default {
  name: 'user-dash',
  components: {
    'adjust-leg': AdjustLeg,
    'user-status': UserStatus
  },
  data: () => ({
    user: {},
  }),
  mounted() {
    this.listUser();
  },
  methods: {
    listUser() {
      api
        .get(`/users/get-data-currentuser`)
        .then((response) => {
          // console.log(response);
          this.user = response;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>