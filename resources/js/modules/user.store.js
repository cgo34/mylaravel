/*
|-------------------------------------------------------------------------------
| VUEX modules/locations.js
|-------------------------------------------------------------------------------
| The Vuex data store for the locations
*/

import UserAPI from '../api/user.api.js';

const state = {
    /*
      Defines the state being monitored for the module.
    */
    user: null,
    users: [],

    creatingUser: {
        genre: null,
        username: null,
        firstname: null,
        lastname: null,
        email: null,
        phone: null,
        address: null,
        zipcode: null,
        city: null,
        company: null,
        holder: null,
        card: null,
        password: null,
        password_confirmation: null,
        role_id: 3,
    },
};

const getters = {
    /*
         Returns the locations.
       */
    getUser( state ){
        return state.user;
    },

    /*
         Returns the locations.
       */
    getUsers( state ){
        return state.users;
    },

    /*
      Returns the location
    */
    getCreatingUser( state ){
        return state.creatingUser;
    }
};

const mutations = {

    /*
          Sets the locations
        */
    SET_USER( state, user ){
        state.user = user;
    },

    /*
      Set the location
    */
    SET_USERS( state, users ){
        state.users = users;
    },

    /*
      Set the location
    */
    SET_VALUE( state, key, value ){
        state.key = value;
    },

    SET_CREATING_USER( state, creatingUser ){
        state.creatingUser = creatingUser;
    },
/*
    ADD_CREATING_LOCATION_FILE(state, file){
        state.creatingLocation.images.push(file);
    },

    REMOVE_CREATING_LOCATION_FILE(state, key){
        state.creatingLocation.images.splice( key, 1 );
    }*/
};

const actions = {
    resetCreatingUser({ commit }) {
        const creatingUser =  {
            genre: null,
            firstname: null,
            lastname: null,
            username: null,

            email: null,
            password: null,

            phone: null,

            company: null,
            holder: null,
            card: null,

            address: null,
            zipcode: null,
            city: null,

            role_id: null,

        };
        return commit('SET_VALUE', { key: 'creatingUser', value: creatingUser });
    },

    /*
          Loads the locations from the API
        */
    loadUsers( { commit } ){
        console.log('load Users');
        UserAPI.getUsers()
            .then( function( response ){
                commit( 'SET_USERS', response.data );
            })
            .catch( function(){
                commit( 'SET_USERS', [] );
            });
    },

    /*
      Loads an individual location from the API
    */
    loadUser( { commit } ){
        UserAPI.getUser()
            .then( function( response ){
                commit( 'SET_USER', response.data );
            })
            .catch( function(){
                commit( 'SET_USER', null );
            });
    },

    /*
      Loads an individual location from the API
    */
    loadCreatingUser( { commit } ){
        commit( 'SET_CREATING_USER', getCreatingUser );
    },

    createUser( { commit, dispatch } ){
        console.log('create user');
        console.log(state.creatingUser);
        let value = null;
        let ok = false;
        let result = null;
        UserAPI.createUser(state.creatingUser).then((response) => {
            console.log(state.creatingUser);
            console.log(response);
            value = response.data && response.data.content;
            ok = !!value;
            result = response;
        }).catch((error) => {
            result = error.response;
        }).finally(() => {
            dispatch('resetCreatingUser');

        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
