require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('test', require('./components/Test.vue').default);
Vue.component('binary-branch', require('./components/binary-branch/index').default);

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
