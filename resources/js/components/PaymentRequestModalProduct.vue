<template>
    <div>
       <custom-modal v-bind:id="'viewPurchase'" size="large">
      <template #title>Purchased Products </template>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" v-bind:key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.pivot.quantity }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.pivot.quantity * product.price }}</td>
            </tr> 
            </tbody>
          <tfoot>
            <th colspan="3" class="text-center">Total</th>
            <td class="font-weight-bold">{{ total }}</td>
          </tfoot>
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
    props:['products'],
    computed: {
        total() {
            let total = 0;
            this.products.forEach(product => {
                total += product.pivot.quantity * product.price;
            });
            return total;
        }
    },
}
</script>