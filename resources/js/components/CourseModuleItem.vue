<template>
  <div>
    <custom-modal :id="'module-delete'" color="danger">
      <template #title
        >Delete module <u>{{ module.name }}</u></template
      >

      <p>Are you sure you want to remove this module and its classes?</p>
      <p>This action cannot be undone.</p>
      <template #footer>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" @click="deleteModule">
          <span
            class="spinner-border spinner-border-sm text-danger"
            role="status"
            aria-hidden="true"
          ></span>
          <span class="ml-25 align-middle"> Delete Module </span>
        </button>
      </template>
    </custom-modal>

    <li class="list-group-item">
      <h3 class="d-inline" v-if="!edit">
        <slot></slot>
        - {{ module.name }} - ({{ classes.length }})
      </h3>
      <div class="float-right">
        <button @click="edit = true" class="btn btn-outline-warning" v-if="edit == false">
          Edit
        </button>
        <button data-toggle="modal" data-target="#module-delete" class="btn btn-outline-danger">
          Delete?
        </button>
      </div>
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
                <button class="btn btn-outline-warning" type="submit">Update</button>
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
          <course-module-class
            v-for="(clas, index) in classes"
            :key="clas.id"
            :module="module"
            :clas="clas"
            @clas-deleted="listClasses"
          >
            {{ index + 1 }}
          </course-module-class>
        </ol>
      </div>
    </li>
  </div>
</template>

<script>
import api from '../api/api';
import ModalComponent from './ModalComponent.vue';
import CourseModuelClass from './CourseModuleClass.vue';

export default {
  props: {
    module: {
      type: Object,
      required: true,
    },
    course: {
      type: Object,
      required: true,
    },
  },
  components: {
    'custom-modal': ModalComponent,
    'course-module-class': CourseModuelClass,
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
      api
        .put(`/creator/courses/${this.course.id}/modules/${this.module.id}`, {
          name: this.namemodule,
        })
        .then((response) => {
          console.log(response);
          this.edit = false;
          this.$emit('module-updated', this.module);
          this.namemodule = response.data.name;
        });
    },
    deleteModule() {
      api
        .delete(`/creator/courses/${this.course.id}/modules/${this.module.id}`)
        .then((response) => {
          console.log(response);
          $('#module-delete').modal('hide');
          this.$emit('module-deleted', this.module);
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