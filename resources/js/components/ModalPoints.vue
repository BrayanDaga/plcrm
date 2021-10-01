<template>
    <div>
      <custom-modal v-bind:id="'pointsLog'" size="large">

      <template #title>Points</template>
      <div class="table-responsive" >
        <table class="table table-striped">
          <tbody>
              <tr>
                  <th>Points</th>
                  <th>Reason</th>
              </tr>
              <tr v-for="userPoint in userPoints" :key="userPoint.id">
                  <td>{{ userPoint.points }}</td>
                  <td>{{ userPoint.reason }}</td>
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
    name: 'ModalPoints',
    components: {
        'custom-modal': ModalComponent
    },
   props: {
      userPoints:{
           type: Array,
            required: true
       },
   },
    
}
</script>
