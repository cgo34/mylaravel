<template>
    <v-flex>
        <v-card>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12 class="pt-0">
                    <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                </v-flex>
                <v-flex xs12 sm12 md12 class="pl-3 pr-3">
                    <h3 class="subheading text-uppercase font-weight-bold grey--text text--darken-4">
                        <a :href="/programmes/+idprogramme+/lots/+idlot">{{ name }}</a>
                    </h3>
                </v-flex>
                <v-flex xs12 sm12 md12 class="pl-3 pr-3">
                    <v-chip
                        text-color="white"
                        color="#00e094"
                        expensed
                        small
                        class="pr-3 pl-3 btn-box-shadow-primary"
                        v-for="(dispositif,i) in dispositifs"
                        v-bind:key="i"
                    >
                        <v-avatar>
                            <v-icon>account_balance</v-icon>
                        </v-avatar>
                        <b>{{ dispositif.name }}</b>
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md12 class="pl-3 pr-3 text-md-left">
                    <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                </v-flex>
                <v-flex xs12 sm12 md12 class="pl-3 pr-3 text-md-left">
                    <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> {{ price }} </span>
                </v-flex>
            </v-layout>
        </v-card>
    </v-flex>
</template>

<script>
export default {
    name: "LotsGrid",
    props: ['idprogramme', 'idlot', 'thumbnail', 'dispositifs', 'name', 'city', 'price'],
    methods: {
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }

        },
    },
};
</script>

<style scoped>

</style>
