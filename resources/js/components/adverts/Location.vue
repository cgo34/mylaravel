<template>
    <v-layout row wrap>
        <v-flex md12>
        </v-flex>
        <v-flex md9>
            <v-card>
                <v-layout row wrap>
                    <v-flex md5 pa-0 pt-0 pb-0>
                        <v-img
                            v-for="(image, index) in location.files"
                            v-bind:key="index"
                            v-if="image.category_key === 'THUMBNAIL'"
                            :src="getImages(image.path)"
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
                                    <a :href="'/annonces/location/' + location.id" title=""><h3 class="title">{{ location.property_type_id }}</h3></a>
                                    <v-chip small>{{ location.living_space }}m²</v-chip>
                                    <v-chip small>{{ location.typology }}</v-chip>
                                    <v-chip small>R+{{ location.floor }}</v-chip><br>
                                    <span class="subheading secondary--text">{{ location.city }}</span>
                                </v-flex>
                                <v-flex md4 class="text-md-right">
                                    <span class="font-weight-bold title">{{ location.rent_price }} €</span>
                                    <img src="https://v.seloger.com/s/width/150/logos/1/s/z/l/1szl5iaqv57vz2bp8oobbohm9jn0kx0fda5wkl8fo.jpg" alt="FLATLOOKER" height="30px">
                                </v-flex>
                            </v-layout>
                        </v-card-title>
                        <v-card-text class="pt-0 pb-0">
                            <v-layout row wrap>
                                <v-flex md8>
                                    <p>{{ location.description }}</p>
                                </v-flex>
                                <v-flex md4>

                                </v-flex>
                            </v-layout>

                        </v-card-text>
                        <v-card-actions class="pt_0 pb_0">
                            <v-spacer></v-spacer>
                            <v-btn dark small outline icon color="#5d5d5d" @click.stop="becallModal = !becallModal">
                                <v-icon small>call</v-icon>
                            </v-btn>
                            <v-btn dark small outline icon color="#5d5d5d" @click.stop="contactModal = !contactModal">
                                <v-icon small>email</v-icon>
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
    name: "SingleLocation",
    props: ['location', 'user'],
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
