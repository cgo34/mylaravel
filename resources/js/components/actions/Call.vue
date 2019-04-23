<template>
    <!-- becall modal -->
    <v-dialog v-model="becallModal" v-click-outside="outside" max-width="600px">
        <v-card>
            <v-toolbar dark color="#65D6B5">

                <v-toolbar-title class="text-uppercase">Être-rappelé</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="hide()">
                    <v-icon>close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 md12 text-xs-center>
                            <v-radio-group v-model="call.client.genre" row>
                                <v-radio label="Mademoiselle" value="mademoiselle"></v-radio>
                                <v-radio label="Madame" value="madame"></v-radio>
                                <v-radio label="Monsieur" value="monsieur"></v-radio>
                            </v-radio-group>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field label="Prénom*" v-model="call.client.firstname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field label="Nom*" v-model="call.client.lastname"required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Email*" v-model="call.client.email" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Téléphone*" v-model="call.client.phone" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field v-model="call.client.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="call.client.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="call.client.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="callClient()">Être rappelé</v-btn>

            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- End becall modal -->
</template>

<script>
    export default {
        name: "Call",
        props: ['idProgramme', 'nameProgramme', 'idLot', 'numberLot', 'becallModal'],
        data: function () {
            return {
                call: {
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
                this.$emit('update:becallModal', false);
                this.$emit('update:becallModall', false);
            },
            callClient() {
                var _this = this;
                console.log(_this.call);
                axios.post('/action/call', _this.call ).then((response) => {
                    this.$emit('update:becallModal', false);
                    this.$emit('update:becallModall', false);
                    this.call = {}; //Clear input fields.
                    this.$emit('update:becallModal', false);
                    flash('Votre demande de rappel à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            outside: function(e) {
                this.$emit('update:becallModal', false);
                this.$emit('update:becallModall', false);
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