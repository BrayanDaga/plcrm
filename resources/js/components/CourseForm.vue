<template>
  <div class="row">
    <div class="col-12">
      <form @submit.prevent="addModule" action="post">
        <div class="col-12">
          <div class="form-group">
            <input type="text" v-model="name" class="form-control" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Module</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-12">
    <course-module-list :modules="modules"></course-module-list>
    </div>
  </div>
</template>

<script>
import api from '../api/api';
import CourseModuleList from './CourseModuleList.vue';

export default {
  props: {
    course: {
      required: true,
    },
  },
  data() {
    return {
      name: '',
      modules: [],
    };
  },
  components:{
      CourseModuleList
  },
  mounted() {
    this.listModules();
  },
  methods: {
    addModule() {
      api
        .post(`/creator/courses/${this.course}/modules`, {
          name: this.name,
        })
        .then((response) => {
          console.log(response);
          this.listModules();
        });
      this.name = '';
    },
    listModules() {
      api
        .get(`/creator/courses/${this.course}/modules`)
        .then((response) => {
          console.log(response);
          this.modules = response;
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