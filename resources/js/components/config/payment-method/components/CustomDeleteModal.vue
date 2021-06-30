<template>
  <div class="d-inline-block">
    <div
        class="modal fade text-left modal-danger"
        id="delete-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel140"
        aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel140">Delete Payment Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            You want to delete the payment method {{ paymentMethod.name }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="onDelete">
              <span
                  class="spinner-border spinner-border-sm text-danger"
                  role="status"
                  aria-hidden="true"
                  v-if="loading"
              ></span>
              <span class="ml-25 align-middle"> Accept </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiPaymentMethod from '../../../../api/api.payment-method';

export default {
  props: {
    paymentMethod: {
      type: Object,
      require: true,
    },
  },
  emits: {
    /*Recibe un campo boolean*/
    'confirm-delete': function (bool) {},
  },
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    onDelete() {
      if (this.paymentMethod) {
        this.loading = true;
        apiPaymentMethod.delete(this.paymentMethod.id).then(() => {
          this.loading = false;
          $('#delete-modal').modal('hide');
          this.$emit('confirm-delete', true);
        });
      }
    },
  },
  name: 'CustomDeleteModal',
};
</script>

<style scoped></style>
