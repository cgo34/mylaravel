<template>
    <v-layout row wrap>
        <v-flex md9>
            <v-card>
                <v-layout row wrap>
                    <v-flex md5 pa-0 pt-0 pb-0>
                        <v-img
                            v-for="(image, index) in location.property.files"
                            v-bind:key="index"
                            v-if="image.category_key === 'THUMBNAIL'"
                            :src="'../storage/img/' + image.path"
                            aspect-ratio="1.7">
                        </v-img>
                    </v-flex>
                    <v-flex md7 style="position: relative;">
                        <favorites-properties
                            class="btn-favorite"
                            :property="location.id"
                            :favorited="favoriteProperty(location.favorites)"
                        ></favorites-properties>
                        <v-card-title>
                            <v-layout row wrap>
                                <v-flex md8>
                                    <a :href="'/annonces/location/' + location.id" title=""><h3 class="title">{{ location.property.property_type_id }}</h3></a>
                                    <v-chip small>{{ location.property.living_space }}m²</v-chip>
                                    <v-chip small>{{ location.property.typology }}</v-chip>
                                    <v-chip small>R+{{ location.property.floor }}</v-chip><br>
                                    <span class="subheading secondary--text">{{ location.property.zipcode }}</span>
                                </v-flex>
                                <v-flex md4 class="text-md-right">
                                    <span class="font-weight-bold title">{{ location.property.rent_price }}€/mois</span>
                                    <img src="https://v.seloger.com/s/width/150/logos/1/s/z/l/1szl5iaqv57vz2bp8oobbohm9jn0kx0fda5wkl8fo.jpg" alt="FLATLOOKER" height="30px">
                                </v-flex>
                            </v-layout>
                        </v-card-title>
                        <v-card-text  class="pt-0">
                            <v-layout row wrap>
                                <v-flex md12>
                                    <p>{{ location.property.description }}</p>
                                </v-flex>
                            </v-layout>

                        </v-card-text>
                        <!--<v-card-actions class="">
                            <v-spacer></v-spacer>
                            <v-btn
                                dark
                                color="orange"
                                round
                                small
                            >
                                <v-icon small>call</v-icon>
                                <span class="text-none">Afficher le numéro</span>
                            </v-btn>
                            <v-btn
                                dark
                                color="blue"
                                round
                                small
                            >
                                <v-icon small>email</v-icon>
                                <span class="text-none">Envoyez un message</span>
                            </v-btn>
                        </v-card-actions>-->
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
    name: "LocationListItem",
    props: ['location'],
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

</style>
