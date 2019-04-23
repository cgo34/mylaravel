<template>
    <v-layout row justify-center>
        <v-dialog v-model="mregister" persistent >
            <v-btn primary round color="white" slot="activator"  light>Register</v-btn>

            <v-card>
                <v-toolbar dark color="blue lighten-2">

                    <v-toolbar-title class="uppercase">Register</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="mregister = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                </v-toolbar>
                <!--<v-card-title
                              centered
                              color="white"
                              light
                              class="headline blue lighten-2"
                              primary-title
                              icons-and-text>
                    <span class="headline">Register</span>
                </v-card-title>-->



                <v-tabs
                        centered
                        icons-and-text
                        v-model="active"
                >
                    <v-tabs-slider color="orange"></v-tabs-slider>
                    <v-tab
                            v-for="n in roles"
                            :key="n.id"
                    >
                        {{ n.display_name }}
                        <v-icon v-if="n.name === 'particular'">
                            person
                        </v-icon>
                        <v-icon v-else-if="n.name === 'professional'">
                            work
                        </v-icon>
                        <v-icon v-else-if="n.name === 'promoteur'">
                            location_city
                        </v-icon>
                    </v-tab>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 md12 d-flex>
                                        <v-select

                                                :items="['Mademoiselle', 'Madame', 'Monsieur']"
                                                label="Civilité*"
                                        ></v-select>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.firstname" label="First name*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.lastname" label="Last name*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.email" label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.phone" label="Phone*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.password" label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-text-field v-model="particular.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="mregister = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="registerParticular">Sign up</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field v-model="professional.name" label="Name*" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12>
                                        <v-text-field v-model="professional.email" label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="professional.password" label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="professional.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="mregister = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="registerProfessional">Sign up</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field v-model="promoteur.name" label="Name*" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12>
                                        <v-text-field v-model="promoteur.email" label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="promoteur.password" label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="promoteur.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="mregister = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="registerPromoteur">Sign up</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                </v-tabs>

            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        resource: null,
        data () {
            return {
                active: 0,
                mregister: false,
                roles: {},
                countRoles: null,
                users: [],
                civilites: ['Mademoiselle', 'Madame', 'Monsieur'],
                particular: { civilite: 'Monsieur', firstname: '', lastname: '', email: '', phone: '', password: '', password_confirmation: '', role_id: 2},
                professional: { name: '', email: '', password: '', password_confirmation: '', role_id: 3},
                promoteur: { name: '', email: '', password: '', password_confirmation: '', role_id: 4},
                hasErrors: { civilite: false, firstname: false, lastname: false, email: false, phone: false, password: false, password_confirmation: false, role_id: false },
                validation: { civilite: '', firstname: '', lastname: '', email: '', phone: '', password: '', password_confirmation: '', role_id: ''},
                errorMessage: { civilite: null, firstname: null, lastname: null, email: null, phone: null, password: null, password_confirmation: null, role_id: null }
            }
        },
        mounted () {
            var _this = this;
            axios.get('/roles')
                .then(function (response) {
                    _this.roles = response.data;
                    _this.countRoles = response.data.length;

                }).catch(function (error) {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });

        },
        methods: {
            registerParticular() {
                var _this = this
                var vm = this.hasErrors
                var _vm = this.errorMessage
                axios.post('/register', _this.particular).then(response => {
                    this.users = {}; //Clear input fields.
                    this.particular = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        console.log(this.errors);
                    }
                    var errors = error.response;
                    if(errors.statusText === 'Unprocessable Entity'){
                        if(errors.data){
                            if(errors.data.civilite){
                                vm.civilite = true
                                _vm.civilite = _.isArray(errors.data.civilite) ? errors.data.civilite[0]: errors.data.civilite
                            }
                            if(errors.data.firstname){
                                vm.firstname = true
                                _vm.firstname = _.isArray(errors.data.firstname) ? errors.data.firstname[0]: errors.data.firstname
                            }
                            if(errors.data.lastname){
                                vm.lastname = true
                                _vm.lastname = _.isArray(errors.data.lastname) ? errors.data.lastname[0]: errors.data.lastname
                            }
                            if(errors.data.email){
                                vm.email = true
                                _vm.email = _.isArray(errors.data.email) ? errors.data.email[0]: errors.data.email
                            }
                            if(errors.data.phone){
                                vm.phone = true
                                _vm.phone = _.isArray(errors.data.phone) ? errors.data.phone[0]: errors.data.phone
                            }
                            if(errors.data.password){
                                vm.password = true
                                _vm.password = _.isArray(errors.data.password) ? errors.data.password[0]: errors.data.password
                            }
                        }
                    }
                });
            },
            registerProfessional() {
                var _this = this
                var vm = this.hasErrors
                var _vm = this.errorMessage
                axios.post('/register', _this.professional).then(response => {
                    this.users = {}; //Clear input fields.
                    this.professional = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                    var errors = error.response;
                    if(errors.statusText === 'Unprocessable Entity'){
                        if(errors.data){
                            if(errors.data.name){
                                vm.name = true
                                _vm.name = _.isArray(errors.data.name) ? errors.data.name[0]: errors.data.name
                            }
                            if(errors.data.email){
                                vm.email = true
                                _vm.email = _.isArray(errors.data.email) ? errors.data.email[0]: errors.data.email
                            }
                            if(errors.data.password){
                                vm.password = true
                                _vm.password = _.isArray(errors.data.password) ? errors.data.password[0]: errors.data.password
                            }
                        }
                    }
                });
            },
            registerPromoteur() {
                var _this = this
                var vm = this.hasErrors
                var _vm = this.errorMessage
                axios.post('/register', _this.promoteur).then(response => {
                    this.users = {}; //Clear input fields.
                    this.promoteur = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                    var errors = error.response;
                    if(errors.statusText === 'Unprocessable Entity'){
                        if(errors.data){
                            if(errors.data.name){
                                vm.name = true
                                _vm.name = _.isArray(errors.data.name) ? errors.data.name[0]: errors.data.name
                            }
                            if(errors.data.email){
                                vm.email = true
                                _vm.email = _.isArray(errors.data.email) ? errors.data.email[0]: errors.data.email
                            }
                            if(errors.data.password){
                                vm.password = true
                                _vm.password = _.isArray(errors.data.password) ? errors.data.password[0]: errors.data.password
                            }
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>