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
              <th align="right">{{ user.last_name }}</th>
            </tr>
            <tr>
              <th align="left">Email</th>
              <th align="right">{{ user.email }}</th>
            </tr>
            <tr>
              <th align="left">Phone</th>
              <th align="right">{{ user.phone }}</th>
            </tr>
            <tr>
              <th align="left">Birthday date</th>
              <th align="right">{{ user.date_birth | formatDate  }}</th>
            </tr>
             <tr>
              <th align="left">Category</th>
              <th align="right">{{ user.account_type.account  }}</th>
            </tr>
            <tr>
              <th align="left">Status</th>
              <th align="right">
                <span v-if="user.active == true" class="label text-success">Active</span>
                <span v-else-if="user.active == false" class="label text-danger">Inactive</span>
              </th>
            </tr>
            <!-- <tr>
              <th align="left">Range</th>
              <th align="right">
                {{ user.position }}
                En la pagina todos tienen posicion Medalla de Oro
              </th>
            </tr>  -->
            <tr>
              <td>
                V.L <span class="font-weight-bold">{{ user.LeftPoints }}</span>
              </td>
              <td>
                V.R <span class="font-weight-bold">{{ user.RightPoints }}</span>
              </td>
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
