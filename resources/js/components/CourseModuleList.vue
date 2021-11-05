<template>
    <div class="card">
        <div class="card-header">
          <h3>Lista de Modulos <sapn> Quantity: {{ modules.length }}</sapn></h3>
          </div>
        <div class="card-body">
          <ol class="list-group">
            <course-module-class  v-for="(module,index) in modules" :key="module.id" :module="module">
              {{ index+1 }}
            </course-module-class>
          </ol>
        </div>
      </div>
</template>

<script>
import CourseModuleClass from './CourseModuleClass.vue';
export default {
    props: {
        modules: {
            type: Array,
            required: true
        }
    },
    components: {
        CourseModuleClass
    }
}
</script>

<style>

</style>