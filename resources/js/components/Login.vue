<template>
    <v-layout row justify-center>
        <v-dialog v-model="mlogin" persistent max-width="600px">
            <v-btn round color="white" slot="activator"  light>Login</v-btn>
            <v-card>
                <v-card-title>
                    <span class="headline">Login</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field v-model="email" label="Email*" required></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="password" label="Password*" type="password" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="mlogin = false">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click="login">Sign in</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        data: () => ({
            mlogin: false,
            email: "",
            password: "",
        }),
        methods: {
            login() {
                console.log('test login');
                console.log(this.$data);
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then(() => {
                    window.location.href = '/home';
                });
            }
        },
    }
</script>

<style scoped>

</style>