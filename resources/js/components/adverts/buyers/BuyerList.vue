<template>
    <div>
        <v-container fluid>
            <v-layout row wrap>
                <v-flex md12 v-bind:key="index" v-for="(buyer, index) in buyers">
                    <buyer-list-item
                        :buyer="buyer"
                    ></buyer-list-item>
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
    name: "buyerList",
    data() {
        return {

        };
    },
    mounted() {
        this.$store.dispatch('adverts/loadBuyers');
    },
    computed: {
        buyers() {
            return this.$store.state.adverts.buyers;
        },
    },
};
</script>

<style scoped>

</style>
