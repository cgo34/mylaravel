<template>
    <v-flex xs12 sm12 md9>
        <v-card width="100%" hover class="mb-3">
        <v-layout align-center row wrap class="property-card" @click.stop="showLots = !showLots">
            <v-flex xs12 sm12 md2 pa-0 pt-0 pb-0>
                <v-img :src="getImages(property.thumbnail)" aspect-ratio="1.7"></v-img>
            </v-flex>
            <v-flex xs12 sm12 md4 pl-4>
                <v-layout row wrap>
                    <v-flex xs12 sm12 md12>
                        <div class="">
                            <h3 class="headline text-uppercase font-weight-bold grey--text text--darken-4">{{ property.name }}</h3>
                        </div>
                    </v-flex>
                </v-layout>
                <v-layout align-center row wrap>
                    <v-flex xs12 sm12 md4 class="text-md-left">
                        <span class="property-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ property.city }}</span>
                    </v-flex>
                    <v-flex xs12 sm12 md4 class="text-md-left">
                        <span class="property-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094" class="mr-1">far fa-calendar-alt</v-icon> {{ property.delivery }} </span>
                    </v-flex>
                    <v-flex xs12 sm12 md4 class="text-md-left">
                        <span class="property-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex xs12 sm12 md2 class="text-md-center">
                <v-chip
                    v-for="(dispositif,i) in property.dispositifs"
                    v-bind:key="i"
                    class="btn-box-shadow-secondary font-weight-bold text-uppercase"
                    outline
                    color="#2196F3"
                    text-color="#2196F3">
                    {{ dispositif.name }}
                </v-chip>
            </v-flex>
            <v-flex xs12 sm12 md2 class="text-md-center">
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn dark small outline icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                            <v-icon small>call</v-icon>
                        </v-btn>
                    </template>
                    <span>Être rappelé</span>
                    <call
                        :user="user"
                        :idproperty="property.id"
                        :nameproperty="property.name"
                        :idLot="null"
                        :numberLot="null"
                        :becallModal.sync="becallModal"
                        v-on:update:becallModal="becallModal = $event"
                    ></call>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                            <v-icon small>email</v-icon>
                        </v-btn>
                    </template>
                    <span>Contactez nous</span>
                    <contact
                        :user="user"
                        :idproperty="property.id"
                        :nameproperty="property.name"
                        :idLot="null"
                        :numberLot="null"
                        :contactModal.sync="contactModal"
                        v-on:update:contactModal="contactModal = $event"
                    ></contact>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                            <v-icon small>my_location</v-icon>
                        </v-btn>
                    </template>
                    <span>Dénoncer un client</span>
                    <denonce
                        :idproperty="property.id"
                        :nameproperty="property.name"
                        :idLot="null"
                        :numberLot="null"
                        :denonceModal.sync="denonceModal"
                        v-on:update:denonceModal="denonceModal = $event"
                    ></denonce>
                </v-tooltip>
            </v-flex>
            <v-flex xs12 sm12 md2 class="text-md-center">
                <v-btn round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                <property-lots
                    :user="user"
                    :property="property"
                    :idproperty="property.id"
                    :nameproperty="property.name"
                    :lots="property.properties"
                    :showLots.sync="showLots"
                    v-on:update:showLots="showLots = $event"
                ></property-lots>
            </v-flex>
        </v-layout>
        </v-card>
    </v-flex>
</template>

<script>
export default {
    name: "Properties",
    props: ['property', 'minimum', 'countfinal', 'user'],
    data: function() {
        return {
            showLots: false,
            becallModal: false,
            contactModal: false,
            denonceModal: false,
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
};
</script>

<style scoped>

</style>
