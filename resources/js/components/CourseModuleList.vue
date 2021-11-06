<template>
  <div>
   
    <div class="card">
      <div class="card-header">
        <h3 class="d-inline">
          Lista de Modulos <span> ({{ modules.length }}) </span>
        </h3>
      </div>
      <div class="card-body">
        <ol class="list-group">
          <course-module-class
            @module-updated="moduleUpdate"
            @module-deleted="moduleDelete"
            v-for="(module, index) in modules"
            :key="module.id"
            :module="module"
            :course="course"
          >
            {{ index + 1 }}
          </course-module-class>
        </ol>
      </div>
    </div>
  </div>
</template>

<script>
import CourseModuleClass from './CourseModuleClass.vue';
export default {
  props: {
    modules: {
      type: Array,
      required: true,
    },
    course: {
      type: Object,
      required: true,
    },
  },
  components: {
    CourseModuleClass,
  },
  methods: {
    moduleUpdate(module) {
      this.$emit('module-updated', module);
    },
    moduleDelete(module) {
      this.$emit('module-deleted', module);
    },
  },
};
</script>

<style>
</style>