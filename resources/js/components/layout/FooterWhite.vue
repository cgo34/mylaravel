<template>
    <v-footer
        id="footer-white"
        light
        height="auto"
    >
        <v-card
            hover
            tile
            class="white  grey--text text--darken-3 text-xs-center"
            width="100%"
        >
            <v-card-text>
                <v-btn
                    v-for="(icon, i) in icons"
                    :key="i"
                    icon
                >
                    <v-icon flat color="#00e094" size="24px">{{ icon }}</v-icon>
                </v-btn>
            </v-card-text>
            <v-divider></v-divider>
            <v-container fluid>
                <v-layout row wrap>
                    <v-flex md4>
                        <h5>Galileo</h5>
                    </v-flex>
                    <v-flex md3 class="text-md-left">
                        <h5 class="text-uppercase font-weight-bold">Services</h5>
                        <ul class="menu-list">
                            <li><a class="nav-link pl-0" href="#">Renégociation et rachat de prêt</a></li>
                            <li><a class="nav-link pl-0" href="#">Renégociation assurance emprunteur</a></li>
                            <li><a class="nav-link pl-0" href="#">Demande de prêt</a></li>
                            <li><a class="nav-link pl-0" href="#">Gestion locative</a></li>
                            <li><a class="nav-link pl-0" href="#">Revente d'un bien</a></li>
                            <li><a class="nav-link pl-0" href="#">Investissement immobilier</a></li>
                            <li><a class="nav-link pl-0" href="#">Placement financier</a></li>
                            <li><a class="nav-link pl-0" href="#">Recommandation</a></li>
                        </ul>
                    </v-flex>
                    <v-flex md3>
                        <h5 class="text-uppercase font-weight-bold">Dispositifs</h5>
                    </v-flex>
                    <v-flex md2>
                        <h5 class="text-uppercase font-weight-bold">Contact</h5>
                    </v-flex>
                </v-layout>
            </v-container>
            <v-card-text>
                &copy;2019 — <strong>Galileo</strong>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
export default {
    name: 'white-footer',
    data: () => ({
        icons: [
            'fab fa-facebook-f',
            'fab fa-twitter',
            'fab fa-instagram'
        ],
        page: '',
    }),
    mounted() {},
}
</script>

<style scoped>
    #footer-white {
        box-shadow: 0 -2px 4px -1px rgba(0,0,0,.2),
                    0 -4px 5px 0 rgba(0,0,0,.14),
                    0 -1px 10px 0 rgba(0,0,0,.12);
    }
</style>
