<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-btn outline round color="white" slot="activator"  dark>Register</v-btn>

            <v-card>
                <v-card-title centered
                              dark
                              icons-and-text>
                    <span class="headline">Register</span>
                </v-card-title>




                <v-tabs
                        centered
                        dark
                        icons-and-text
                >
                    <v-tabs-slider color="orange"></v-tabs-slider>

                    <v-tab  href="#">
                        Particulier
                        <v-icon>person</v-icon>
                    </v-tab>

                    <v-tab href="#">
                        Professionnel
                        <v-icon>work</v-icon>
                    </v-tab>

                    <v-tab href="#">
                        Promoteur
                        <v-icon>location_city</v-icon>
                    </v-tab>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field v-model="name" label="Name*" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12>
                                        <v-text-field v-model="email" label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="password" label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="register">Sign up</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field label="Name*" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12>
                                        <v-text-field label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="dialog = false">Sign up</v-btn>
                        </v-card-actions>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field label="Name*" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12>
                                        <v-text-field label="Email*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Password*" type="password" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Confirm Password*" type="password" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                            <v-btn color="blue darken-1" flat @click="dialog = false">Sign up</v-btn>
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
                dialog: false,
                users: [],
                user: { name: '', email: '', password: ''},
                userSave: {},
                success: false,
                danger: false,
                edition: false,
                validation: { name: '', email: ''},
                name: '',
                email: '',
                password: '',


            }
        },
        mounted () {
            this.resource = this.$resource('/users{/id}')
            this.resource.get().then((response) => {
                this.users = response.body;
            })
        },
        methods: {
            add () {
                this.resource.save(this.user).then((response) => {
                    this.users.push(this.user)
                    this.user = { name: '', email: '' }
                    console.log(user)
                })
            },
            register() {
                console.log('test register');
                console.log(this.$data);
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then(() => {
                        this.users.push(new User(name, email, password)),
                        window.location.href = '/home';
                    });
            }
        }
    }
</script>

<style scoped>

</style>