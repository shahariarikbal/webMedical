
require('./bootstrap');

window.Vue = require('vue');

// global event bus
window.EventBus = new Vue();

// global component
Vue.component('client-registration', require('./clients/Registration.vue').default);

const app = new Vue({
    el: '#app',
});
