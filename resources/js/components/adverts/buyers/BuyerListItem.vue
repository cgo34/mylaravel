<template>
    <v-layout row wrap>
        <v-flex md9>
            <v-card>
                <v-layout align-center row wrap pl-1>
                    <v-flex
                        md2
                        pa-0
                        pt-0
                        pb-0
                        class="text-md-center"
                    >
                        <v-card
                            v-if="buyer.advert_type.name === 'Location'"
                            flat
                            height="100%"
                            color="rgba(216, 27, 96, 0.6)"
                            class="pa-4"
                        >
                            <v-avatar
                                size="80px"
                                color="rgba(216, 27, 96)"
                                style="border-radius: 100px;"
                                class="border-white"
                            >
                                <span class="white--text font-weight-bold">
                                    {{ buyer.advert_type.name }}
                                </span>
                            </v-avatar>
                        </v-card>
                        <v-card
                            v-else-if="buyer.advert_type.name === 'Achat'"
                            flat
                            height="100%"
                            color="rgba(0, 224, 148, 0.6)"
                            class="pa-4"
                        >
                            <v-avatar
                                size="80px"
                                color="rgba(0, 224, 148)"
                                style="border-radius: 100px;"
                                class="border-white"
                            >
                                <span class="white--text font-weight-bold">
                                    {{ buyer.advert_type.name }}
                                </span>
                            </v-avatar>
                        </v-card>
                    </v-flex>
                    <v-flex md7 style="position: relative;">
                        <!--<favorites-properties
                            class="btn-favorite"
                            :property="location.id"
                            :favorited="favoriteProperty(location.favorites)"
                        ></favorites-properties>-->
                        <v-card-title class="pt-1 pb-0">
                            <v-layout row wrap>
                                <v-flex md12>
                                    <h3 class="subheading">Rercherche {{ buyer.property_type }} sur {{ buyer.city }}</h3>
                                    <p>
                                        <img
                                            v-if="buyer.property_type === 'Appartement'"
                                            class="icon-buyer-features"
                                            src="/img/icons/BUILDING1.png"
                                            width="25px" />
                                        <img
                                            v-if="buyer.property_type === 'Maison'"
                                            class="icon-buyer-features"
                                            src="/img/icons/HOUSE1.png"
                                            width="25px" />
                                        <img
                                            v-if="buyer.property_type === 'Terrain'"
                                            class="icon-buyer-features"
                                            src="/img/icons/PARK1.png"
                                            width="25px" />
                                        <img
                                            v-if="buyer.property_type === 'Parking'"
                                            class="icon-buyer-features"
                                            src="/img/icons/PARKING1.png"
                                            width="25px" />
                                        1 {{ buyer.property_type }} de {{ buyer.living_space_max }}m² ou plus
                                    </p>
                                </v-flex>
                            </v-layout>
                        </v-card-title>
                        <v-card-text class="pt-0 pb-0">
                            <v-layout row wrap>
                                <v-flex v-if="buyer.room" md1>
                                    <img src="/img/icons/ROOM.png" width="20px" />
                                    <v-spacer></v-spacer>
                                    <span class="pl-1 text-md-center font-weight-bold">{{ buyer.room }}</span>
                                </v-flex>
                                <v-flex v-if="buyer.bedroom" md1>
                                    <img src="/img/icons/BEDROOM.png" width="20px" />
                                    <v-spacer></v-spacer>
                                    <span class="pl-1 font-weight-bold">{{ buyer.bedroom }}</span>
                                </v-flex>
                                <v-flex v-if="buyer.bathroom" md1>
                                    <img src="/img/icons/BATHROOM_2.png" width="20px" />
                                    <v-spacer></v-spacer>
                                    <span class="pl-1 font-weight-bold">{{ buyer.bathroom }}</span>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-flex>
                    <v-flex md3 class="text-md-center">
                        <v-card-actions class="">
                            <v-btn
                                dark
                                color="#2196F3"
                                round
                                small
                            >
                                <v-icon small>call</v-icon>
                                <span class="text-none">Afficher le numéro</span>
                            </v-btn>
                        </v-card-actions>
                        <v-card-actions class="">
                            <v-btn
                                dark
                                color="#2196F3"
                                round
                                small
                            >
                                <v-icon small>email</v-icon>
                                <span class="text-none">Envoyez un message</span>
                            </v-btn>
                        </v-card-actions>
                    </v-flex>
                </v-layout>

            </v-card>
        </v-flex>
        <v-flex md3>
            Sidebar
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    name: "BuyerListItem",
    props: ['buyer'],
    computed: {
      displayName(){
          var fn = this.buyer.user.firstname;
          var ln = this.buyer.user.lastname;
          fn = fn.charAt(0);
          ln = ln.charAt(0);
          var displayName = fn + ln;
        return displayName;
      },
    },
    methods: {
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
        getThumbnail(image) {
            if (image != null) {
                return "/storage/" + image;
            }
        },
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }
        },
        test() {
            return 'test';
        },
    },
};
</script>

<style scoped>
    .border-white{
        border: 2px solid white !important;
        border-color: white !important;
    }
    .icon-buyer-features {
        vertical-align: baseline;
    }
</style>
