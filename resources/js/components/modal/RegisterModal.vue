<template>
    <v-dialog class="registerFormModal" v-model="registerModal2"  max-width="800px">
        <!--<v-btn class="btn-box-shadow-primary" round flat outline color="#00e094" slot="activator" light><span>S'enregistrer</span></v-btn>-->
        <v-btn class="no-underline font-weight-bold" round large color="#fff" slot="activator"><span class="black--text">Je m'inscris</span></v-btn>
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">S'enregistrer</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="registerModal2 = false">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-tabs
                centered
                icons-and-text
                v-model="active"
            >
                <v-tabs-slider color="#00e094"></v-tabs-slider>
                <v-tab
                    v-for="n in roles"
                    :key="n.id"
                    v-if="n.name === 'professional' || n.name === 'particular'"
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
                        <v-card-text class="pt-0 pb-0">
                            <v-container grid-list-md class="pt-0 pb-0">
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>

                                        <v-radio-group v-model="particular.genre" row>
                                            <v-radio color="#00e094" label="Mademoiselle" value="mademoiselle"></v-radio>
                                            <v-radio color="#00e094" label="Madame" value="madame"></v-radio>
                                            <v-radio color="#00e094" label="Monsieur" value="monsieur"></v-radio>
                                        </v-radio-group>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>
                                        <v-text-field color="#00e094" v-model="particular.username" label="Nom d'utilisateur*" :rules="[rules.username]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>
                                        <v-text-field color="#00e094" v-model="particular.address" label="Adresse*" :rules="[rules.address]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.zipcode" label="Code postal*" :rules="[rules.zipcode]" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="particular.city" label="Ville*" :rules="[rules.city]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field
                                            color="#00e094"
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
                                    <v-flex xs12 md4>
                                        <v-text-field
                                            color="#00e094"
                                            v-on:keyup.enter="validateParticular"
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
                                <v-layout row justify-center>
                                    <v-flex md8>
                                        <small>*indicates required field</small>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>

                        <v-card-text class="align-center pt-0 pb-0">
                            <v-container class="text-md-center">
                                <v-btn
                                    :disabled="!validParticular"
                                    color="#00e094"
                                    class="btn-box-shadow-primary"
                                    @click="validateParticular"
                                    dark
                                    round
                                >S'enregistrer</v-btn>
                            </v-container>
                        </v-card-text>
                    </v-form>
                </v-tab-item>
                <v-tab-item>
                    <v-form
                        ref="formProfessional"
                        v-model="validProfessional"
                        lazy-validation
                    >
                        <v-card-text>
                            <v-container grid-list-md class="pt-0 pb-0">
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>

                                        <v-radio-group v-model="professional.genre" row>
                                            <v-radio color="#00e094" label="Mademoiselle" value="mademoiselle"></v-radio>
                                            <v-radio color="#00e094" label="Madame" value="madame"></v-radio>
                                            <v-radio color="#00e094" label="Monsieur" value="monsieur"></v-radio>
                                        </v-radio-group>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>
                                        <v-text-field color="#00e094" v-model="professional.username" label="Nom d'utilisateur*" :rules="[rules.username]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.firstname" label="First name*" :rules="[rules.firstname]" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.lastname" label="Last name*" :rules="[rules.lastname]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.email" label="Email*" :rules="[rules.required, rules.email]" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.phone" label="Phone*" :rules="[rules.phone]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>
                                        <v-text-field color="#00e094" v-model="professional.address" label="Adresse*" :rules="[rules.address]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.zipcode" label="Code postal*" :rules="[rules.zipcode]" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-text-field color="#00e094" v-model="professional.city" label="Ville*" :rules="[rules.city]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8>
                                        <v-text-field color="#00e094" v-model="professional.company" label="Cabinet professionnel*" :rules="[rules.cabinet]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row align-center justify-center>
                                    <v-flex xs12 md5>
                                        <label class="v-label theme--light">Êtes vous titulaire d'une carte de transaction ?</label>
                                    </v-flex>
                                    <v-flex xs12 md3 text-xs-center>
                                        <v-radio-group v-model="professional.holder" row>
                                            <v-radio color="#00e094" label="Oui" value="true"></v-radio>
                                            <v-radio color="#00e094" label="Non" value="false"></v-radio>
                                        </v-radio-group>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md8 v-if="professional.holder === 'true'">
                                        <v-text-field color="#00e094" v-model="professional.card" label="Carte*" :rules="[rules.required, rules.carte]" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row justify-center>
                                    <v-flex xs12 md4>
                                        <!--<v-text-field v-model="particular.password" label="Password*" type="password" required></v-text-field>-->
                                        <v-text-field
                                            color="#00e094"
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
                                    <v-flex xs12 md4>
                                        <!--<v-text-field v-model="particular.password_confirmation" label="Confirm Password*" type="password" required></v-text-field>-->
                                        <v-text-field
                                            color="#00e094"
                                            v-on:keyup.enter="validateProfessional"
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
                                <v-layout row justify-center>
                                    <v-flex md8>
                                        <small>*indicates required field</small>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>

                        <v-card-text class="align-center pt-0 pb-0">
                            <v-container class="text-md-center">
                                <v-btn
                                    :disabled="!validProfessional"
                                    color="#00e094"
                                    class="btn-box-shadow-primary"
                                    @click="validateProfessional"
                                    dark
                                    round
                                >S'enregistrer</v-btn>
                            </v-container>
                        </v-card-text>
                    </v-form>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </v-dialog>
