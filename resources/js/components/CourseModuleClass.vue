<template>
  <div>
    <li class="list-group-item">
      <a :href="linkClas"> {{ clas.name }} &nbsp;</a>    
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
    computed: {
        linkClas() {
            return `/creator/modules/${this.module.id}/clas/${this.clas.id}/edit`;
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