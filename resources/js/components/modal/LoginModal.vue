<template>
    <v-dialog v-model="loginModal" max-width="500px">
        <v-btn class="btn-box-shadow-primary" round slot="activator" color="#42DCA3" depressed dark>Connexion</v-btn>
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">Connexion</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="loginModal = false">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text class="pt-0 pb-0">
                <v-container grid-list-md class="pt-0 pb-0">
                    <v-layout row justify-center>
                        <v-flex xs12 md8>
                            <v-text-field color="#42DCA3" v-model="email" label="Email*" required></v-text-field>
                            <v-text-field color="#42DCA3" v-on:keyup.enter="login" v-model="password" label="Password*" type="password" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-text class="align-center pt-0 pb-0">
                <v-container class="text-md-center">
                    <p><a @click="forgotForm"> <v-icon v-if="hover" color="#00e094" small light>keyboard_arrow_right</v-icon> <span @mouseover="hover = true" @mouseleave="hover = false">Mot de passe oublié ?</span> </a></p>
                    <v-btn color="#42DCA3" round dark class="btn-box-shadow-primary"  @click="login">Connexion</v-btn>
                </v-container>
            </v-card-text>
            <v-card-text class="pt-0 pb-0">
                <v-container class="text-md-center">
                    <p>Vous n'avez pas de compte ?</p>
                    <v-btn color="#2196F3" round dark class="btn-box-shadow-secondary" @click="registerForm">S'enregistrer</v-btn>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: 'LoginModal',
    data: function (){
        return {
            hover: false,
            drawer: null,
            loginModal: false,
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
        mouseOver: function(){
            this.active = !this.active;
        },
        show() {
            this.loginModal = true
        },
        hide(){
            this.loginModal = false
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
            this.forgotModal = false,
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
    }
}
</script>

<style scoped>

</style>
