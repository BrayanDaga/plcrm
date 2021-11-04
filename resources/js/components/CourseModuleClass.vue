<template>
  <div>
      <li class="">
         {{ module.name }}
            <button class="btn btn-danger btn-sm float-right" @click="removeModule(module)">
                  Delete
            </button>
        </li>
  </div>
</template>

<script>
export default {
    props: ['module'],
}
</script>

<style>

</style>