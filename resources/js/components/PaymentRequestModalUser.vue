<template>
    <div>
      <custom-modal v-bind:id="'viewUser'">
      <template #title>User</template>
      <div class="table-responsive" >
        <table class="table table-striped">
          <tbody>
            <tr>
              <th align="left">Name</th>
              <th align="right">{{ user.name }}</th>
            </tr>
            <tr>
              <th align="left">Last Name</th>
              <th align="right">{{ user.name }}</th>
            </tr>
            <tr>
              <th align="left">Email</th>
              <th align="right">{{ user.email }}</th>
            </tr>
            <tr>
              <th align="left">Phone</th>
              <th align="right">{{ user.phone }}</th>
            </tr>
          </tbody>
        </table>
      </div>
    </custom-modal>
    </div>
</template>
<script>
import ModalComponent from './ModalComponent.vue';

export default {
    components: {
        'custom-modal': ModalComponent
    },
    props:['user'],
}
</script>