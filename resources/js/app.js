
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vuetify from 'vuetify';
import Axios from 'axios';
import VueRouter from 'vue-router'

window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Axios = axios;

Vue.use(Vuetify);
Vue.use(Axios);
Vue.use(VueRouter);

var VueResource = require('vue-resource');
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('test', require('./components/ExampleComponent.vue'));
Vue.component('layout', require('./components/Layout.vue'));
Vue.component('programmeslist', require('./components/ProgrammesList.vue'));

Vue.component('search', require('./components/Search.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));

Vue.component('programmes', require('./components/Programmes.vue'));
Vue.component('programme', require('./components/Programme.vue'));
Vue.component('lot', require('./components/Lot.vue'));



const app = new Vue({
    el: '#app',
});
