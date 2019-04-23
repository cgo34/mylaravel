<template>
    <!-- contact modal -->
    <v-dialog v-model="contactModal"  v-click-outside="outside" max-width="600px">
        <v-card>
            <v-toolbar dark color="#65D6B5">

                <v-toolbar-title class="text-uppercase">Contactez-nous</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="hide()">
                    <v-icon>close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 md12 text-xs-center>

                            <v-radio-group v-model="contact.client.genre" row>
                                <v-radio label="Mademoiselle" value="mademoiselle"></v-radio>
                                <v-radio label="Madame" value="madame"></v-radio>
                                <v-radio label="Monsieur" value="monsieur"></v-radio>
                            </v-radio-group>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Prénom*" v-model="contact.client.firstname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Nom*" v-model="contact.client.lastname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Email*" v-model="contact.client.email" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Téléphone*" v-model="contact.client.phone" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field v-model="contact.client.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="contact.client.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="contact.client.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-textarea
                                    v-model="contact.client.message"
                                    name="message"
                                    label="Message"
                                    value=""
                            ></v-textarea>
                        </v-flex>

                    </v-layout>
                </v-container>
                <small>*indicates required field</small>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="contactClient()">Envoyer</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "Contact",
        props: ['idProgramme', 'nameProgramme', 'idLot', 'numberLot', 'contactModal'],
        data: function () {
            return {
                contact: {
                    'client': {
                        'genre': '', 'firstname': '', 'lastname': '', 'email': '', 'phone': '', 'address': '', 'zipcode': '', 'city': '', 'message': ''
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
                this.$emit('update:contactModal', false)
            },
            contactClient() {
                var _this = this;
                axios.post('/action/contact', _this.contact ).then((response) => {
                    this.contact = {}; //Clear input fields.
                    this.$emit('update:contactModal', false);
                    flash('Votre demande de contact à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            outside: function(e) {
                this.$emit('update:contactModal', false);
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