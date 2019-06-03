<template>
    <v-card>
        <v-card-title class="pt-4" style="display:block; text-align: center;">
            <h2 class="primary-color text-uppercase font-weight-bold">Connexion</h2>
            <v-divider></v-divider>
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
                <p><a @click="forgotForm"> <v-icon v-if="hover" color="#42DCA3" small light>keyboard_arrow_right</v-icon> <span @mouseover="hover = true" @mouseleave="hover = false">Mot de passe oublié ?</span> </a></p>
                <v-btn color="#42DCA3" round dark class="btn-box-shadow-primary"  @click="login">Connexion</v-btn>
            </v-container>
        </v-card-text>
        <v-card-text class="pt-0 pb-0">
            <v-container class="text-md-center">
                <p>Vous n'avez pas de compte ?</p>
                <v-btn color="#D81B60" round dark class="btn-box-shadow-secondary" @click="registerForm">S'enregistrer</v-btn>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "LoginForm",
    data: function (){
        return {
            hover: false,
            showPassword: false,
            email: '',
            password: '',
        }
    },
    methods: {
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
            window.location.href = '/login';
        },
        registerForm() {
            window.location.href = '/register';
        },
        forgotForm() {
            window.location.href = '/password/reset';
        },
    }
};
</script>

<style scoped>

</style>
