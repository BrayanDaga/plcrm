<template>
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card">
      <div class="card-header">Condición</div>
      <div class="card-body">
       Active: <span class="badge badge-pill" :class="user.active ? 'badge-success': 'badge-danger' ">a</span>
       <br>
       Qualified: <span class="badge badge-pill" :class="user.qualified ? 'badge-success': 'badge-danger' ">q</span>
      </div>
    </div>
  </div>
</template>
<script>
import api from '../api/api';

export default {
  name: 'UserStatus',
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