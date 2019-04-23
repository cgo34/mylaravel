
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'vue-tel-input/dist/vue-tel-input.css';

import Vuetify from 'vuetify';
import Axios from 'axios';
import VueRouter from 'vue-router';
import VueTelInput from 'vue-tel-input';


window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Axios = axios;

Vue.use(Vuetify);
Vue.use(Axios);
Vue.use(VueRouter);
Vue.use(VueTelInput);

var VueResource = require('vue-resource');
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.events = new Vue();
window.flash = function(message) {
    window.events.$emit('flash',message);
}



//Vue.component('app', require('./components/App.vue'));
Vue.component('mynav', require('./components/Nav.vue'));
Vue.component('navdrawer', require('./components/NavDrawer.vue'));
Vue.component('layout', require('./components/Layout.vue'));
Vue.component('programmeslist', require('./components/ProgrammesList.vue'));

Vue.component('search', require('./components/Search.vue'));
Vue.component('searchbar', require('./components/SearchBar.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));

Vue.component('programmes', require('./components/Programmes.vue'));
Vue.component('programme', require('./components/Programme.vue'));
Vue.component('programme-lots', require('./components/ProgrammeLots.vue'));
Vue.component('lot', require('./components/Lot.vue'));

Vue.component('myfooter', require('./components/Footer.vue'));
Vue.component('call', require('./components/Call.vue'));

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('notifications-list', require('./components/NotificationsList.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));
Vue.component('notification', require('./components/Notification.vue'));

/**
 *
 * Actions Components
 */
Vue.component('call', require('./components/actions/Call.vue'));
Vue.component('contact', require('./components/actions/Contact.vue'));
Vue.component('denonce', require('./components/actions/Denonce.vue'));

Vue.component('favorites', require('./components/Favorites.vue'));
Vue.component('favorites-lots', require('./components/actions/FavoritesLots.vue'));

export const bus = new Vue();

const app = new Vue({
    el: '#app',
});
