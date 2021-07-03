import moment from 'moment';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).locale('es').format('D MMM YYYY');
    }
});

Vue.component('binary-branch', require('./components/binary-branch/BinaryBranch').default);
Vue.component('user-membreship-list', require('./components/user-membreship/List').default);
Vue.component('user-membreship-register', require('./components/user-membreship/Register.vue').default);

// Section Config
// User Request
Vue.component('user-request', require('./components/config/UserRequest.vue').default);

const app = new Vue({
    el: '#app',
});
