<template>
    <!-- denonce modal -->
    <v-dialog v-model="denonceModal"  v-click-outside="outside" max-width="600px">
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">Dénoncer un client</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="hide()">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
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
            <v-card-text class="align-center pt-0 pb-0">
                <v-container class="text-md-center">
                    <v-btn color="#D81B60" round dark class="btn-box-shadow-secondary"  @click.stop="denonceClient()">Dénoncer</v-btn>
                </v-container>
            </v-card-text>
            <v-card-text>
                <p><small>Les données signalées ci-dessus par un astérisque sont nécessaires
                    pour nous permettre de répondre à votre demande de rappel.
                    Elles sont collectées et traitées informatiquement par Galileo (société du groupe EFFICIENCE GROUPE)
                    uniquement sur la base de votre consentement et sont destinées à ses services internes
                    et à ses sous-traitants techniques, aux seules fins de répondre à votre demande.
                    Ces informations ne font l’objet d’aucun transfert en dehors du territoire de l’UE.
                    Vos données sont conservées pendant le seul délai nécessaire à la gestion de votre demande,
                    et si vous y consentez ci-avant, dans le cadre de nos opérations de prospection commerciale
                    à concurrence d’un délai de 3 ans au terme duquel elles sont définitivement effacées
                    sauf en cas de nouvelle demande de votre part. En application de la règlementation applicable
                    à la protection des données personnelles, vous disposez sur ces données de droits (i)
                    d’accès, (ii) de rectification, (iii) d’effacement, (iv) de limitation et (v)
                    de portabilité vers un prestataire tiers le cas échéant. Vous pouvez en outre
                    vous opposer à tout moment au traitement de vos données.
                    Vous pourrez faire valoir ces droits en écrivant au DPO à dpo@galileo.immo,
                    en justifiant de votre identité. En cas de litige, vous disposez également du droit de saisir
                    la CNIL.</small></p>
            </v-card-text>
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
                console.log(_this.denonce);
                axios.post('/action/denonce', _this.denonce ).then((response) => {
                    console.log(response);
                    if(response.status === 200){
                        this.denonce.client = {}; //Clear input fields.
                        this.$emit('update:denonceModal', false);
                        flash('Votre dénonce à bien été prise en compte.', 'success');
                    }

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
