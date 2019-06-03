<template>
    <!-- becall modal -->
    <v-dialog v-model="becallModal" v-click-outside="outside" max-width="600px">
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">Être-rappelé</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="hide()">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container v-if="user" grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" label="Prénom*" v-model="client.firstname" v-bind:value="client.firstname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" label="Nom*" v-model="client.lastname"required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field color="#42DCA3" label="Email*" v-model="client.email" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field color="#42DCA3" label="Téléphone*" v-model="client.phone" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field color="#42DCA3" v-model="client.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="client.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="client.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-container v-else grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 md12 text-xs-center>

                            <v-radio-group v-model="client.genre" row>
                                <v-radio label="test" value="user.genre"></v-radio>
                                <v-radio :label="client.genre" value="user.genre"></v-radio>
                                <v-radio label="Monsieur" value="user.genre"></v-radio>
                            </v-radio-group>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" label="Prénom*"  v-model="user.firstname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" label="Nom*" v-model="user.lastname"required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field color="#42DCA3" label="Email*" v-model="user.email" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field color="#42DCA3" label="Téléphone*" v-model="user.phone" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field color="#42DCA3" v-model="user.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="user.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="user.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-text class="align-center pt-0 pb-0">
                <v-container class="text-md-center">
                    <v-btn color="#D81B60" round dark class="btn-box-shadow-secondary"  @click.stop="callClient()">Être rappelé</v-btn>
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
    <!-- End becall modal -->
</template>

<script>
    export default {
        name: "Call",
        props: ['idProgramme', 'nameProgramme', 'idLot', 'numberLot', 'becallModal', 'user'],
        data: function () {
            return {
                client: {},
                programme: {
                    'id': this.idProgramme, 'name': this.nameProgramme,
                },
                lot: {
                    'id': this.idLot, 'number': this.numberLot,
                },
            }
        },
        mounted() {
            if(typeof this.user === 'string'){
                this.client = JSON.parse(this.user);
            }else{
                this.client = this.user;
            }
        },
        methods: {
            show(){},
            hide(){
                this.$emit('update:becallModal', false);
            },
            callClient() {
                var _this = this;
                var calling = {client : _this.client, programme : _this.programme, lot : _this.lot};
                console.log(calling);
                axios.post('/action/call', calling ).then((response) => {
                    console.log(response);
                    this.call = {}; //Clear input fields.
                    this.$emit('update:becallModal', false);
                    flash('Votre demande de rappel à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            outside: function(e) {
                this.$emit('update:becallModal', false);
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
