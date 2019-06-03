<template>
    <v-footer
        dark
        height="auto"
        fixed
        id="transparent-footer"
        color="transparent"
    >

        <v-card
            flat
            tile
            class="white--text text-xs-center"
            width="100%"
            color="transparent"
        >
            <v-container fluid>
                <v-layout row  justify-space-around class="mb-2">
                    <span class="group pa-2">
                        <v-icon class="group pa-2">fab fa-facebook-f</v-icon>
                        <v-icon class="group pa-2">fab fa-twitter</v-icon>
                        <v-icon class="group pa-2">fab fa-instagram</v-icon>
                      </span>
                </v-layout>
            </v-container>
            <v-card-text class="white--text">
                &copy;2019 — <strong>Galileo</strong>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
export default {
    name: "footer-transparent",
    data: () => ({
        icons: [
            'fab fa-facebook-f',
            'fab fa-twitter',
            'fab fa-instagram'
        ],
        page: '',
    }),
    mounted() {
    },
}
</script>

<style scoped>

</style>
