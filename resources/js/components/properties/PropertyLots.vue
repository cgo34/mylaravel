<template>
    <div>
        <v-dialog
            v-model="showLots"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            scrollable
        >
            <v-card>
                <v-toolbar card dark color="#00e094">
                    <v-toolbar-title>Lots du programme : {{ property.name }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click.stop="hide()">
                        <v-icon>close</v-icon>
                    </v-btn>
                </v-toolbar>
                {{ user }}
                {{ lots }}
                <v-data-table
                    :headers="headers"
                    :items="property.properties"
                    item-key="id"
                    class="elevation-1"
                >
                    <template
                        slot="items"
                        slot-scope="props"
                    >
<!--                        v-if="props.item.booked_user_id === user.id"-->
                        <template
                            v-if="props.item.booked_user_id === null"
                        >
                            <td>
                                <favorites-properties
                                    :property="props.item.id"
                                    :favorited="favoriteProperty(props.item.favorites)"
                                ></favorites-properties>
                            </td>
                            <td>
                                <v-img
                                    :src="getImages(props.item.plan)"
                                    width="100"
                                ></v-img>
                            </td>
                            <td>{{ props.item.name }}</td>
                            <td>{{ props.item.typology }}</td>
                            <td>{{ props.item.floor }}</td>
                            <td>{{ props.item.living_space }} m²</td>
                            <td>{{ props.item.exposure }}</td>
                            <td>{{ props.item.rent_price }} €</td>
                            <td>{{ props.item.sell_price }} €</td>
                            <td>{{ props.item.delivery }}</td>
                            <td
                            >
                                <v-card-actions>
                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" :href="/programmes/+property.id+/lots/+props.item.id" v-on="on">
                                                <v-icon >visibility</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Voir le lot {{ props.item.numero }}</span>
                                    </v-tooltip>
                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="becallModall = !becallModall">
                                                <v-icon>call</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Être rappelé</span>
                                        <call
                                            :user="user"
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
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="contactModall = !contactModall">
                                                <v-icon>email</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Contactez nous</span>
                                        <contact
                                            :user="user"
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
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="denonceModall = !denonceModall">
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
                        <!--<template
                            v-else-if="props.item.booked_user_id !== user.id"
                        ></template>
                        <template
                            v-else-if="props.item.booked_user_id === null"
                        >
                            <td>
                            </td>
                            <td>
                                <v-img
                                    :src="getImages(props.item.plan)"
                                    height="70"
                                ></v-img>
                            </td>
                            <td>{{ props.item.name }}</td>
                            <td>{{ props.item.typologie }}</td>
                            <td>{{ props.item.floor }}</td>
                            <td>{{ props.item.surface_habitable }} m²</td>
                            <td>{{ props.item.exposition }}</td>
                            <td>{{ props.item.loyer }} €</td>
                            <td>{{ props.item.price }} €</td>
                            <td>{{ props.item.delivery }}</td>
                            <td
                            >
                                <v-card-actions>
                                    <books-lots
                                        :user="user"
                                        :lot="props.item.id"
                                        :state="getState(user.id, props.item.option_requests)"
                                    ></books-lots>
                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" :href="/programmes/+idProgramme+/lots/+props.item.id" v-on="on">
                                                <v-icon >visibility</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Voir le lot {{ props.item.numero }}</span>
                                    </v-tooltip>
                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="becallModall = !becallModall">
                                                <v-icon>call</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Être rappelé</span>
                                        <call
                                            :user="user"
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
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="contactModall = !contactModall">
                                                <v-icon>email</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Contactez nous</span>
                                        <contact
                                            :user="user"
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
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="denonceModall = !denonceModall">
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
                        <template
                            v-else
                        >
                            here
                            <td>
                            </td>
                            <td>
                                <v-img
                                    :src="getImages(props.item.plan)"
                                    height="70"
                                ></v-img>
                            </td>
                            <td>{{ props.item.name }}</td>
                            <td>{{ props.item.typologie }}</td>
                            <td>{{ props.item.floor }}</td>
                            <td>{{ props.item.surface_habitable }} m²</td>
                            <td>{{ props.item.exposition }}</td>
                            <td>{{ props.item.loyer }} €</td>
                            <td>{{ props.item.price }} €</td>
                            <td>{{ props.item.delivery }}</td>
                            <td
                            >
                                <v-card-actions>

                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" :href="/programmes/+idProgramme+/lots/+props.item.id" v-on="on">
                                                <v-icon >visibility</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Voir le lot {{ props.item.numero }}</span>
                                    </v-tooltip>
                                </v-card-actions>
                            </td>
                            <td>
                                <v-card-actions>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="becallModall = !becallModall">
                                                <v-icon>call</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Être rappelé</span>
                                        <call
                                            :user="user"
                                            :idProgramme="property.id"
                                            :nameProgramme="property.name"
                                            :idLot="props.item.id"
                                            :numberLot="props.item.name"
                                            :becallModal.sync="becallModall"
                                            v-on:update:becallModal="becallModall = $event"
                                        ></call>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="contactModall = !contactModall">
                                                <v-icon>email</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Contactez nous</span>
                                        <contact
                                            :user="user"
                                            :idProgramme="property.id"
                                            :nameProgramme="property.name"
                                            :idLot="props.item.id"
                                            :numberLot="props.item.name"
                                            :contactModal.sync="contactModall"
                                            v-on:update:contactModal="contactModall = $event"
                                        ></contact>
                                    </v-tooltip>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn flat icon color="#5d5d5d" v-on="on" @click.stop="denonceModall = !denonceModall">
                                                <v-icon>location_searching</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Dénoncer un client</span>
                                        <denonce
                                            :idProgramme="property.id"
                                            :nameProgramme="property.name"
                                            :idLot="props.item.id"
                                            :numberLot="props.item.name"
                                            :denonceModal.sync="denonceModall"
                                            v-on:update:denonceModal="denonceModall = $event"
                                        ></denonce>
                                    </v-tooltip>
                                </v-card-actions>
                            </td>
                        </template>-->
                    </template>
                    <template v-slot:no-data>
                        <p>Sorry, nothing to display here :(</p>
                    </template>
                </v-data-table>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: "PropertyLots",
    props: ['user', 'property', 'idProgramme', 'nameProgramme', 'lots', 'showLots'],
    data: function() {
        return {
            showLotss: false,
            becallModall: false,
            contactModall: false,
            denonceModall: false,
            headers: [
                { text: 'Favoris', value: '', align: 'left', sortable: false },
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
                { text: 'Exposition', value: 'exposition', width: '80' },
                { text: 'Loyer', value: 'loyer' },
                { text: 'Prix', value: 'prix' },
                { text: 'Livraison', value: 'livraison' },
                { text: 'Réserver', value: 'reserved', sortable: false },
                { text: 'Voir', value: 'view', sortable: false },
                { text: 'Actions', value: 'name', sortable: false }
            ],
        }
    },
    methods: {
        getState(userId, lot) {
            var user = this.user;
            var state = false;
            if(lot !== []){
                lot.forEach( function(e) {
                    if(user.id === e.user_id){
                        if(e.state === 'pending'){
                            state = 'pending';
                        }else if(e.state === 'validated'){
                            state = 'validated';
                        } else if(e.state === 'refused'){
                            state = 'refused';
                        }
                    }
                });
            }else{
                state = false;
            }
            return state;
        },
        favoriteProperty(fav) {
            var favoriteProperty = false;
            if(fav === undefined){
                return false;
            }
            var user = this.user;
            fav.forEach( function(favorite) {
                if(user.id === favorite.user_id){
                    favoriteProperty = true;
                }
            });
            return favoriteProperty;
        },
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }
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
