/*
|-------------------------------------------------------------------------------
| VUEX modules/locations.js
|-------------------------------------------------------------------------------
| The Vuex data store for the locations
*/

import AdvertApi from '../api/advert.api.js';

var step = 0;
if(localStorage.getItem('creatingAdvert')){
    var stepper = JSON.parse(localStorage.getItem('creatingAdvert'));
    if(stepper.e1 !== null){
        step = stepper.e1;
    }
}
const state = {
    /*
      Defines the state being monitored for the module.
    */

    advert_types: [],
    property_types: [],

    sellers: [],
    seller: null,
    
    locations: [],
    location: null,
    
    buyers: [],
    buyer: null,

    cities: [],

    creatingAdvert: {
        e1: step,

        user_type: null,
        advert_type: null,

        name: null,
        description: null,

        address: null,
        zipcode: null,
        city: null,

        property_type: null,
        property_features: [],

        living_space: null,
        living_space_min: null,
        living_space_max: null,

        room: null,
        bedroom: null,
        bathroom: null,

        energetic_class_value: null,
        energetic_class: null,

        price_min: 0,
        price_max: null,
        rent_price: null,
        sell_price: null,
        guarantee: null,

        images: [],

    }
};

const getters = {
    /*
         Returns the locations.
       */
    getPropertyTypes( state ){
        return state.property_types;
    },

    /*
         Returns the locations.
       */
    getAdvertTypes( state ){
        return state.advert_types;
    },

    /*
         Returns the locations.
       */
    getLocations( state ){
        return state.locations;
    },

    /*
      Returns the location
    */
    getLocation( state ){
        return state.location;
    },

    /*
         Returns the buyers.
       */
    getBuyers( state ){
        return state.buyers;
    },

    /*
      Returns the buyer
    */
    getBuyer( state ){
        return state.buyer;
    },

    /*
      Returns the location
    */
    getCreatingAdvert( state ){
        return state.creatingAdvert;
    }
};

const mutations = {
    /*
          Sets the locations
        */
    SET_PROPERTY_TYPES( state, property_types ){
        console.log('SET PROPERTY TYPES');
        console.log(property_types);
        state.property_types = property_types;
    },

    /*
          Sets the locations
        */
    SET_ADVERT_TYPES( state, advert_types ){
        console.log('SET ADVERT TYPES');
        console.log(advert_types);
        state.advert_types = advert_types;
    },

    /*
          Sets the locations
        */
    SET_LOCATIONS( state, locations ){
        state.locations = locations;
    },

    /*
      Set the location
    */
    SET_LOCATION( state, location ){
        state.location = location;
    },

    /*
          Sets the locations
        */
    SET_BUYERS( state, buyers ){
        state.buyers = buyers;
    },

    /*
      Set the location
    */
    SET_BUYER( state, buyer ){
        state.buyer = buyer;
    },

    /*
      Set the location
    */
    SET_VALUE( state, key, value ){
        state.key = value;
    },

    SET_CREATING_ADVERT( state, creatingAdvert ){
        state.creatingAdvert = creatingAdvert;
    },

    ADD_CREATING_ADVERT_FILE(state, file){
        state.creatingAdvert.images.push(file);
    },

    REMOVE_CREATING_ADVERT_FILE(state, key){
        state.creatingAdvert.images.splice( key, 1 );
    },

    SET_CITIES(state, cities){
        for(var i = 0; i < cities.length; i++){
            state.cities.push({
                code: cities[i]['code'],
                code_departement: cities[i]['codeDepartement'],
                code_region: cities[i]['codeRegion'],
                codes_postaux: cities[i]['codesPostaux'],
                value: cities[i]['nom'],
                name: cities[i]['nom'] + ' ' + cities[i]['codesPostaux'][0],
                population: cities[i]['population'],
            });
        }
    }
};

