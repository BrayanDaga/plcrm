<template>
  <div>
    <li class="list-group-item">
      {{ clas.name }} &nbsp;
      <button class="btn btn-sm btn-outline-danger" @click="deleteClass()">x</button>
    </li>
  </div>
</template>

<script>
import api from '../api/api';

export default {
    props: {
        module: {
        type: Object,
        required: true,
        },
        clas: {
        type: Object,
        required: true,
        },
    },
    methods: {
        deleteClass() {
      api.delete(`/creator/modules/${this.module.id}/clas/${this.clas.id}`).then((response) => {
        console.log(response);
        this.$emit('clas-deleted', this.clas);
      });

    },
    }
}
</script>

<style>
</style>