</template>


<script>
export default {
    name: 'RegisterModal',
    data: function (){
        return {
            hover: false,
            drawer: null,
            validParticular: true,
            validProfessional: true,
            registerModal2: false,
            showPassword: false,
            active: 0,
            roles: {},
            countRoles: null,
            users: [],
            user: false,
            civilites: ['Mademoiselle', 'Madame', 'Monsieur'],
            particular: { genre: '', username: '', firstname: '', lastname: '', email: '', phone: '', address: '', zipcode: '', city: '', company: '', holder: '', card: '', password: '', password_confirmation: '', role_id: 2},
            professional: { genre: '', username: '', firstname: '', lastname: '', email: '', phone: '', address: '', zipcode: '', city: '', company: '', holder: '', card: '', password: '', password_confirmation: '', role_id: 3},
            promoteur: { name: '', email: '', password: '', password_confirmation: '', role_id: 4},
            hasErrors: { genre: false, firstname: false, lastname: false, email: false, phone: false, password: false, password_confirmation: false, role_id: false },
            validation: { genre: '', firstname: '', lastname: '', email: '', phone: '', password: '', password_confirmation: '', role_id: ''},
            errorMessage: { genre: null, firstname: null, lastname: null, email: null, phone: null, password: null, password_confirmation: null, role_id: null },
            errors:[],
            rules: {
                required: value => !!value || 'Required.',
                min: value => value.length >= 6 || '6 caractères minimum',
                username: value => !!value || 'Le nom d\'utilisateur est obligatoire',
                civilite: value => !!value || 'La civilité est obligatoire',
                firstname: value => !!value || 'Le prénom est obligatoire',
                lastname: value => !!value || 'Le nom est obligatoire',
                phone: value => !!value || 'Le téléphone est obligatoire',
                address: value => !!value || 'L\'adresse est obligatoire',
                zipcode: value => !!value || 'Le code postal est obligatoire',
                city: value => !!value || 'La ville est obligatoire',
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
        mouseOver: function(){
            this.active = !this.active;
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
        registerForm() {
            this.registerModal2 = true;
        },
        registerParticular() {
            var _this = this
            axios.post('/register', _this.particular).then(response => {
                this.particular = {}; //Clear input fields.
                this.registerModal2 = false;
                window.location.href = "/email/verify";
            }).catch(error => {
                console.log(_this.particular);
                console.log('POST /register => error');
                var errors = error.response;
                console.log(errors);
            });
        },
        registerProfessional() {
            //this.validateProfessional();
            var _this = this;
            console.log(_this.professional);
            axios.post('/register', _this.professional).then(response => {

                console.log(response);
                this.professional = {}; //Clear input fields.
                this.registerModal2 = false;
                window.location.href = "/email/verify";
            }).catch(error => {
                console.log(_this.professional);
                console.log('POST /register => error');
                var errors = error.response;
                console.log(errors);
            });
        },
    }
}
</script>

<style scoped>
    button {
        font-family: 'Montserrat' !important;
    }
</style>
