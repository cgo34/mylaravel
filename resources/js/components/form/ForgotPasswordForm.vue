<template>
    <v-card>
        <v-card-title class="pt-4" style="display:block; text-align: center;">
            <h2 class="primary-color text-uppercase font-weight-bold">Mot de passe oublié ?</h2>
        </v-card-title>
        <v-card-text class="pt-0 pb-0">
            <v-container grid-list-md class="pt-0 pb-0">
                <v-layout row justify-center>
                    <v-flex xs12 md8>
                        <p class="text-md-center">Entrez l'adresse e-mail que vous utilisez pour vous connecter afin de recevoir un e-mail vous permettant de changer de mot de passe.</p>
                        <v-text-field color="#42DCA3" v-model="forgotPassword" label="Email*" required></v-text-field>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>
        <v-card-text class="align-center pt-0 pb-0">
            <v-container class="text-md-center">
                <p><a @click="loginForm"> <v-icon v-if="hover" color="#42DCA3" small light>keyboard_arrow_right</v-icon> <span @mouseover="hover = true" @mouseleave="hover = false">Retour à la connexion ?</span> </a></p>
                <v-btn color="#42DCA3" round dark class="btn-box-shadow-primary"  @click="forgot">Envoyer l'email</v-btn>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "ForgotPasswordForm",
    data: function (){
        return {
            hover: false,
            forgotPassword: "",
        }

    },
    methods: {
        loginForm() {
            window.location.href = '/login';
        },
        registerForm() {
            window.location.href = '/register';
        },
        forgotForm() {
            window.location.href = '/password/reset';
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
};
</script>

<style scoped>

</style>
