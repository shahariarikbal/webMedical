
require('./bootstrap');

window.Vue = require('vue');

// global event bus
window.EventBus = new Vue();

// vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './routes'

// global component
Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('client-registration', require('./clients/Registration.vue').default);
Vue.component('admin-main', require('./components/admin/Master.vue').default);
Vue.component('contact', require('./components/admin/contact/contact.vue').default);

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
})



window.EventBus = new Vue();

const app = new Vue({
    router
}).$mount('#app');
