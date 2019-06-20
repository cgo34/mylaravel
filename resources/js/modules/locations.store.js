/*
|-------------------------------------------------------------------------------
| VUEX modules/locations.js
|-------------------------------------------------------------------------------
| The Vuex data store for the locations
*/

import LocationAPI from '../api/location.api.js';

const state = {
    /*
      Defines the state being monitored for the module.
    */

    locations: [],
    location: null,

    creatingLocation: {
        e1: 0,
        name: null,
        description: null,

        address: null,
        zipcode: null,

        property_type: null,
        property_features: [],

        living_space: null,
        room: null,
        bedroom: null,

        energetic_class_value: null,
        energetic_class: null,

        rent_price: null,
        guarantee: null,

        images: [],

    }
};

const getters = {
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
      Returns the location
    */
    getCreatingLocation( state ){
        return state.creatingLocation;
    }
};

const mutations = {
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
      Set the location
    */
    SET_CREATING_LOCATION( state, creatingLocation ){
        state.creatingLocation = creatingLocation;
    },

    ADD_CREATING_LOCATION_FILE(state, file){
        state.creatingLocation.images.push(file);
    },

    REMOVE_CREATING_LOCATION_FILE(state, key){
        state.creatingLocation.images.splice( key, 1 );
    }
};

const actions = {
    /*
          Loads the locations from the API
        */
    loadLocations( { commit } ){
        console.log('load Locations');
        LocationAPI.getLocations()
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
        LocationAPI.getLocation( data.id )
            .then( function( response ){
                commit( 'SET_LOCATION', response.data );
            })
            .catch( function(){
                commit( 'SET_LOCATION', null );
            });
    },

    /*
      Loads an individual location from the API
    */
    loadCreatingLocation( { commit } ){
        commit( 'SET_CREATING_LOCATION', getCreatingLocation );
    },

    /*
      Loads an individual location from the API
    */
    addCreatingLocationFile( { commit }, file ){
        var url = '';
        var newFile = {name: file.name, size: file.size, type: file.type, url: url};
        const fr = new FileReader();
        fr.readAsDataURL(file);
        fr.addEventListener('load', () => {
            newFile.url = fr.result;
        });

        commit( 'ADD_CREATING_LOCATION_FILE', newFile );
    },

    /*
      Remove image from advert location
    */
    removeCreatingLocationFile( { commit }, key ){
        commit( 'REMOVE_CREATING_LOCATION_FILE', key );
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
