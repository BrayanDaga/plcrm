<template>
    <div class="card p-0">
      <div class="card-body">
        <h5>Ajuste de pierna</h5>
        <button
          class="btn btn-sm px-3"
          :class="user.position == 0 ? 'btn-primary' : 'btn-secondary'"
          @click="changePosition(0)"
        >
          Left
        </button>
        <button
          class="btn btn-sm px-3"
          :class="user.position == 1 ? 'btn-primary' : 'btn-secondary'"
          @click="changePosition(1)"
        >
          Right
        </button>
      </div>
  </div>
  
</template>

<script>
import api from '../api/api';

export default {
  name: 'AdjustLeg',
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
    changePosition(position) {
      api
        .post(`/users/change-position-currentuser`, { position })
        .then((response) => {
          // console.log(response);

          this.listUser();
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