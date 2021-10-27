<template>
    <div class="card p-0">
      <div class="card-header">Condición</div>
      <div class="card-body">
       Active: <span class="badge badge-pill" :class="user.active ? 'badge-success': 'badge-danger' ">a</span>
       <br>
       Qualified: <span class="badge badge-pill" :class="user.qualified ? 'badge-success': 'badge-danger' ">q</span>
      </div>
    </div>
</template>
<script>

export default {
  name: 'UserStatus',
  props: {
    user: {
      type: Object,
      required: true
    }    
  },
};
</script>

<style>
</style>