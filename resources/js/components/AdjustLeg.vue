<template>
   <div class="col-12">
    Ajuste de pierna
    <br>
    <button class="btn px-3" :class="user.position == 0 ? 'btn-primary' : 'btn-secondary'" @click="changePosition(0)">Left</button>
    <button class="btn px-3" :class="user.position == 1 ? 'btn-primary' : 'btn-secondary'" @click="changePosition(1)">Right</button>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  name: 'AdjustLeg',
  data: () => ({
   user:{}
  }),
  mounted() {
    this.listUser();
  },
  methods:{
    listUser(){
    api.get(`/user-membreship/get-data-currentuser`)
      .then(response => {
        // console.log(response);
          this.user = response;
      })
      .catch(error => {
        console.log(error);
      })
    },
    changePosition(position){
      api.post(`/user-membreship/change-position-currentuser`,{position})
      .then(response => {
        // console.log(response);

        this.listUser();
      })
      .catch(error => {
        console.log(error);
      })
    }
}
  
}
</script>

<style>

</style>