const actions = {
    resetAdvert({ commit }) {
        const advert =  {
            e1: step,

            user_type: null,
            advert_type: null,

            name: null,
            description: null,

            address: null,
            zipcode: null,
            city: null,

            property_type: null,
            property_features: [],

            living_space: null,
            living_space_min: null,
            living_space_max: null,

            room: null,
            bedroom: null,
            bathroom: null,

            energetic_class_value: null,
            energetic_class: null,

            price_min: 0,
            price_max: null,
            rent_price: null,
            sell_price: null,
            guarantee: null,

            images: [],


        };
        return commit('SET_VALUE', { key: 'creatingAdvert', value: advert });
    },
    /*
          Loads the locations from the API
        */
    loadPropertyTypes( { commit } ){
        console.log('load Property Types');
        AdvertApi.getPropertyTypes()
            .then( function( response ){
                commit( 'SET_PROPERTY_TYPES', response.data );
            })
            .catch( function(){
                commit( 'SET_PROPERTY_TYPES', [] );
            });
    },

    /*
          Loads the locations from the API
        */
    loadAdvertTypes( { commit } ){
        console.log('load advert Types');
        AdvertApi.getAdvertTypes()
            .then( function( response ){
                commit( 'SET_ADVERT_TYPES', response.data );
            })
            .catch( function(){
                commit( 'SET_ADVERT_TYPES', [] );
            });
    },

    /*
          Loads the locations from the API
        */
    loadLocations( { commit } ){
        console.log('load Locations');
        AdvertApi.getLocations()
            .then( function( response ){
                commit( 'SET_LOCATIONS', response.data );
            })
            .catch( function(){
                commit( 'SET_LOCATIONS', [] );
            });
    },

    /*
      Loads an individual location from the API
    */
    loadLocation( { commit }, data ){
        AdvertApi.getLocation( data.id )
            .then( function( response ){
                commit( 'SET_LOCATION', response.data );
            })
            .catch( function(){
                commit( 'SET_LOCATION', null );
            });
    },

    /*
          Loads the locations from the API
        */
    loadBuyers( { commit } ){
        console.log('load Buyers');
        AdvertApi.getBuyers()
            .then( function( response ){
                commit( 'SET_BUYERS', response.data );
            })
            .catch( function(){
                commit( 'SET_BUYERS', [] );
            });
    },

    /*
      Loads an individual location from the API
    */
    loadCreatingAdvert( { commit } ){
        commit( 'SET_CREATING_ADVERT', getCreatingAdvert );
    },

    createAdvert( { commit, dispatch } ){
        console.log('create advert location');
        console.log(state.creatingAdvert);
        let value = null;
        let ok = false;
        let result = null;
        AdvertApi.createAdvert(state.creatingAdvert).then((response) => {
            console.log(state.creatingAdvert);
            console.log(response);
            value = response.data && response.data.content;
            ok = !!value;
            result = response;
        }).catch((error) => {
            result = error.response;
        }).finally(() => {
            dispatch('resetAdvert');

        });
    },

    /*
      Loads an individual location from the API
    */
    addCreatingAdvertFile( { commit }, file ){
        var url = '';
        var newFile = {name: file.name, size: file.size, type: file.type, url: url};
        const fr = new FileReader();
        fr.readAsDataURL(file);
        fr.addEventListener('load', () => {
            newFile.url = fr.result;
        });

        commit( 'ADD_CREATING_ADVERT_FILE', newFile );
    },

    /*
      Remove image from advert location
    */
    removeCreatingAdvertFile( { commit }, key ){
        commit( 'REMOVE_CREATING_ADVERT_FILE', key );
    },

    loadCities( { commit, dispatch } ){
        console.log('load cities');
        let value = null;
        let ok = false;
        let result = null;
        axios.get('https://geo.api.gouv.fr/communes?codePostal=' + state.creatingAdvert.city).then(function (response) {
            console.log('by zipcode');
            //this.test = [];
            var value = response.data;
            if(value){
                commit( 'SET_CITIES', value );
                /*for(var i = 0; i < value.length; i++){
                    this.test.push({
                        code: value[i]['code'],
                        code_departement: value[i]['codeDepartement'],
                        code_region: value[i]['codeRegion'],
                        codes_postaux: value[i]['codesPostaux'],
                        value: value[i]['nom'],
                        name: value[i]['nom'] + ' ' + value[i]['codesPostaux'][0],
                        population: value[i]['population'],
                    });
                }*/
            }

        }.bind(this)).catch(function (data) {
            console.log(data);
            console.log('error');
        });
        axios.get('https://geo.api.gouv.fr/communes?nom=' + state.creatingAdvert.city).then(function (response) {
            console.log('by commune');
            //this.test = [];
            var value = response.data;
            if(value){
                commit( 'SET_CITIES', value );
                /*for(var i = 0; i < value.length; i++){
                    this.test.push({
                        code: value[i]['code'],
                        value: value[i]['nom'],
                        name: value[i]['nom'] + ' ' + value[i]['codesPostaux'][0],
                    });
                }*/
            }
        }.bind(this)).catch(function (data) {
            console.log(data);
            console.log('error');
        });

        console.log(state.creatingAdvert.city);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
