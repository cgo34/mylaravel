<template>
    <v-footer
        :v-if="page"
        dark
        height="auto"
        fixed
        color="transparent"
    >
        <v-card
                flat
                tile
                class="grey--text text--darken-3 text-xs-center"
                width="100%"
                color="transparent"
        >
            <v-card-text>
                <p>ceci est un test</p>
                <v-btn
                        v-for="(icon, i) in icons"
                        :key="i"
                        class="mx-3"
                        color="white"
                        fab
                        small
                        icon
                        round
                        depressed
                        dark
                >
                    <v-icon flat size="24px" class="icon-color">{{ icon }}</v-icon>
                </v-btn>
            </v-card-text>
            <v-card-text class="rey--text text--darken-3">
                &copy;2019 — <strong>Gelileo</strong>
            </v-card-text>
        </v-card>
    </v-footer>
    <v-footer
        v-else
        light
        height="auto"
    >
        <v-card
            flat
            tile
            class="white grey--text text-xs-center"
            width="100%"
        >

            <v-card-text>
                <p>ceci est un test</p>
                <v-btn
                    v-for="(icon, i) in icons"
                    :key="i"
                    class="mx-3 white--text"
                    icon
                >
                    <v-icon flat size="24px">{{ icon }}</v-icon>
                </v-btn>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-text class="white--text">
                &copy;2019 — <strong>Gelileo</strong>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
    export default {
        name: "Footer",
        data: () => ({
            icons: [
                'fab fa-facebook-f',
                'fab fa-twitter',
                'fab fa-instagram'
            ],
            page: '',
        }),
        mounted() {
            var _this = this;
            console.log('test first visite');
            console.log(window.location);
            if((window.location.href === 'http://localhost:8000') || (window.location.href === 'http://e9c8cdc0.ngrok.io') || (window.location.href === 'http://127.0.0.1:8000')){
                this.page = true;
            }else{
                this.page = false;
            }
        },
    }
</script>

<style scoped>

</style>
