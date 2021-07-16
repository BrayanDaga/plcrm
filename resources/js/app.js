import moment from 'moment';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value))
      .locale('es')
      .format('D MMM YYYY');
  }
});

/** Start components Config */
Vue.component('bank', require('./components/config/bank/Bank').default);
Vue.component('advertisement', require('./components/config/advertisement/Advertisement').default);
Vue.component('payment-method', require('./components/config/payment-method/PaymentMethod').default);
Vue.component(
    'user-membreship-list',
    require('./components/user-membreship/List').default
);Vue.component(
    'user-membreship-register',
    require('./components/user-membreship/Register.vue').default
);

Vue.component('growth-bonus', require('./components/config/bonus/GrowthBonus.vue').default);
Vue.component('account-type', require('./components/config/account-type/AccountType').default);
Vue.component('user-request', require('./components/config/UserRequest.vue').default);
/** End components Config */


Vue.component('binary-branch', require('./components/binary-branch/BinaryBranch').default);
Vue.component('user-membreship-list', require('./components/user-membreship/List').default);
Vue.component('user-membreship-register', require('./components/user-membreship/Register.vue').default);

const app = new Vue({
  el: '#app'
});
