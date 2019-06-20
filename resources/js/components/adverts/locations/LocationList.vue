<template>
    <div>
        <v-container fluid>
            <v-layout row wrap>
                <v-flex md12 v-bind:key="index" v-for="(location, index) in locations">
                    {{ location.files }}
                    <location-list-item
                        :location="location"
                    ></location-list-item>
                    <v-spacer class="mt-2"></v-spacer>
                </v-flex>
                <v-flex md12>
                    <v-btn
                        color="success">
                        Load more
                    </v-btn>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "locations",
    data() {
        return {

        };
    },
    mounted() {
        this.$store.dispatch('locations/loadLocations');
    },
    computed: {
        locations() {
            return this.$store.state.locations.locations;
        },
    },
};
</script>

<style scoped>

</style>
