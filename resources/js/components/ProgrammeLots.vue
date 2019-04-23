<template>

    <v-dialog
            v-model="showLots"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            scrollable
    >
        <v-card tile>
            <v-toolbar card dark color="#65D6B5">
                <v-toolbar-title>Lots du programme : {{ nameProgramme }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon dark @click.stop="hide()">
                    <v-icon>close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-data-table
                    :headers="headers"
                    :items="alllots"
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
                            <favorites-lots
                                    :lot="props.item.id"
                                    :favorited="allFavoritesLots[props.item.id]"
                            ></favorites-lots>

                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn flat icon color="grey" :href="/programmes/+idProgramme+/lots/+props.item.id" v-on="on">
                                        <v-icon >visibility</v-icon>
                                    </v-btn>
                                </template>
                                <span>Voir le lot {{ props.item.numero }}</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn flat icon color="green" v-on="on" @click.stop="becallModall = !becallModall">
                                        <v-icon>call</v-icon>
                                    </v-btn>
                                </template>
                                <span>Être rappelé</span>
                                <call
                                        :idProgramme="idProgramme"
                                        :nameProgramme="nameProgramme"
                                        :idLot="props.item.id"
                                        :numberLot="props.item.numero"
                                        :becallModal.sync="becallModall"
                                        v-on:update:becallModal="becallModall = $event"
                                ></call>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn flat icon color="blue" v-on="on" @click.stop="contactModall = !contactModall">
                                        <v-icon>email</v-icon>
                                    </v-btn>
                                </template>
                                <span>Contactez nous</span>
                                <contact
                                        :idProgramme="idProgramme"
                                        :nameProgramme="nameProgramme"
                                        :idLot="props.item.id"
                                        :numberLot="props.item.numero"
                                        :contactModal.sync="contactModall"
                                        v-on:update:contactModal="contactModall = $event"
                                ></contact>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn flat icon color="red" v-on="on" @click.stop="denonceModall = !denonceModall">
                                        <v-icon>location_searching</v-icon>
                                    </v-btn>
                                </template>
                                <span>Dénoncer un client</span>
                                <denonce
                                        :idProgramme="idProgramme"
                                        :nameProgramme="nameProgramme"
                                        :idLot="props.item.id"
                                        :numberLot="props.item.numero"
                                        :denonceModal.sync="denonceModall"
                                        v-on:update:denonceModal="denonceModall = $event"
                                ></denonce>
                            </v-tooltip>

                        </v-card-actions>
                    </td>
                </template>
            </v-data-table>
        </v-card>
    </v-dialog>
</template>

<script>
    import Call from './actions/Call';
    import Contact from './actions/Contact';
    import Denonce from './actions/Denonce';

    export default {
        name: "ListLots",
        props: ['idProgramme', 'nameProgramme', 'countLots', 'listingLots', 'showLots', 'becallModal', 'contactModal', 'denonceModal', 'favorited', 'favoritedlots'],
        components: {
            Call,
            Contact,
            Denonce
        },
        data: function() {
            return {
                showLotss: false,
                becallModall: false,
                contactModall: false,
                denonceModall: false,
                alllots: [],
                allFavoritesLots: [],
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
        mounted() {
            let _this = this;
            this.alllots = JSON.parse(_this.listingLots);
            this.allFavoritesLots = JSON.parse(_this.favoritedlots);
        },
        methods: {
            getImages(image) {
                if (image != null) {
                    return "/storage/" + image;
                }

            },
            show(){
                let _this = this;
                this.$emit('update:becallModal', false);
            },
            hide(){
                let _this = this;
                this.$emit('update:showLots', false);
            }
        },

    }
</script>

<style scoped>

</style>