
require('./bootstrap');

window.Vue = require('vue');

// global event bus
window.EventBus = new Vue();

// vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './routes'

// global component
Vue.component('client-registration', require('./clients/Registration.vue').default);
Vue.component('admin-main', require('./components/admin/Master.vue').default);

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
})

// Sweet alert
import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})
window.toast = toast

const app = new Vue({
    router
}).$mount('#app');
