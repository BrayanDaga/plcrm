require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('test', require('./components/Test.vue').default);
Vue.component('binary-branch', require('./components/containers/binary-branch/index').default);

const app = new Vue({
    el: '#app'
});
