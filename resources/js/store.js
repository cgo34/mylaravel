/*
|-------------------------------------------------------------------------------
| VUEX store.js
|-------------------------------------------------------------------------------
| Builds the data store from all of the modules for the Roast app.
*/
/*
  Adds the promise polyfill for IE 11
*/
require('es6-promise').polyfill();

/*
    Imports Vue and Vuex
*/
import Vue from 'vue';
import Vuex from 'vuex';

/*
    Initializes Vuex on Vue.
*/
Vue.use( Vuex );

import user  from './modules/user.store.js'
import adverts  from './modules/adverts.store.js'

/*
  Exports our data store.
*/
export default new Vuex.Store({
    modules: {
        user,
        adverts,
    },
});
