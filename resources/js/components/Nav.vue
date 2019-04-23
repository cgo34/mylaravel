<template>
    <v-layout>
        <v-navigation-drawer
                fixed
                v-model="drawer"
                app
                right
        >
            <v-list dense>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>contact_mail</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Contact</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>

            <v-spacer></v-spacer>
            <ul class="navbar-nav ml-auto">
                <v-divider vertical></v-divider>
                <li class="nav-item text-center">
                    <v-icon>favorite_border</v-icon>
                    <a class="nav-link grey--text darken-1--text" @click.stop="drawer = !drawer" href="#"><span>Mes Favoris</span></a>
                </li>

                <v-divider vertical></v-divider>
            </ul>
            <login></login>
        </v-toolbar>

    </v-layout>
</template>

<script>
    import login from './Login'

    export default {
        name: "Nav",
        data: () => ({
            drawer: null
        })
    }
</script>

<style scoped>

</style>