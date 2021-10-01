<template>
  <div>
    <div class="d-flex justify-content-around my-5">
      <button class="btn btn-primary" @click="getPoints(0)">Left volume</button>
      <button class="btn btn-primary" @click="getPoints(1)">Right volume</button>
    </div>
    <modal-points :userPoints="userPoints"></modal-points>
  </div>
</template>

<script>
import api from '../api/api';
import ModalPoints from './ModalPoints.vue';
export default {
  name: 'PointsButtons',
  components: {
    'modal-points': ModalPoints,
  },
  data() {
    return {
      userPoints: [],
    };
  },
  methods: {
    getPoints(side) {
      api
        .get(`/mypointslog?side=${side}`)
        .then((response) => {
          this.userPoints = response.data;
          $(`#pointsLog`).modal('show');
        })
        .catch((error) => {
          // console.log(error);
        });
    },
  },
};
</script>

<style>
</style>