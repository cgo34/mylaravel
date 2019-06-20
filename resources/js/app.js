
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vuetify from 'vuetify';
import Axios from 'axios';
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import store from './store';


window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Axios = axios;

Vue.use(Vuetify, {
    themes: {
        primary: '#42DCA3',
        secondary: '#20B11D',
        accent: '#8c9eff',
        error: '#b71c1c',
    }
});

Vue.use(Axios);
Vue.use(VueRouter);
//Vue.use(VueTelInput);

var VueResource = require('vue-resource');
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
var token = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common = {'Authorization': `Bearer ${token}`};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.events = new Vue();
window.flash = function(message) {
    window.events.$emit('flash',message);
};



//Vue.component('app', require('./components/App.vue'));
Vue.component('post', require('./components/posts/Post.vue'));
Vue.component('single-post', require('./components/posts/SinglePost.vue'));
Vue.component('single-page', require('./components/pages/SinglePage.vue'));

Vue.component('mynav', require('./components/Nav.vue'));
Vue.component('navdrawer', require('./components/NavDrawer.vue'));
Vue.component('layout', require('./components/Layout.vue'));
// Vue.component('programmeslist', require('./components/programmes/ProgrammesList.vue'));

Vue.component('search', require('./components/Search.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('login-form', require('./components/form/LoginForm.vue'));
Vue.component('register-form', require('./components/form/RegisterForm.vue'));
Vue.component('register-modal', require('./components/modal/RegisterModal.vue'));
Vue.component('forgot-password-form', require('./components/form/ForgotPasswordForm.vue'));
Vue.component('login-white', require('./components/LoginWhite.vue'));
Vue.component('register', require('./components/Register.vue'));

// Vue.component('programmes', require('./components/Programmes.vue'));
Vue.component('programme', require('./components/programmes/Programme.vue'));
Vue.component('programmes', require('./components/programmes/Programmes.vue'));
Vue.component('programme-lots', require('./components/programmes/ProgrammeLots.vue'));
Vue.component('lot', require('./components/lots/Lot.vue'));
Vue.component('lots-grid', require('./components/lots/LotsGrid.vue'));

Vue.component('properties', require('./components/properties/Properties.vue'));
Vue.component('property-lots', require('./components/properties/PropertyLots.vue'));
Vue.component('property-favorite', require('./components/properties/PropertyFavorite.vue'));

/*
 * CRUD Advert component
 */
Vue.component('add-advert-button', require('./components/adverts/AddAdvertButton.vue'));
/*
 * Location component
 */
Vue.component('location', require('./components/adverts/Location.vue'));
Vue.component('LocationList', require('./components/adverts/locations/LocationList.vue'));
Vue.component('LocationListItem', require('./components/adverts/locations/LocationListItem.vue'));
Vue.component('single-location', require('./components/adverts/SingleLocation.vue'));

//Vue.component('myfooter', require('./components/Footer.vue'));
Vue.component('call', require('./components/Call.vue'));

/**
 *
 * Forms Components
 */
Vue.component('add-location-form', require('./components/form/location/AddLocationForm.vue'));
Vue.component('file-upload', require('./components/form/file/FileUpload.vue'));

/**
 *
 * Notifications Components
 */
Vue.component('flash', require('./components/Flash.vue'));
Vue.component('notifications-list', require('./components/NotificationsList.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));
Vue.component('notification', require('./components/Notification.vue'));

/**
 *
 * Modals Components
 */
Vue.component('parrainage-modal', require('./components/modal/ParrainageModal.vue'));
Vue.component('particular-option-requests-modal', require('./components/modal/ParticularOptionRequestsModal.vue'));
Vue.component('newsletter-modal', require('./components/modal/NewsletterModal.vue'));

/**
 *
 * Actions Components
 */
Vue.component('call', require('./components/actions/Call.vue'));
Vue.component('contact', require('./components/actions/Contact.vue'));
Vue.component('denonce', require('./components/actions/Denonce.vue'));
Vue.component('contact-form', require('./components/form/ContactForm.vue'));

Vue.component('favorites', require('./components/Favorites.vue'));
Vue.component('favorites-lots', require('./components/actions/FavoritesLots.vue'));
Vue.component('favorites-properties', require('./components/actions/FavoritesProperties.vue'));

Vue.component('books', require('./components/Favorites.vue'));
Vue.component('books-lots', require('./components/actions/BooksLots.vue'));

/**
 *
 *  Search filters
 */
Vue.component('dispositif-filter', require('./components/search/filter/Dispositif.vue'));
Vue.component('actif-filter-search', require('./components/search/actifFilterSearch.vue'));
Vue.component('favorite-filter', require('./components/filter/favorite/FavoriteFilter.vue'));

/**
 *
 *      Layout Components
 */
Vue.component('footer-transparent', require('./components/layout/FooterTransparent.vue'));
Vue.component('footer-white', require('./components/layout/FooterWhite.vue'));
Vue.component('teaser-galileo', require('./components/videos/TeaserGalileo.vue'));



const app = new Vue({
    el: '#app',
    store,
    data: function() {
        return {
            page: '',
            user: '',
        }
    },
    mounted() {
        var config = {
            headers: {'Authorization': "bearer " + token}
        };

        axios.get('/user', config).then(response => {
            this.user = response.data;
        });
    },
});
