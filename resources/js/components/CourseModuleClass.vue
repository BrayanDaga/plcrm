<template>
  <div>
    <li class="list-group-item">
      <h3>* {{ module.name }}</h3>
      <div class="row">
        <div class="col-md-6 col-12 mb-1">
          <form action="post">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="enter name class" />
              <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button">Add Class</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <ol class="list-group">
          <li  class="list-group-item" v-for="clas in classes" :key="clas.id">
              {{ clas.name }}
          </li>
        </ol>
      </div>
    </li>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  props: ['module'],
  data() {
    return {
      name: '',
      classes: [],
    }
  },

  mounted() {
    this.listClasses();
  },
  methods: {
    addClass() {
      api
        .post(`/creator/courses/${this.course}/modules`, {
          name: this.name,
        })
        .then((response) => {
          console.log(response);
          this.listClasses();
        });
      this.name = '';
    },
    listClasses() {
      api
        .get(`/creator/modules/${this.module.id}/clas`)
        .then((response) => {
          console.log(response);
          this.classes = response;
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