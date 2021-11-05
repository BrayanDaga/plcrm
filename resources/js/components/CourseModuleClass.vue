<template>
  <div>
    <li class="list-group-item">
      <h3 class="d-inline" v-if="!edit">
        <slot></slot>
        - {{ module.name }} - ({{ classes.length }})
      </h3>
      <span class="d-inline">
        <button class="btn btn-outline-warning" v-if="!edit" @click="edit = true">Edit</button>
      </span>
      <div class="row" v-if="edit">
        <div class="col-md-6 col-12 mb-1">
          <form @submit.prevent="editModule" action="post">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Rename Module"
                v-model="namemodule"
              />

              <div class="input-group-append">
                <button class="btn btn-outline-warning" type="submit">Update Module</button>
                <button v-if="edit" class="btn btn-outline-secondary" @click="edit = false">
                  Cancel
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row" v-if="!edit">
        <div class="col-md-6 col-12 mb-1">
          <form @submit.prevent="addClass" action="post">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="enter name class"
                v-model="name"
              />
              <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">Add Class</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <ol class="list-group">
          <li class="list-group-item" v-for="(clas, index) in classes" :key="clas.id">
            {{ index + 1 + ' - ' + clas.name }}
          </li>
        </ol>
      </div>
    </li>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  props:{
    module: {
      type: Object,
      required: true
    },
    course:{
      type: Object,
      required: true
    }
  },
  data() {
    return {
      name: '',
      classes: [],
      edit: false,
      namemodule: this.module.name,
    };
  },

  mounted() {
    this.listClasses();
  },
  methods: {
    addClass() {
      api
        .post(`/creator/modules/${this.module.id}/clas`, {
          name: this.name,
        })
        .then((response) => {
          console.log(response);
          this.listClasses();
        });
      this.name = '';
    },
    editModule() {
      api.put(`/creator/courses/${this.course.id}/modules/${this.module.id}`, {
          name: this.namemodule,
        })
        .then((response) => {
          console.log(response);
          this.edit = false;
          this.namemodule = this.module.name;
          this.$emit('module-updated', this.module);
        });
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