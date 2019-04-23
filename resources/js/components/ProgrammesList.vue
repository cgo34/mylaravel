<template>
    <div class="container-fluid" >
        <searchbar></searchbar>
        <div>
            <v-container fluid grid-list-md class="programmes-list">
                <v-layout row wrap>
                    <v-flex xs12 md12 pb-0 mb-0>
                        <v-layout light-blue>

                            <v-flex md2 pa-0 pt-0 pb-0>

                            </v-flex>
                            <v-flex md2 >
                                <span class="subheading text-uppercase font-weight-bold white--text">Programme</span>
                            </v-flex>
                            <v-flex md1>
                                <span class="subheading text-uppercase font-weight-bold white--text">Dispositifs</span>
                            </v-flex>
                            <v-flex md2>
                                <span class="subheading text-uppercase font-weight-bold white--text">Prix</span>
                            </v-flex>
                            <v-flex md1>
                                <span class="subheading text-uppercase font-weight-bold white--text">Livraison</span>
                            </v-flex>
                            <v-flex md2>
                                <span class="subheading text-uppercase font-weight-bold white--text">Actions</span>
                            </v-flex>
                            <v-flex md2>
                                <span class="subheading text-uppercase font-weight-bold white--text">Lots disponibles</span>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-container>
        </div>
        <div class="programmes" v-for="programme in programmes" :key="programme.id">
            <programmes
                    :id="programme.id"
                    :name="programme.name"
                    :description="programme.description"
                    :ville="programme.ville"
                    :images="programme.images"
                    :date_livraison="programme.date_livraison"
                    :code_postal="programme.code_postal"
                    :dispositifs="programme.dispositifs"
                    :programme="programme">
            </programmes>
        </div>
    </div>
</template>
<script>
    import Programmes from './Programmes'


    export default {
        resource: null,
        props: ['id', 'name', 'description', 'ville', 'thumbnail', 'date_livraison', 'code_postal', 'dispositifs'],
        data: function() {
            return {
                programmes: {},
                user: {},
                count: 0,
                priceProgramme: 1000000000,
            }
        },
        mounted () {
            axios.get('/programmeslist')
                .then((response) => {
                    this.programmes = response.data
                    this.count = this.programmes.length
                });
            axios.get('/user' ).then((response) => {


                if(response.status !== 405){
                    this.user = response.data;
                }

            }).catch(error => {
                if(error.response.status !== 405){
                }

            });
        },
        components: {
            Programmes,
        }
    }
</script>
<style>

    .container.programmes-list {
        padding: 1px 0;
    }

    .container.grid-list-md.programmes-list .layout:only-child {
        margin: 0px;
    }

    .programme-card {
        background: #fff;
    }

    .programme:nth-child(0) {
        padding-top: 0;
    }
</style>