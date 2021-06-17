require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('binary-branch', require('./components/index.vue').default);
Vue.component('user-membreship-register', require('./components/user-membreship/Register.vue').default);

import moment from 'moment';

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value))
            .locale('es')
            .format('D MMM YYYY');
    }
});

const app = new Vue({
    el: '#app'
});
