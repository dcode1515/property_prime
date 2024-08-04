/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Login', require('./components/Auth/Login.vue').default);
Vue.component('Property', require('./components/Property/Property.vue').default);
Vue.component('Create', require('./components/Property/Create.vue').default);
Vue.component('Tenant', require('./components/Tenant/Tenant.vue').default);
Vue.component('Payment', require('./components/Tenant/Payment.vue').default);
Vue.component('Tenantpayment', require('./components/Tenant/Tenantpayment.vue').default);
Vue.component('Userrole', require('./components/Auth/Userrole.vue').default);
Vue.component('Memorial', require('./components/Property/Memorial.vue').default);
Vue.component('Memorialclient', require('./components/Property/Memorialclient.vue').default);
Vue.component('Client', require('./components/Property/Client.vue').default);
Vue.component('Reportstenant', require('./components/Tenant/Reportstenant.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
