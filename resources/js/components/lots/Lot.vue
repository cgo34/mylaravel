<template>
    <v-container class="pt-0">
        <v-toolbar
            id="lot-toolbar"
            :scroll-threshold="45"
            fixed
            inverted-scroll
            scroll-off-screen
            height="60px"
            flat
            dark
            color="grey darken-3"
            class="mt-5 text-md-center hidden-sm-and-down"
        >
            <v-toolbar-items>
                <v-btn href="#bien" flat>Le programme</v-btn>
                <v-btn href="#photo" flat>Les photos</v-btn>
                <v-btn href="#lot" flat>Le lot</v-btn>
                <v-btn href="#quartier" flat>Le quartier</v-btn>
                <v-btn href="#agence" flat>L'agence</v-btn>
            </v-toolbar-items>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <favorites-lots
                    :lot="selectedprogramme.id"
                    :favorited="favoriteslots[selectedprogramme.id]"
                ></favorites-lots>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            icon
                            v-on="on"
                            v-for="(p,i) in JSON.parse(selectedprogramme.plaquette)"
                            v-bind:key="i"
                            :href="/storage/ + p.download_link"
                            target="_blank"
                        >
                            <v-icon color="#fff">save_alt</v-icon>
                        </v-btn>
                    </template>
                    <span>Télécharger la fiche</span>
                </v-tooltip>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.stop="becallModal = !becallModal">
                            <v-icon color="#fff">call</v-icon>
                        </v-btn>
                    </template>
                    <span>Être rappelé</span>
                    <call
                        :user="selecteduser"
                        :idProgramme="selectedprogramme.id"
                        :nameProgramme="selectedprogramme.name"
                        :idLot="selectedlot.id"
                        :numberLot="selectedlot.numero"
                        :becallModal.sync="becallModal"
                        v-on:update:becallModal="becallModal = $event"
                    ></call>
                </v-tooltip>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.stop="contactModal = !contactModal">
                            <v-icon color="#fff">email</v-icon>
                        </v-btn>
                    </template>
                    <span>Nous contacter</span>
                    <contact
                        :user="selecteduser"
                        :idProgramme="selectedprogramme.id"
                        :nameProgramme="selectedprogramme.name"
                        :idLot="selectedlot.id"
                        :numberLot="selectedlot.numero"
                        :contactModal.sync="contactModal"
                        v-on:update:contactModal="contactModal = $event"
                    ></contact>
                </v-tooltip>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.stop="denonceModal = !denonceModal">
                            <v-icon color="#fff">my_location</v-icon>
                        </v-btn>
                    </template>
                    <span>Dénoncer un client</span>
                    <denonce
                        :idProgramme="selectedprogramme.id"
                        :nameProgramme="selectedprogramme.name"
                        :idLot="selectedlot.id"
                        :numberLot="selectedlot.numero"
                        :denonceModal.sync="denonceModal"
                        v-on:update:denonceModal="denonceModal = $event"
                    ></denonce>
                </v-tooltip>
            </v-toolbar-items>
        </v-toolbar>
        <v-container  id="test" grid-list-md >
            <v-card>
                <v-layout align-center>
                    <v-flex xs12 sm12 text-md-center>
                        <v-layout align-center >
                            <v-flex xs12 sm1 md1>
                                <favorites-lots
                                    :lot="selectedprogramme.id"
                                    :favorited="favoriteslots[selectedprogramme.id]"
                                ></favorites-lots>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn icon v-on="on">
                                            <v-icon color="#00e094">shopping_cart</v-icon>
                                        </v-btn>
                                        <span>Réserver le lot</span>
                                    </template>
                                    <span>Réserver le lot</span>
                                </v-tooltip>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            icon
                                            v-on="on"
                                            v-for="(p,i) in JSON.parse(selectedprogramme.plaquette)"
                                            v-bind:key="i"
                                            :href="/storage/ + p.download_link"
                                            target="_blank"
                                        >
                                            <v-icon color="#00e094">save_alt</v-icon>
                                        </v-btn>
                                        <span>Télécharger la fiche</span>
                                    </template>
                                    <span>Télécharger la fiche</span>
                                </v-tooltip>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn icon v-on="on" @click.stop="becallModal = !becallModal">
                                            <v-icon color="#00e094">call</v-icon>
                                        </v-btn>
                                        <span>Être rappelé</span>
                                    </template>
                                    <span>Être rappelé</span>
                                    <call
                                        :user="selecteduser"
                                        :idProgramme="selectedprogramme.id"
                                        :nameProgramme="selectedprogramme.name"
                                        :idLot="selectedlot.id"
                                        :numberLot="selectedlot.numero"
                                        :becallModal.sync="becallModal"
                                        v-on:update:becallModal="becallModal = $event"
                                    ></call>
                                </v-tooltip>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn icon v-on="on" @click.stop="contactModal = !contactModal">
                                            <v-icon color="#00e094">email</v-icon>
                                        </v-btn>
                                        <span>Nous contacter</span>
                                    </template>
                                    <span>Nous contacter</span>
                                    <contact
                                        :user="selecteduser"
                                        :idProgramme="selectedprogramme.id"
                                        :nameProgramme="selectedprogramme.name"
                                        :idLot="selectedlot.id"
                                        :numberLot="selectedlot.numero"
                                        :contactModal.sync="contactModal"
                                        v-on:update:contactModal="contactModal = $event"
                                    ></contact>
                                </v-tooltip>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn icon v-on="on" @click.stop="denonceModal = !denonceModal">
                                            <v-icon color="#00e094">my_location</v-icon>
                                        </v-btn>
                                        <span>Dénoncer un client</span>
                                    </template>
                                    <span>Dénoncer un client</span>
                                    <denonce
                                        :idProgramme="selectedprogramme.id"
                                        :nameProgramme="selectedprogramme.name"
                                        :idLot="selectedlot.id"
                                        :numberLot="selectedlot.numero"
                                        :denonceModal.sync="denonceModal"
                                        v-on:update:denonceModal="denonceModal = $event"
                                    ></denonce>
                                </v-tooltip>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-container>

        <v-container>

            <v-flex >
                <v-layout>
                    <v-flex xs12 sm12 md12>
                        <v-card light color="#fff" hover>
                            <v-layout>
                                <v-flex xs8 sm8 md8 class="pa-0">

                                    <v-img :src="getImages(selectedprogramme.thumbnail)" aspect-ratio="1.7"></v-img>

                                </v-flex>
                                <v-flex xs4 sm4 md4>
                                    <v-card-title>
                                        <h3 class="title display-2 font-weight-bold text-uppercase primary-color">{{ selectedprogramme.name }}</h3>
                                    </v-card-title>
                                    <v-card-text>
                                        <h4 class="display-5 text-uppercase">Exclusivité Galileo</h4>
                                    </v-card-text>
                                    <v-card-text>
                                        <v-chip
                                            text-color="white"
                                            color="#00e094"
                                            expensed
                                            class="pr-3 pl-3 btn-box-shadow-primary"
                                            v-for="(dispositif,i) in selectedprogramme.dispositifs"
                                            v-bind:key="i"
                                        >
                                            <v-avatar>
                                                <v-icon>account_balance</v-icon>
                                            </v-avatar>
                                            <b>{{ dispositif.name }}</b>
                                        </v-chip>
                                    </v-card-text>
                                    <v-card-text>
                                        <v-chip text-color="white" color="#00e094" expensed class="pr-3 pl-3 btn-box-shadow-primary">
                                            <v-avatar>
                                                <v-icon>location_on</v-icon>
                                            </v-avatar>
                                            <b>{{ selectedprogramme.city }}</b>
                                        </v-chip>
                                    </v-card-text>
                                    <v-card-text>
                                        <v-chip text-color="white" color="#00e094" expensed class="pr-3 pl-3 btn-box-shadow-primary">
                                            <v-avatar>
                                                <v-icon>euro_symbol</v-icon>
                                            </v-avatar>
                                            <b>{{ selectedlot.prix }}</b>
                                        </v-chip>
                                    </v-card-text>

                                </v-flex>
                            </v-layout>
                        </v-card>
                    </v-flex>
                </v-layout>



                <v-spacer class="mb-5"></v-spacer>

                <h3 id="bien" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--darken-3 mb-3"><v-icon color="#00e094">fas fa-city</v-icon> Le programme</h3>
                <v-spacer class="mb-1"></v-spacer>
                <div xs12 sm12 md12 class="mb-3">
                    <v-card light color="white" class="pa-3" hover>
                        <v-card-text class="px-0 body-2"><p>{{ selectedprogramme.description }}</p></v-card-text>
                    </v-card>
                </div>
                <v-spacer class="mb-5"></v-spacer>
                <h3 id="photo" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--text--darken-3 mb-3"><v-icon color="#00e094">fas fa-images</v-icon> Les photos</h3>
                <v-flex xs6 sm12 md12>
                    <v-card light color="white" class="text-center  pa-3" hover>
                        <v-carousel >
                            <v-carousel-item
                                v-for="(image,i) in JSON.parse(selectedprogramme.images)" v-bind:key="i"
                                :src="getImages(image)"
                            ></v-carousel-item>
                        </v-carousel>
                    </v-card>
                </v-flex>
                <v-spacer class="mb-5"></v-spacer>
                <h3 id="lot" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--darken-3 mb-3"><v-icon color="#00e094">fas fa-building</v-icon> Le lot {{ selectedlot.numero }}</h3>
                <v-spacer class="mb-1"></v-spacer>
                <v-layout row wrap>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">account_balance</v-icon>
                            <v-card-text class="px-0">
                                <span class="primary-color font-weight-bold text-uppercase">Dispositif</span><br>
                                <span
                                    v-for="(dispositif,i) in selectedprogramme.dispositifs"
                                    v-bind:key="i"
                                    class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                    {{ dispositif.name }}
                                </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">business</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Type</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.type }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">swap_vert</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Etage</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.etage }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">fullscreen</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Surface</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.surface }}m2
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">explore</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Exposition</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.exposition }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">fullscreen</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Parking</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.parking }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs6 sm4 md2 offset-md1>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">account_balance_wallet</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Prix/m2</span>
                                <br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.prix_metres }} €
                                    </span></v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">trending_up</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Rentabilité</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.rentabilite }} %
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">euro_symbol</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Loyer</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.loyer }} €
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">calendar_today</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Livraison</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.livraison }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <v-card light color="white" class="text-center  pt-3" hover>
                            <v-icon color="#00e094">schedule</v-icon>
                            <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Actabilité</span><br>
                                <span class="grey--text text--darken-3 font-weight-bold text-uppercase">
                                        {{ selectedlot.actabilite }}
                                    </span>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-spacer class="mb-5"></v-spacer>
                <h3 id="quartier" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--text--darken-3 mb-3"><v-icon color="#00e094">fas fa-map-signs</v-icon> Le quartier</h3>
                <v-spacer class="mb-1"></v-spacer>
                <v-layout row rap>
                    <v-flex xs12 sm12 md12 class="mb-3">
                        <v-card light flat color="white" class="pa-3" hover>
                            <v-card-text class="px-0 body-2"><p>{{ selectedprogramme.quartier }}</p></v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-spacer class="mb-5"></v-spacer>
                <h3 id="agence" class="lot-section headline  mb-1 text-md-center text-uppercase font-weight-bold black--text text--text--darken-3 mb-3"><v-icon color="#00e094">fas fa-store-alt</v-icon> L'agence</h3>
                <v-spacer class="mb-1"></v-spacer>
                <div xs12 sm12 md12 class="mb-3">
                    <v-card light color="white" class="pa-3" hover>
                        <v-card-text class="px-0 body-2"><p>{{ selectedprogramme.agency }}</p></v-card-text>
                    </v-card>
                </div>
            </v-flex>
        </v-container>
        <v-container>
            <v-layout>
                <lots-additional
                    :idlot="selectedlot.id"
                    :dispositifs="selectedprogramme.dispositifs"
                    :city="selectedprogramme.city"
                    :price="selectedlot.prix"
                ></lots-additional>
            </v-layout>
        </v-container>
    </v-container>
</template>

<script>


    import LotsAdditional from './LotsAdditional';
    export default {
        name: 'Lot',
        components: { LotsAdditional },
        props: ['selectedprogramme', 'selectedlot', 'selecteduser', 'favoriteslots'],
        data: function() {
            return {
                denonceModal: false,
                contactModal: false,
                becallModal: false,
            }
        },
        mounted() {
            console.log(this.selectedprogramme);
            console.log(this.selectedlot);
            console.log('Page dun lot');
            console.log(this.selecteduser);

        },
        methods: {
            getImages(image) {
                if (image != null) {
                    return "/storage/" + image;
                }

            },
        },
    }
</script>
<style scoped>

</style>
