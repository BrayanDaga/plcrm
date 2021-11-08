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
          <course-module-item
            @module-updated="moduleUpdate"
            @module-deleted="moduleDelete"
            v-for="(module, index) in modules"
            :key="module.id"
            :module="module"
            :course="course"
          >
            {{ index + 1 }}
          </course-module-item>
        </ol>
      </div>
    </div>
  </div>
</template>

<script>
import CourseModuleItem from './CourseModuleItem.vue';
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
    CourseModuleItem,
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