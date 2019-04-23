<template>
    <v-container fluid grid-list-md fill-height class="programmes-list">
        <v-layout row wrap>
            <v-flex xs12 md12>
                    <v-layout align-center class="programme-card">



                        <v-flex md2 pa-0 pt-0 pb-0>
                            <v-carousel hide-delimiters hide-controls height="auto" >
                                <v-carousel-item
                                        v-for="(thumb, i) in JSON.parse(programme.images)"
                                        :key="i"
                                        :src="getImages(thumb)"

                                ></v-carousel-item>
                            </v-carousel>
                        </v-flex>
                        <v-flex md2>
                                    <div class="">

                                        <a :href="/programmes/+programme.id">{{ programme.name }}</a>
                                        <p>Exclusivité Galileo</p>
                                        <p><v-icon>location_on</v-icon> {{ programme.ville }} {{ programme.code_postal }}</p>
                                    </div>
                        </v-flex>
                        <v-flex md1>
                            <v-chip color="blue" text-color="white" v-for="dispositif in programme.dispositifs" :key="dispositif.id">
                                {{ dispositif.name }}
                            </v-chip>
                        </v-flex>
                        <v-flex md2>
                            A partir de {{ min }} €
                        </v-flex>
                        <v-flex md1>
                            <v-card-text primary-title>
                                <div class="">

                                    {{ programme.date_livraison }}
                                </div>
                            </v-card-text>
                        </v-flex>
                        <v-flex md2>
                            <v-card-actions>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn flat icon color="pink" v-on="on">
                                            <v-icon >favorite_border</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Mettre en le programme en favoris</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn flat icon color="green" v-on="on" @click="becallModal = true">
                                            <v-icon>call</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Être rappelé</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn flat icon color="blue" v-on="on" @click="()=>{contactModal = true; contact.programme.id = programme.id; contact.programme.name = programme.name; contact.lot.id = '#'; contact.lot.numero = '#'}">
                                            <v-icon>email</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Contactez nous</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn flat icon color="red" v-on="on" @click="()=>{denonceModal = true; denonce.programme.id = programme.id; denonce.programme.name = programme.name; denonce.lot.id = '#'; denonce.lot.numero = '#'}">
                                            <v-icon>location_searching</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Dénoncer un client</span>
                                </v-tooltip>
                                <call></call>
                            </v-card-actions>
                        </v-flex>
                        <v-divider vertical></v-divider>
                        <v-flex md2>
                            <!--<div v-if="this.user !== ''">
                                <v-btn color="orange" dark @click="showLots = true">Voir les {{ count }} lots (logged)</v-btn>
                            </div>
                            <div v-else>
                                <v-btn color="orange" dark @click="openModal">Voir les {{ count }} lots (not logged)</v-btn>
                            </div>-->

                                <!--<div><v-btn color="orange" dark @click="showLots = true">Voir les {{ count }} lots</v-btn></div>-->


                                    <div>
                                        <v-btn round color="pink accent-2"  dark outline @click="showLots = true">Voir les {{ count }} lots</v-btn>
                                    </div>

                                    <!--<div><v-btn color="orange" dark @click="openModal">Voir les {{ count }} lots (not logged)</v-btn></div>

                                    <div><v-btn color="blue" dark :href="/programmes/+programme.id">Découvrir le programme</v-btn></div>-->

                        </v-flex>
                    </v-layout>
            </v-flex>
            <!-- show lots modal -->
            <v-dialog
                    v-model="showLots"
                    fullscreen
                    hide-overlay
                    transition="dialog-bottom-transition"
                    scrollable
            >

                <v-card tile>
                    <v-toolbar card dark color="light-blue">
                        <v-toolbar-title>Lots du programme : {{ programme.name }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon dark @click="showLots = false">
                            <v-icon>close</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <!--<flash message=""></flash>-->
                    <v-data-table
                            :headers="headers"
                            :items="lots"
                            item-key="id"
                            class="elevation-1"
                    >
                        <template slot="items" slot-scope="props">
                            <td>
                                <v-img
                                        :src="getImages(props.item.plan)"
                                        height="70"
                                ></v-img>
                            </td>
                            <td>{{ props.item.numero }}</td>
                            <td>{{ props.item.type }}</td>
                            <td>{{ props.item.etage }}</td>
                            <td>{{ props.item.surface }} m²</td>
                            <td>{{ props.item.exposition }}</td>
                            <td>{{ props.item.loyer }} €</td>
                            <td>{{ props.item.prix }} €</td>
                            <td>{{ props.item.prix_metres }} €</td>
                            <td>{{ props.item.rentabilite }} %</td>
                            <td>{{ props.item.livraison }}</td>
                            <td class="justify-center layout px-0">
                                <v-card-actions>

                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="grey" :href="/programmes/+programme.id+/lots/+props.item.id" v-on="on">
                                                <v-icon >visibility</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Voir le lot {{ props.item.numero }}</span>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="pink" v-on="on">
                                                <v-icon >favorite_border</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Mettre le lot en favoris</span>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="green" v-on="on" @click="()=>{ becallModal = true; call.programme.id = programme.id; call.programme.name = programme.name; call.lot.id = props.item.id; call.lot.numero = props.item.numero}">
                                                <v-icon>call</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Être rappelé</span>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="blue" v-on="on" @click="()=>{ contactModal = true; contact.programme.id = programme.id; contact.programme.name = programme.name; contact.lot.id = props.item.id; contact.lot.numero = props.item.numero}">
                                                <v-icon>email</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Contactez nous</span>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="red" v-on="on" @click="()=>{denonceModal = true; denonce.programme.id = programme.id; denonce.programme.name = programme.name; denonce.lot.id = props.item.id; denonce.lot.numero = props.item.numero}">
                                                <v-icon>location_searching</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Dénoncer un client</span>
                                    </v-tooltip>

                                </v-card-actions>
                            </td>
                        </template>
                    </v-data-table>

                    <div style="flex: 1 1 auto;"></div>
                </v-card>
            </v-dialog>
            <!-- End show lots modal -->
            <!-- contact modal -->
            <v-dialog v-model="contactModal"  max-width="600px">
                <v-card>
                    <v-toolbar dark color="light-blue">

                        <v-toolbar-title class="text-uppercase">Contactez-nous</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon dark @click="contactModal = false">
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
            <!-- End contact modal -->
            <!-- becall modal -->
            <v-dialog v-model="becallModal"  max-width="600px">
                <v-card>
                    <v-toolbar dark color="green">

                        <v-toolbar-title class="text-uppercase">Être-rappelé</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon dark @click="becallModal = false">
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
            <!-- denonce modal -->
            <v-dialog v-model="denonceModal"  max-width="600px">
                <v-card>
                    <v-toolbar dark color="red">

                        <v-toolbar-title class="text-uppercase">Dénoncer un client</v-toolbar-title>

                        <v-spacer></v-spacer>
                        <v-btn icon dark @click="denonceModal = false">
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
            <login class="test" ref="login"></login>
        </v-layout>
    </v-container>
</template>
<script>
    import Lot from './Lot';
    import Login from './Login';
    import Call from './Call';
    import Flash from './Flash';

    export default {
        resource: null,
        props: {
            programme: Object,
            Lot: Object,
            login: Object,
            user: Object,
        },
        data: function() {
            return {
                isLogged: true,
                loginModal: false,
                contactModal: false,
                becallModal: false,
                denonceModal: false,
                lots: [],
                count: null,
                showLots: false,
                call: {
                    'client': {
                        'genre': '', 'firstname': '', 'lastname': '', 'email': '', 'phone': '', 'address': '', 'zipcode': '', 'city': ''
                    },
                    'programme': {
                        'id': '', 'name': ''
                    },
                    'lot': {
                        'id': '', 'number': ''
                    },
                },
                contact: {
                    'client': {
                        'genre': '', 'firstname': '', 'lastname': '', 'email': '', 'phone': '', 'address': '', 'zipcode': '', 'city': '', 'message': ''
                    },
                    'programme': {
                        'id': '', 'nom': ''
                    },
                    'lot': {
                        'id': '', 'numero': ''
                    },
                },
                denonce: {
                    'professionnel': {
                            'id': ''
                        },
                    'client': {
                        'genre': '', 'firstname': '', 'lastname': '', 'email': '', 'phone': '', 'address': '', 'zipcode': '', 'city': ''
                    },
                    'programme': {
                        'id': '', 'name': ''
                    },
                    'lot': {
                        'id': '', 'number': ''
                    },
                },
                min: null,
                minimum: [10, 20, 30, 40, 50],
                headers: [
                    { text: 'Plan', value: 'plan', align: 'left',
                        sortable: false, },
                    {
                        text: 'Numéro',
                        align: 'left',
                        sortable: false,
                        value: 'id'
                    },
                    { text: 'Type', value: 'type' },
                    { text: 'Etage', value: 'etage' },
                    { text: 'Surface', value: 'surface' },
                    { text: 'Exposition', value: 'exposition' },
                    { text: 'Loyer', value: 'loyer' },
                    { text: 'Prix', value: 'prix' },
                    { text: 'Prix m²', value: 'prix_metres' },
                    { text: 'Rentabilité', value: 'rentabilite' },
                    { text: 'Livraison', value: 'livraison' },
                    { text: 'Actions', value: 'name', sortable: false }
                ],
            }
        },
        mounted () {
            this.resource = this.$resource('/programmes/' + this.programme.id + '/lots')
            this.resource.get().then((response) => {
                this.lots = response.body;
                this.count = this.lots.length;
                var minimumPrice = 0;
                this.lots.forEach(function(element) {
                    if(minimumPrice == 0){
                        minimumPrice = element.prix;
                    }else if(minimumPrice > element.prix){
                        minimumPrice = element.prix;
                    }
                });
                this.min = minimumPrice;
            });

        },
        methods: {
            getImages(image){
                if(image != null){
                    return "/storage/"+image;
                }

            },
            openModal() {
                this.$refs.login.show() ;
            },
            denonceClient() {
                var _this = this;
                console.log(_this.denonce);
                axios.post('/send/email/prospect', _this.denonce ).then((response) => {
                    this.denonceModal = false;
                    //this.denonce = {}; //Clear input fields.
                    console.log(response);
                    flash('Votre dénonce à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            contactClient() {
                var _this = this;
                axios.post('/send/email/contact', _this.contact ).then((response) => {
                    console.log(_this.contact);
                    console.log(response);
                    //this.contact = {}; //Clear input fields.
                    this.contactModal = false;
                    flash('Votre demande à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
            callClient() {
                var _this = this;
                console.log(_this.call);
                axios.post('/send/email/call', _this.call ).then((response) => {
                    console.log(_this.call);
                    console.log(response);
                    //this.contact = {}; //Clear input fields.
                    this.becallModal = false;
                    flash('Votre demande de rappel à bien été prise en compte.', 'success');
                }).catch(error => {
                    console.log(error.response);
                });
            },
        },
        components: {
            Lot, Login, Call, Flash,
        }
    }
</script>

<style>
    .v-carousel, .v-card {
        box-shadow: none;
    }

    .container.programmes-list {
        padding: 1px 0;
    }

    .container.grid-list-md.programmes-list .layout:only-child {
        margin: 0px;
    }

    .programme-card {
        background: #fff;
    }

    .test{
        display: none;
    }
</style>