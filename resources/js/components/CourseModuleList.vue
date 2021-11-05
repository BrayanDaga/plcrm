<template>
    <div class="card">
        <div class="card-header">Lista de Modulos</div>
        <div class="card-body">
          <ol class="list-group">
            <course-module-class  v-for="module in modules" :key="module.id" :module="module">

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