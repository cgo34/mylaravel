<template>
    <!-- denonce modal -->
    <v-dialog v-model="denonceModal"  v-click-outside="outside" max-width="600px">
        <v-card>
            <v-toolbar dark color="#65D6B5">

                <v-toolbar-title class="text-uppercase">Dénoncer un client</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-btn icon dark @click="hide();">
                    <v-icon>close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout>
                        <v-flex xs12 md12 text-xs-center>
                            <!--<flash message=""></flash>-->

                        </v-flex>
                    </v-layout>
                    <v-layout wrap class="denonce-form">
                        <v-flex xs12 md12 text-xs-center>

                            <v-radio-group v-model="denonce.client.genre" row>
                                <v-radio label="Mademoiselle" value="mademoiselle"></v-radio>
                                <v-radio label="Madame" value="madame"></v-radio>
                                <v-radio label="Monsieur" value="monsieur"></v-radio>
                            </v-radio-group>
                        </v-flex>

                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.firstname" label="First name*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.lastname" label="Last name*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.email" label="Email*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.phone" label="Phone*"  required></v-text-field>
                            <!--<vue-tel-input v-model="particular.phone"
                                           @onInput="onInput"
                                           :preferredCountries="['fr', 'us', 'gb', 'ua']">
                            </vue-tel-input>-->
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field v-model="denonce.client.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="denonce.client.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="denonceClient()">Dénoncer</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- End denonce modal -->
</template>

<script>
    export default {
        name: "Denonce",
        props: ['idProgramme', 'nameProgramme', 'idLot', 'numberLot', 'denonceModal'],
        data: function () {
            return {
                denonce: {
                    'client': {
                        'genre': '', 'firstname': '', 'lastname': '', 'email': '', 'phone': '', 'address': '', 'zipcode': '', 'city': ''
                    },
                    'programme': {
                        'id': this.idProgramme, 'name': this.nameProgramme
                    },
                    'lot': {
                        'id': this.idLot, 'number': this.numberLot
                    },
                },
            }
        },
        methods: {
            show(){},
            hide(){
                this.$emit('update:denonceModal', false);
            },
            denonceClient() {
                var _this = this;
                axios.post('/action/denonce', _this.denonce ).then((response) => {
                    this.denonce = {}; //Clear input fields.
                    this.$emit('update:denonceModal', false);
                    flash('Votre dénonce à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            outside: function(e) {
                this.$emit('update:denonceModal', false)
            },
        },
        directives: {
            'click-outside': {
                bind: function(el, binding, vNode) {
                    // Provided expression must evaluate to a function.
                    if (typeof binding.value !== 'function') {
                        const compName = vNode.context.name;
                        let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`;
                        if (compName) { warn += `Found in component '${compName}'` }

                        console.warn(warn);
                    }
                    // Define Handler and cache it on the element
                    const bubble = binding.modifiers.bubble;
                    const handler = (e) => {
                        if (bubble || (!el.contains(e.target) && el !== e.target)) {
                            binding.value(e);
                        }
                    }
                    el.__vueClickOutside__ = handler;

                    // add Event Listeners
                    document.addEventListener('click', handler);
                },

                unbind: function(el, binding) {
                    // Remove Event Listeners
                    document.removeEventListener('click', el.__vueClickOutside__);
                    el.__vueClickOutside__ = null;

                }
            }
        }
    }
</script>

<style scoped>

</style>