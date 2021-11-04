import moment from 'moment';
import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(value).add(1, 'day').format('LLL')

    // return moment(String(value)).locale('es').format('D MMM YYYY');
  }

});

Vue.component('payment', require('./components/payment/Payment').default);

/** Start components Config */
Vue.component('bank', require('./components/config/bank/Bank').default);
Vue.component('advertisement', require('./components/config/advertisement/Advertisement').default);
Vue.component(
  'payment-method',
  require('./components/config/payment-method/PaymentMethod').default
);
Vue.component('users-list', require('./components/users/List').default);

Vue.component('bonus-component', require('./components/config/BonusComponent.vue').default);
Vue.component('account-type', require('./components/config/account-type/AccountType').default);
Vue.component('user-request', require('./components/config/UserRequest.vue').default);
/** End components Config */

// User membreship
Vue.component('binary-branch', require('./components/binary-branch/BinaryBranch').default);
Vue.component('users-list', require('./components/users/List').default);

Vue.component(
  'payment-request',
  require('./components/PaymentRequest.vue').default
);

Vue.component(
  'modal-user',
  require('./components/ModalUser.vue').default
);

Vue.component(
  'tree-component',
  require('./components/TreeComponent.vue').default
);

Vue.component(
  'adjust-leg',
  require('./components/AdjustLeg.vue').default
);
Vue.component(
  'user-status',
  require('./components/UserStatus.vue').default
);
Vue.component(
  'user-dash',
  require('./components/UserDash.vue').default
);
Vue.component(
  'binary-tree',
  require('./components/BinaryTree.vue').default
);
Vue.component(
  'points-buttons',
  require('./components/PointsButtons.vue').default
);
Vue.component(
  'wallet-history-user',
  require('./components/WalletHistoryUser.vue').default
);
Vue.component(
  'users-funds',
  require('./components/UsersFunds.vue').default
);
Vue.component(
  'user-bonuses',
  require('./components/UserBonuses.vue').default
);
Vue.component('course-form', require('./components/CourseForm.vue').default);
const app = new Vue({
    el: '#app'
});
