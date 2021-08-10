<template>
  <div>
    <div class="table-responsive" v-if="!initialLoading">
      <table id="datatable" class="table table-hover table-striped table-bordered">
        <thead>
          <tr>
            <th>Date of Purchase</th>
            <th>Client</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Operation Number</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="payment in payments" :key="payment.id">
            <td>{{ payment.created_at | formatDate }}</td>
            <td>
              <a href="#" @click="openModal(payment, 'viewUser')">
                {{ payment.user_membreship.fullName }}
              </a>
            </td>
            <td>{{ payment.description }}</td>
            <td>{{ payment.amount }}</td>
            <td>{{ payment.payment_method.name }}</td>
            <td>{{ payment.operation_number }}</td>
            <td>
              <a
                href="#"
                title="View Purchase"
                class="mr-1"
                @click="openModal(payment, 'viewPurchase')"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="30"
                  height="30"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-vertical font-small-4"
                >
                  <path
                    d="M19.8005808,10 C17.9798698,6.43832409 14.2746855,4 10,4 C5.72531453,4 2.02013017,6.43832409 0.199419187,10 C2.02013017,13.5616759 5.72531453,16 10,16 C14.2746855,16 17.9798698,13.5616759 19.8005808,10 Z M10,14 C12.209139,14 14,12.209139 14,10 C14,7.790861 12.209139,6 10,6 C7.790861,6 6,7.790861 6,10 C6,12.209139 7.790861,14 10,14 Z M10,12 C11.1045695,12 12,11.1045695 12,10 C12,8.8954305 11.1045695,8 10,8 C8.8954305,8 8,8.8954305 8,10 C8,11.1045695 8.8954305,12 10,12 Z"
                    id="Combined-Shape"
                  ></path>
                </svg>
              </a>
              <a
                href="#"
                title="Authorize"
                class="mr-1"
                @click="openModal(payment, 'viewauthorize')"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="30"
                  height="30"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-vertical font-small-4"
                >
                  <polygon id="Path-126" points="0 11 2 9 7 14 18 3 20 5 7 18"></polygon>
                </svg>
              </a>
              <a href="#" title="Disavow" class="mr-1" @click="openModal(payment, 'viewDisavow')">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="30"
                  height="30"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-vertical font-small-4"
                >
                  <path
                    d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm16.32-4.9L5.09 16.31A8 8 0 0 0 16.32 5.09zm-1.41-1.42A8 8 0 0 0 3.68 14.91L14.91 3.68z"
                  ></path>
                </svg>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <custom-spinner v-else></custom-spinner>

    <payment-request-modal-product :products="paymentSelect.products">
    </payment-request-modal-product>
    <payment-request-modal-user :user="paymentSelect.user_membreship"> </payment-request-modal-user>

    <payment-request-modal-authorize
      :payment="paymentSelect"
      @payment-authorized="paymentAuthorized"
    ></payment-request-modal-authorize>

    <payment-request-modal-disavow
      :payment="paymentSelect"
      @payment-denied="paymentDenied"
    ></payment-request-modal-disavow>
  </div>
</template>

<script>
import api from '../api/api';
import CustomSpinner from '../common/custom-spinner/CustomSpinner';
import PaymentRequestModalProduct from './PaymentRequestModalProduct.vue';
import PaymentRequestModalUser from './PaymentRequestModalUser.vue';
import PaymentRequestModalAuthorize from './PaymentRequestModalAuthorize.vue';
import PaymentRequestModalDisavow from './PaymentRequestModalDisavow.vue';

export default {
  name: 'PaymentRequest',
  components: {
    CustomSpinner,
    'payment-request-modal-product': PaymentRequestModalProduct,
    'payment-request-modal-user': PaymentRequestModalUser,
    'payment-request-modal-authorize': PaymentRequestModalAuthorize,
    'payment-request-modal-disavow': PaymentRequestModalDisavow,
  },
  data: () => ({
    payments: [],
    paymentSelect: {
      user_membreship: {},
      products: [],
    },
    initialLoading: true,
  }),
  mounted() {
    this.listPayments();
  },
  methods: {
    loadDataTable() {
      this.$nextTick(function () {
        $('#datatable').DataTable({
          responsive: true,
          processing: true,
        });
      });
    },
    listPayments() {
      this.initialLoading = true;
      api.get(`/requests/listpendingPayments`).then((response) => {
        this.initialLoading = false;
        this.payments = response.data;
        $('#datatable').DataTable().destroy();
        this.loadDataTable();
      });
    },
    paymentAuthorized() {
      this.showToast('success', `Payment was successfully authorized`);
      this.listPayments();
    },
    paymentDenied() {
      this.showToast('success', `Payment was successfully denied`);
      this.listPayments();
    },
    openModal(payment, idSelect) {
      this.paymentSelect = payment;
      $(`#${idSelect}`).modal('show');
    },
    showToast(type, message) {
      toastr[type](`${message}`, `${type}!`, {
        positionClass: 'toast-top-center',
        closeButton: true,
        tapToDismiss: false,
      });
    },
  },
};
</script>

<style lang="css" scoped></style>
