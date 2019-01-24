<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 md12>

                <v-card>
                    <v-layout>
                        <v-flex md3 pt-0 pb-0>
                            <v-carousel hide-delimiters hide-controls height="190" >
                                <v-carousel-item
                                        v-for="(thumb, i) in JSON.parse(programme.images)"
                                        :key="i"
                                        :src="getImages(thumb)"

                                ></v-carousel-item>
                            </v-carousel>
                        </v-flex>
                        <v-flex md7>
                            <v-card-title primary-title>
                                <div>
                                    <div class="headline">

                                        <a :href="/programmes/+programme.id">{{ programme.name }}</a>
                                        <v-chip color="blue" text-color="white" v-for="dispositif in programme.dispositifs" :key="dispositif.id">
                                            {{ dispositif.name }}
                                        </v-chip>
                                        A partir de {{ min }} €
                                    </div>

                                    <div>{{ programme.description }}</div>
                                    <div>{{ programme.ville }}</div>

                                </div>
                            </v-card-title>
                        </v-flex>
                        <v-divider vertical></v-divider>
                        <v-flex md2>
                            <v-card-actions>

                                <v-btn flat icon color="pink">
                                    <v-icon>favorite</v-icon>
                                </v-btn>
                                <v-btn flat icon color="green">
                                    <v-icon>call</v-icon>
                                </v-btn>
                                <v-btn flat icon color="blue">
                                    <v-icon>email</v-icon>
                                </v-btn>


                            </v-card-actions>

                            <div v-if="user">
                                Logged in
                                <v-btn color="orange" dark @click="dialog = true">Voir les {{ count }} lots</v-btn>
                            </div>
                            <div v-else>
                                Not logged in
                                <div><v-btn color="orange" dark @click="mlogin = true">Voir les {{ count }} lots</v-btn></div>
                            </div>

                            <div><v-btn color="blue" dark :href="/programmes/+programme.id">Découvrir le programme</v-btn></div>

                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-dialog
                    v-model="dialog"
                    fullscreen
                    hide-overlay
                    transition="dialog-bottom-transition"
                    scrollable
            >
                <v-card tile>
                    <v-toolbar card dark color="primary">
                        <v-toolbar-title>Lots du programme : {{ programme.name }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon dark @click="dialog = false">
                            <v-icon>close</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-data-table
                            v-model="selected"
                            :headers="headers"
                            :items="lots"
                            item-key="id"
                            select-all
                            class="elevation-1"
                    >
                        <template slot="items" slot-scope="props">
                            <td>
                                <v-checkbox
                                        v-model="props.selected"
                                        primary
                                        hide-details
                                ></v-checkbox>
                            </td>
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
                                    <v-btn flat icon color="grey" :href="/programmes/+programme.id+/lots/+props.item.id">
                                        <v-icon>visibility</v-icon>
                                    </v-btn>
                                    <v-btn flat icon color="pink">
                                        <v-icon>favorite</v-icon>
                                    </v-btn>
                                    <v-btn flat icon color="green">
                                        <v-icon>call</v-icon>
                                    </v-btn>
                                    <v-btn flat icon color="blue"  @click="contact = true">
                                        <v-icon>email</v-icon>
                                    </v-btn>


                                </v-card-actions>
                            </td>
                        </template>
                    </v-data-table>

                    <div style="flex: 1 1 auto;"></div>
                </v-card>
            </v-dialog>
            <v-dialog v-model="contact" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Contactez-nous</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field label="Nom*" required></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="Prénom*" required></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="Email*" required></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        <small>*indicates required field</small>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="contact = false">Close</v-btn>
                        <v-btn color="blue darken-1" flat @click="contact = false">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </v-container>
</template>
<script>
    import Lot from './Lot'
    import Login from './Login'

    export default {
        resource: null,
        //props: ['id', 'name', 'description', 'ville', 'thumbnail', 'dispositifs'],
        props: {
            programme: Object,
            Lot: Object,
            User: Object,
        },
        data () {
            return {
                lots: [],
                mlogin: false,
                count: null,
                dialog: false,
                contact: false,
                min: null,
                minimum: [10, 20, 30, 40, 50],
                selected: [],
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
                console.log(image);
                return "/storage/"+image;
            },
        },
        components: {
            Lot, Login
        }
    }
</script>

<style>
    .v-carousel, .v-card {
        box-shadow: none;
    }
</style>