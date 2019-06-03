<template>
    <v-layout row wrap align-center justify-center>
        <v-dialog
            v-model="particularOptionRequestsModal"
            max-width="800"
        >
            <v-card>
                {{ user }}
                {{ lot }}
                {{ state }}
                <v-card-title class="headline pa-3">
                    <v-flex md12 class="text-md-center">
                        Je souhaite me faire accompagner par un CGP ?
                    </v-flex>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md text-xs-center>
                        <v-layout row wrap align-center>
                            <v-flex md5 offset-md1 pa-3>
                                <v-btn class="btn-box-shadow-primary" round color="#42DCA3" depressed dark @click.stop="makeOptionRequest(lot)">Oui</v-btn><br>
                            </v-flex>
                            <v-divider vertical light class="mt-0 mb-0"></v-divider>
                            <v-flex md5 pa-3>
                                <v-btn class="btn-box-shadow-primary" round flat outline color="#42DCA3" light><span>Non</span></v-btn>
                                <p>(Vous connaissez le marché et les produits, recevez un <b>Cash Back</b>)</p>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>

                <v-card-text class="text-md-center">
                    <p>Vous n'êtes pas sûr de vous ? Regardez en détails nos <a href="#">services d'accompagnement</a></p>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
export default {
    name: "ParticularOptionRequestsModal",
    props: ['lot', 'state', 'user'],
    data: function() {
        return {
            particularOptionRequestsModal: false,
            color: '',
            colorFalse: '#5d5d5d',
            colorPending: '#FFC400',
            colorDemand: '#FFC400',
        }
    },
    methods: {
        makeOptionRequest(lot) {
            console.log('makeOptionRequest');
            axios.post('/option/request/'+lot)
                .then((response) => {
                    console.log(response);
                    this.colorFalse = '#FFC400';
                    flash('Votre demande d\'option à été envoyée.', 'success');
                }).catch(response => console.log(response.data));
        }
    }
};
</script>

<style scoped>

</style>
