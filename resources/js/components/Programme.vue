<template>

            <v-flex xs12 md12>
                <v-layout align-center class="programme-card">
                    <v-flex md2 pa-0 pt-0 pb-0>
                        <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                        <!--<v-carousel hide-delimiters hide-controls height="auto" >
                            <v-carousel-item
                                    v-for="(thumb, i) in JSON.parse(thumbnail)"
                                    :key="i"
                                    :src="getImages(thumb)"

                            ></v-carousel-item>
                        </v-carousel>-->
                    </v-flex>
                    <v-flex md2 pl-5>
                        <div class="">

                            <a :href="/programmes/+id"><h3 class="primary-color">{{ name }}</h3></a>
                            <p>Exclusivité Galileo</p>
                        </div>
                    </v-flex>
                    <v-flex md1>
                        <v-chip color="#65D6B5" text-color="white">
                            <b>{{ dispositifs }}</b>
                        </v-chip>
                    </v-flex>
                    <v-flex md1 class="text-md-center">
                        <v-icon>location_on</v-icon><br><b>Localisation</b><br>
                        {{ city }} {{ zipcode }}
                    </v-flex>
                    <v-flex md1 class="text-md-center">
                        <v-icon>euro</v-icon><br><b>A partir de</b><br>
                        {{ minimum }}
                    </v-flex>
                    <v-flex md1 class="text-md-center">
                        <v-card-text primary-title>
                            <div>
                                <v-icon>date_range</v-icon><br><b>Livraison</b><br>
                                {{ livraison }}
                            </div>
                        </v-card-text>
                    </v-flex>
                    <v-flex md2 class="text-md-center">
                            <!--<favorites
                                    :programme="id"
                                    :favorited="favorites"
                            ></favorites>-->
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                        <v-icon>call</v-icon>
                                    </v-btn>
                                </template>
                                <span>Être rappelé</span>
                                <call
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :becallModal.sync="becallModal"
                                        v-on:update:becallModal="becallModal = $event"
                                ></call>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                        <v-icon>email</v-icon>
                                    </v-btn>
                                </template>
                                <span>Contactez nous</span>
                                <contact
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :contactModal.sync="contactModal"
                                        v-on:update:contactModal="contactModal = $event"
                                ></contact>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                        <v-icon>my_location</v-icon>
                                    </v-btn>
                                </template>
                                <span>Dénoncer un client</span>
                                <denonce
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :denonceModal.sync="denonceModal"
                                        v-on:update:denonceModal="denonceModal = $event"
                                ></denonce>
                            </v-tooltip>
                                <!--<v-speed-dial
                                        v-model="fab"
                                        :top="top"
                                        :bottom="bottom"
                                        :right="right"
                                        :left="left"
                                        :direction="direction"
                                        :open-on-hover="hover"
                                        :transition="transition"
                                >
                                    <template v-slot:activator>
                                        <v-btn
                                                v-model="fab"
                                                color="blue darken-2"
                                                dark
                                                fab
                                        >
                                            <v-icon>add</v-icon>
                                            <v-icon>close</v-icon>
                                        </v-btn>
                                    </template>

                                    <v-btn
                                            fab
                                            dark
                                            small
                                            color="green"
                                            @click.stop="becallModal = !becallModal"
                                    >
                                        <v-icon>call</v-icon>
                                    </v-btn>
                                    <call
                                            :idProgramme="id"
                                            :nameProgramme="name"
                                            :idLot="null"
                                            :numberLot="null"
                                            :becallModal.sync="becallModal"
                                            v-on:update:becallModal="becallModal = $event"
                                    ></call>

                                    <v-btn
                                            fab
                                            dark
                                            small
                                            color="blue"
                                            @click.stop="contactModal = !contactModal"
                                    >
                                        <v-icon>email</v-icon>
                                    </v-btn>
                                    <contact
                                            :idProgramme="id"
                                            :nameProgramme="name"
                                            :idLot="null"
                                            :numberLot="null"
                                            :contactModal.sync="contactModal"
                                            v-on:update:contactModal="contactModal = $event"
                                    ></contact>
                                    <v-btn
                                            fab
                                            dark
                                            small
                                            color="red"
                                            @click.stop="denonceModal = !denonceModal"
                                    >
                                        <v-icon>location_searching</v-icon>
                                    </v-btn>
                                    <denonce
                                            :idProgramme="id"
                                            :nameProgramme="name"
                                            :idLot="null"
                                            :numberLot="null"
                                            :denonceModal.sync="denonceModal"
                                            v-on:update:denonceModal="denonceModal = $event"
                                    ></denonce>
                                </v-speed-dial>-->

                    </v-flex>
                    <v-divider vertical></v-divider>
                    <v-flex md2 class="text-md-center">

                        <div>

                            <v-btn v-if="favoritePage" round color="#65D6B5" depressed dark @click.stop="showLots = !showLots">{{ count }} lots <v-icon>expand_more</v-icon></v-btn>
                            <v-btn v-else round color="#65D6B5" dark depressed @click.stop="showLots = !showLots">{{ count }} lots <v-icon>expand_more</v-icon></v-btn>
                            <programme-lots
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :countLots="count"
                                    :listingLots="lots"
                                    :favoritedlots="favoriteslots"
                                    :showLots.sync="showLots"
                                    v-on:update:showLots="showLots = $event"

                            ></programme-lots>
                        </div>
                    </v-flex>
                </v-layout>
            </v-flex>
</template>

<script>

    import ProgrammeLots from './ProgrammeLots';
    import Call from './actions/Call';
    import Contact from './actions/Contact';
    import Denonce from './actions/Denonce';
    import Favorites from './Favorites';


    export default {
        name: "Programme",
        components: {
            ProgrammeLots,
            Call,
            Contact,
            Denonce,
            Favorites
        },
        props: ['id', 'thumbnail', 'images', 'name', 'city', 'zipcode', 'dispositifs', 'livraison', 'count', 'lots', 'minimum', 'favorites', 'favoriteslots', 'favoritespage'],
        data: function() {
            return {
                showLots: false,
                becallModal: false,
                contactModal: false,
                denonceModal: false,
                isFavorites: '',
                direction: 'right',
                fab: false,
                fling: false,
                hover: false,
                tabs: null,
                top: false,
                right: true,
                bottom: true,
                left: false,
                transition: 'slide-y-reverse-transition',
                favoritePage: this.favoritespage,
                results: [],

            }
        },
        /*mounted() {
            console.log(this.favorites);
            this.isFavorited = this.favorited ? true : false;
            this.$emit('update:favorited', this.isFavorited);
        },
        computed: {
            isFavorite() {
                return this.favorited;
                //this.isFavorited = !!this.favorited;
                //this.$emit('update:favorited', this.isFavorited);
            },
        },*/
        computed: {
            activeFab () {
                switch (this.tabs) {
                    case 'one': return { 'class': 'green', icon: 'call' }
                    case 'two': return { 'class': 'blue', icon: 'email' }
                    case 'three': return { 'class': 'red', icon: 'location_searching' }
                    default: return {}
                }
            }
        },
        watch: {
            top (val) {
                this.bottom = !val
            },
            right (val) {
                this.left = !val
            },
            bottom (val) {
                this.top = !val
            },
            left (val) {
                this.right = !val
            }
        },
        methods: {
            getImages(image) {
                if (image != null) {
                    return "/storage/" + image;
                }

            },
            outside: function(e) {
                this.$emit('update:contactModal', false);
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

    /* This is for documentation purposes and will not be needed in your application */
    #create .v-speed-dial {
        position: absolute;
    }

    #create .v-btn--floating {
        position: relative;
    }

</style>