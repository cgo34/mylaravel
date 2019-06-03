<template>
    <div>
        <v-dialog v-model="loginModal" max-width="500px">
            <v-btn round slot="activator" color="#42DCA3" dark>Connexion</v-btn>
            <v-card>
                <v-toolbar dark color="#42DCA3">

                    <v-toolbar-title class="text-uppercase">Connexion</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="loginModal = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-card-text >
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field  v-model="email" label="Email*" required></v-text-field>
                                <v-text-field  v-model="password" label="Password*" type="password" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-btn flat @click="forgotForm"> <v-icon light>keyboard_arrow_right</v-icon> Mot de passe oublié ? </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="#42DCA3" round dark @keyup.enter="login" @click="login">Connexion</v-btn>
                </v-card-actions>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <p class="text-md-center">Vous n'avez pas de compte ?</p>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="warning" round @click="registerForm">S'enregistrer</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Sign Up Modal (REGISTER) -->
        <v-dialog class="registerFormModal" v-model="registerModal"  max-width="800px">
            <v-btn round  outline color="#42DCA3" slot="activator" light><span>S'enregistrer</span></v-btn>
            <v-card>
                <v-toolbar dark color="#42DCA3">

                    <v-toolbar-title class="text-uppercase">S'enregistrer</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="registerModal = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                </v-toolbar>
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
                        <v-form
                            ref="formParticular"
                            v-model="validParticular"
                            lazy-validation
                        >
                            <v-card-text>
                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12 md12 text-xs-center>

                                            <v-radio-group v-model="particular.civilite" row>
                                                <v-radio label="Mademoiselle" value="mademoiselle"></v-radio>
                                                <v-radio label="Madame" value="madame"></v-radio>
                                                <v-radio label="Monsieur" value="monsieur"></v-radio>
                                            </v-radio-group>
                                        </v-flex>

                                        <v-flex xs12 md6>
                                            <v-text-field v-model="particular.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="particular.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="particular.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="particular.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                                            <!--<vue-tel-input v-model="particular.phone"
                                                           @onInput="onInput"
                                                           :preferredCountries="['fr', 'us', 'gb', 'ua']">
                                            </vue-tel-input>-->
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <!--<v-text-field v-model="particular.password" label="Password*" type="password" required></v-text-field>-->
                                            <v-text-field
                                                v-model="particular.password"
                                                :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                :rules="[rules.required, rules.min]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="password"
                                                label="Password*"
                                                hint="Au moins 6 caractères"
                                                counter
                                                @click:append="showPassword = !showPassword"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <!--<v-text-field v-model="particular.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>-->
                                            <v-text-field
                                                v-model="particular.password_confirmation"
                                                :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                :rules="[rules.required, rules.min]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="password_confirmation"
                                                label="Password*"
                                                hint="Au moins 6 caractères"
                                                counter
                                                @click:append="showPassword = !showPassword"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                                <small>*indicates required field</small>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="!validParticular"
                                       color="teal"
                                       @click="validateParticular"
                                       dark
                                >S'enregistrer</v-btn>
                                <v-btn color="warning" dark @click="loginForm">Connexion</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-tab-item>
                    <v-tab-item>
                        <v-form
                            ref="formProfessional"
                            v-model="validProfessional"
                            lazy-validation
                        >
                            <v-card-text>
                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12 md12 text-xs-center>

                                            <v-radio-group v-model="professional.genre" row>
                                                <v-radio label="Mademoiselle" value="mademoiselle"></v-radio>
                                                <v-radio label="Madame" value="madame"></v-radio>
                                                <v-radio label="Monsieur" value="monsieur"></v-radio>
                                            </v-radio-group>
                                        </v-flex>
                                        <v-flex xs12 md12>
                                            <v-text-field v-model="professional.username" label="Nom d'utilisateur*" :rules="[rules.username]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                                            <!--<vue-tel-input v-model="particular.phone"
                                                           @onInput="onInput"
                                                           :preferredCountries="['fr', 'us', 'gb', 'ua']">
                                            </vue-tel-input>-->
                                        </v-flex>
                                        <v-flex xs12 md12>
                                            <v-text-field v-model="professional.address" label="Adresse*" :rules="[rules.address]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.zipcode" label="Code postal*" :rules="[rules.zipcode]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-text-field v-model="professional.city" label="Ville*" :rules="[rules.city]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md12>
                                            <v-text-field v-model="professional.company" label="Cabinet professionnel*" :rules="[rules.cabinet]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md4 text-xs-center>
                                            <p>Êtes vous titulaire d'une carte de transaction ?</p>
                                        </v-flex>
                                        <v-flex xs12 md4 text-xs-center>
                                            <v-radio-group v-model="professional.holder" row>
                                                <v-radio label="Oui" value="true"></v-radio>
                                                <v-radio label="Non" value="false"></v-radio>
                                            </v-radio-group>
                                        </v-flex>
                                        <v-flex xs12 md4 v-if="professional.holder === 'true'">
                                            <v-text-field v-model="professional.card" label="Carte*" :rules="[rules.required, rules.carte]" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <!--<v-text-field v-model="particular.password" label="Password*" type="password" required></v-text-field>-->
                                            <v-text-field
                                                v-model="professional.password"
                                                :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                :rules="[rules.required, rules.min]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="password"
                                                label="Password*"
                                                hint="Au moins 6 caractères"
                                                counter
                                                @click:append="showPassword = !showPassword"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <!--<v-text-field v-model="particular.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>-->
                                            <v-text-field
                                                v-model="professional.password_confirmation"
                                                :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                :rules="[rules.required, rules.min]"
                                                :type="showPassword ? 'text' : 'password'"
                                                name="password_confirmation"
                                                label="Password*"
                                                hint="Au moins 6 caractères"
                                                counter
                                                @click:append="showPassword = !showPassword"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                                <small>*indicates required field</small>
                            </v-card-text>
                            <v-card-actions>

                                <v-spacer></v-spacer>
                                <v-btn :disabled="!validProfessional"
                                       color="teal"
                                       @click="validateProfessional"
                                       dark
                                >S'enregistrer</v-btn>
                                <v-btn color="warning" dark @click="loginForm">Connexion</v-btn>
                            </v-card-actions>
                        </v-form>
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
                            <v-btn color="blue darken-1" flat @click="registerParticular">S'enregistrer</v-btn>
                            <v-btn color="warning" flat @click="loginForm">Connexion</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                </v-tabs>

            </v-card>
        </v-dialog>
        <!-- forgot password Modal -->
        <v-dialog v-model="forgotModal"  max-width="500px">
            <v-btn flat color="pink accent-2" slot="activator" class="forgot-password"  dark>Mot de passe oublié ?</v-btn>
            <v-card>
                <v-toolbar dark color="#42DCA3">

                    <v-toolbar-title class="text-uppercase">Mot de passe oublié ?</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="forgotModal = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <p class="text-md-center">Entrez l'adresse e-mail que vous utilisez pour vous connecter afin de recevoir un e-mail vous permettant de changer de mot de passe.</p>
                            <v-flex xs12>
                                <v-text-field outline v-model="forgotPassword" label="Email*" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" round dark @click="forgot">Envoyer l'email</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: 'LoginWhite',
    data: function (){
        return {
            drawer: null,
            validParticular: true,
            validProfessional: true,
            loginModal: false,
            registerModal: false,
            forgotModal: false,
            forgotPassword: "",
            showPassword: false,
            email: '',
            password: '',
            active: 0,
            roles: {},
            countRoles: null,
            users: [],
            user: false,
            civilites: ['Mademoiselle', 'Madame', 'Monsieur'],
            particular: { genre: '', firstname: '', lastname: '', email: '', phone: '', company: '', holder: '', card: '', password: '', password_confirmation: '', role_id: 2},
            professional: { genre: '', username: '', firstname: '', lastname: '', email: '', phone: '', address: '', zipcode: '', city: '', company: '', holder: '', card: '', password: '', password_confirmation: '', role_id: 3},
            promoteur: { name: '', email: '', password: '', password_confirmation: '', role_id: 4},
            hasErrors: { genre: false, firstname: false, lastname: false, email: false, phone: false, password: false, password_confirmation: false, role_id: false },
            validation: { genre: '', firstname: '', lastname: '', email: '', phone: '', password: '', password_confirmation: '', role_id: ''},
            errorMessage: { genre: null, firstname: null, lastname: null, email: null, phone: null, password: null, password_confirmation: null, role_id: null },
            errors:[],
            rules: {
                required: value => !!value || 'Required.',
                min: value => value.length >= 6 || '6 caractères minimum',
                civilite: value => !!value || 'La civilité est obligatoire',
                firstname: value => !!value || 'Le prénom est obligatoire',
                lastname: value => !!value || 'Le nom est obligatoire',
                phone: value => !!value || 'Le téléphone est obligatoire',
                cabinet: value => !!value || 'Le cabinet est obligatoire',
                titulaire: value => !!value || 'Veuillez renseigner si vous êtes titulaire',
                carte: value => !!value || 'Le numéro de carte est obligatoire',
                password: value => !!value || 'Le mot de passe est obligatoire',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'Invalid e-mail.'
                },
                //passwordMatch: value => !!value || ('The password and confirm password you entered don\'t match'),
            },
        }

    },
    mounted () {
        axios.get('/roles').then((response) => {
            this.roles = response.data;

        }).catch(error => {
            console.log(error.response);
        });
    },
    methods: {
        show() {
            this.loginModal = true
        },
        hide(){
            this.loginModal = false
        },
        validateParticular () {
            if (this.$refs.formParticular.validate()) {
                this.snackbar = true
                this.registerParticular();
                console.log('no errors in particular form');
            }else{
                console.log('error in particular form');
            }
        },
        validateProfessional () {
            if (this.$refs.formProfessional.validate()) {
                this.snackbar = true
                this.registerProfessional();
                console.log('no errors in professional form');
            }else{
                console.log('error in professional form');
            }
        },
        onInput({ number, isValid, country }) {
            console.log(number, isValid, country);
        },
        login() {
            console.log('test login');
            console.log(this.$data);
            console.log(this.email);
            console.log(this.password);
            axios.post('/login', {
                email: this.email,
                password: this.password
            }).then((response) => {
                console.log('test connexion');
                console.log(this.email);
                console.log(this.password);
                console.log(response);

                this.email = '';
                this.password = '';

                this.user = true;
                this.users = response.data;
                //this.loginModal = false;

                this.loginModal = false;
                var current = window.location.href;
                document.location.href = current;
                console.log(this.user);

            }).catch(error => {
                console.log(error.response);
                console.log(error.response.data.errors);
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    console.log(this.errors);
                }
            });
        },
        loginForm() {
            this.registerModal = false;
            this.loginModal = true;
        },
        forgotForm() {
            this.registerModal = false;
            this.loginModal = false;
            this.forgotModal = true;
        },
        forgot() {
            axios.post('/password/email', {
                email: this.forgotPassword,
            }).then(() => {
                //window.location.href = '/home';
                console.log('envoi du mail de reinitialsiation');
            }).catch(error => {
                var errors = error.response;
                console.log(errors);
            });
        },
        registerForm() {
            this.loginModal = false;
            this.registerModal = true;
        },
        registerParticular() {
            var _this = this
            axios.post('/register', _this.particular).then(response => {
                this.particular = {}; //Clear input fields.
                this.registerModal = false;
                window.location.href = "/email/verify";
            }).catch(error => {
                this.loaded = true;
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    console.log(this.errors);
                }
                var errors = error.response;
                if(errors.statusText === 'Unprocessable Entity'){
                    if(errors.data){

                        this.errors = [];
                        if(!this.particular.civilite) this.errors.push("Civilité required.");
                        if(!this.particular.firstname) this.errors.push("Firstname required.");

                        if(errors.data.civilite){
                            vm.particular.civilite = true
                            _vm.particular.civilite = _.isArray(errors.data.civilite) ? errors.data.civilite[0]: errors.data.civilite
                        }
                        if(errors.data.firstname){
                            vm.particular.firstname = true
                            _vm.particular.firstname = _.isArray(errors.data.firstname) ? errors.data.firstname[0]: errors.data.firstname
                        }
                        if(errors.data.lastname){
                            vm.particular.lastname = true
                            _vm.particular.lastname = _.isArray(errors.data.lastname) ? errors.data.lastname[0]: errors.data.lastname
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
            //this.validateProfessional();
            var _this = this;
            console.log(_this.professional);
            axios.post('/register', _this.professional).then(response => {

                console.log(response);
                this.professional = {}; //Clear input fields.
                this.registerModal = false;
                window.location.href = "/email/verify";
            }).catch(error => {
                console.log(_this.professional);
                console.log('POST /register => error');
                var errors = error.response;
                console.log(errors);
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
    .registerFormModal { z-index: inherit }
    .forgot-password { display: none;}
    .v-menu__content {
        position: inherit; max-height: 300px;min-width: 1110px;top: 35px;left: 0;transform-origin: left top 0px;z-index: 204;
    }
    .primary-border-gradient-invert span {
        align-items: center;
        background: #fff;
        color: #42DCA3;
        border-radius: 40px;
        display: flex;
        justify-content: center;
        transition: background .5s ease;
        width: 100%;
        padding: 0 15px;
        height: 32px;
    }

    .primary-border-gradient-invert:hover span {
        background: transparent;
        transition: background .5s ease;
        color: #fff;
    }
    
    .v-btn--outline {
        background: #fff !important;
    }
</style>
