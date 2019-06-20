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
                <v-btn href="#photo" flat>Les photos</v-btn>
                <v-btn href="#lot" flat>Le bien</v-btn>
            </v-toolbar-items>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click.stop="becallModal = !becallModal">
                    <v-icon color="white">call</v-icon>
                </v-btn>
                <v-btn icon @click.stop="contactModal = !contactModal">
                    <v-icon color="white">email</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-container>
            <v-layout row wrap>
                <v-flex md9>
                    <v-flex xs12 sm12 md12>
                        <v-card light color="#fff" hover>
                            <v-layout>
                                <v-flex xs12 sm12 md12 class="pa-0">
                                    <v-carousel
                                        height="400"
                                        hide-delimiters
                                    >
                                        <v-carousel-item
                                            v-for="(image, index) in location.files"
                                            v-bind:key="index"
                                            v-if="image.category_key === 'IMAGES'"
                                            :src="getImages(image.path)"
                                        ></v-carousel-item>
                                    </v-carousel>
                                    <favorites-properties
                                        :property="location.id"
                                        :favorited="favoriteProperty(location.favorites)"
                                    ></favorites-properties>
                                </v-flex>
                            </v-layout>
                        </v-card>
                    </v-flex>
                    <v-spacer class="mb-3"></v-spacer>
                    <v-flex md12 style="position: relative;">
                        <v-card>
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
                        </v-card>
                    </v-flex>


                    <v-spacer class="mb-5"></v-spacer>

                    <h3 id="advantages" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--darken-3 mb-3"><v-icon color="#00e094">fas fa-city</v-icon> Les avantages</h3>
                    <v-spacer class="mb-1"></v-spacer>
                    <div xs12 sm12 md12 class="mb-3">
                        <v-card light color="white" class="pa-3" hover>
                            <v-card-text class="px-0 body-2">
                                <v-chip
                                    v-for="(feature, index) in location.features"
                                    v-bind:key="index"
                                    color="#D81B60" text-color="white">{{ feature.name }}</v-chip>
                            </v-card-text>
                        </v-card>
                    </div>

                    <v-spacer class="mb-5"></v-spacer>

                    <h3 id="bien" class="lot-section headline mb-1 text-md-center text-uppercase font-weight-bold black--text text--darken-3 mb-3"><v-icon color="#00e094">fas fa-city</v-icon> Le programme</h3>
                    <v-spacer class="mb-1"></v-spacer>
                    <div xs12 sm12 md12 class="mb-3">
                        <v-card light color="white" class="pa-3" hover>
                            <v-card-text class="px-0 body-2"><p>{{ location.description }}</p></v-card-text>
                        </v-card>
                    </div>
                    <v-spacer class="mb-5"></v-spacer>
                </v-flex>
                <v-flex md3>
                    <v-card>
                        <v-layout align-center row wrap>
                            <v-flex xs12 sm12 text-md-center>
                                <img src="https://v.seloger.com/s/width/150/logos/1/s/z/l/1szl5iaqv57vz2bp8oobbohm9jn0kx0fda5wkl8fo.jpg" alt="FLATLOOKER" height="30px">
                            </v-flex>
                            <v-flex xs12 sm12 text-md-center>
                                <v-btn icon @click.stop="becallModal = !becallModal">
                                    <v-icon color="grey">call</v-icon>
                                </v-btn>
                                <v-btn icon @click.stop="contactModal = !contactModal">
                                    <v-icon color="grey">email</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-container>
</template>

<script>

export default {
    name: 'SingleLocation',
    props: ['location', 'user'],
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
    },
}
</script>
<style scoped>

</style>
