<template>
    <!--<div v-if="user.role_id === 2">-->
        <div v-if="state === 'validated'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-icon color="#00e094" v-on="on">fas fa-cart-plus</v-icon>
                </template>
                <span>Votre demande d'option a été validée</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === 'pending'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-btn flat icon :color="colorPending" v-on="on" @click.prevent="unMakeOptionRequest(lot)">
                        <v-icon >fas fa-cart-plus</v-icon>
                    </v-btn>
                </template>
                <span>Supprimer ma demande d'option</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === 'refused'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-icon color="#F44336" v-on="on">fas fa-cart-plus</v-icon>
                </template>
                <span>Votre demande d'option a été refusée</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === false">
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }" >
                        <v-btn v-if="colorFalse === '#5d5d5d' && user.role_id === 2" flat icon :color="colorFalse" v-on="on" @click.prevent="openParticularOptionRequestsModal">
                            <v-icon >fas fa-cart-plus</v-icon>
                        </v-btn>
                        <v-btn v-else-if="colorFalse === '#FFC400' && user.role_id === 2" flat icon :color="colorFalse" v-on="on" @click.prevent="makeOptionRequest(lot, colorFalse)">
                            <v-icon >fas fa-cart-plus</v-icon>
                        </v-btn>
                        <v-btn v-else-if="colorFalse === '#5d5d5d' && user.role_id === 3" flat icon :color="colorFalse" v-on="on" @click.prevent="openProfessionalOptionRequestsModal">
                            <v-icon >fas fa-cart-plus</v-icon>
                        </v-btn>
                        <v-btn v-else-if="colorFalse === '#FFC400' && user.role_id === 3" flat icon :color="colorFalse" v-on="on" @click.prevent="makeOptionRequest(lot, colorFalse)">
                            <v-icon >fas fa-cart-plus</v-icon>
                        </v-btn>
                    </template>
                    <span v-if="colorFalse === '#5d5d5d'">Faire une demande d'option</span>
                    <span v-else-if="colorFalse === '#FFC400'">Supprimer ma demande d'option</span>
                </v-tooltip>

            <v-dialog
                v-model="particularOptionRequestsModal"
                max-width="800"
            >
                <v-card>
                    <v-card-title class="headline pa-3">
                        <v-flex md12 class="text-md-center">
                            Je souhaite me faire accompagner par un CGP ?
                        </v-flex>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md text-xs-center>
                            <v-layout row wrap align-center>
                                <v-flex md5 offset-md1 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round color="#42DCA3" depressed dark @click.stop="makeOptionRequest(lot, colorFalse, true)">Oui</v-btn>
                                    <p>(Un de nos conseillers prendra contact avec vous pour vous accompagner)</p>
                                </v-flex>
                                <v-divider vertical light class="mt-0 mb-0"></v-divider>
                                <v-flex md5 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round flat outline color="#42DCA3" light @click.stop="makeOptionRequest(lot, colorFalse, false)"><span>Non</span></v-btn>
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
            <v-dialog
                v-model="professionalOptionRequestsModal"
                max-width="800"
            >
                <v-card>
                    <v-card-title class="headline pa-3">
                        <v-flex md12 class="text-md-center">
                            Vous avez besoin d'être accompagné ?
                        </v-flex>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md text-xs-center>
                            <v-layout row wrap align-center>
                                <v-flex md5 offset-md1 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round color="#42DCA3" depressed dark @click.stop="makeOptionRequest(lot, colorFalse, true)">Oui</v-btn>
                                    <p>(Un de nos conseillers prendra contact avec vous pour vous accompagner)</p>
                                </v-flex>
                                <v-divider vertical light class="mt-0 mb-0"></v-divider>
                                <v-flex md5 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round flat outline color="#42DCA3" light @click.stop="makeOptionRequest(lot, colorFalse, false)"><span>Non</span></v-btn>
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
        </div>
    <!--</div>-->
    <!--<div v-else-if="user.role_id === 3">
        <div v-if="state === 'validated'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-icon color="#00e094" v-on="on">fas fa-cart-plus</v-icon>
                </template>
                <span>Votre demande d'option a été validée</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === 'pending'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-btn flat icon :color="colorPending" v-on="on" @click.prevent="unMakeOptionRequest(lot)">
                        <v-icon >fas fa-cart-plus</v-icon>
                    </v-btn>
                </template>
                <span>Supprimer ma demande d'option</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === 'refused'">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-icon color="#F44336" v-on="on">fas fa-cart-plus</v-icon>
                </template>
                <span>Votre demande d'option a été refusée</span>
            </v-tooltip>
        </div>
        <div v-else-if="state === false">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }" >
                    <v-btn v-if="colorFalse === '#5d5d5d'" flat icon :color="colorFalse" v-on="on" @click.prevent="openProfessionalOptionRequestsModal">
                        <v-icon >fas fa-cart-plus</v-icon>
                    </v-btn>
                    <v-btn v-else-if="colorFalse === '#FFC400'" flat icon :color="colorFalse" v-on="on" @click.prevent="makeOptionRequest(lot, colorFalse)">
                        <v-icon >fas fa-cart-plus</v-icon>
                    </v-btn>
                </template>
                <span v-if="colorFalse === '#5d5d5d'">Faire une demande d'option</span>
                <span v-else-if="colorFalse === '#FFC400'">Supprimer ma demande d'option</span>
            </v-tooltip>

            <v-dialog
                v-model="professionalOptionRequestsModal"
                max-width="800"
            >
                <v-card>
                    <v-card-title class="headline pa-3">
                        <v-flex md12 class="text-md-center">
                            Vous avez besoin d'être accompagné ?
                        </v-flex>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md text-xs-center>
                            <v-layout row wrap align-center>
                                <v-flex md5 offset-md1 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round color="#42DCA3" depressed dark @click.stop="makeOptionRequest(lot, colorFalse)">Oui</v-btn>
                                    <p>(Un de nos conseillers prendra contact avec vous pour vous accompagner)</p>
                                </v-flex>
                                <v-divider vertical light class="mt-0 mb-0"></v-divider>
                                <v-flex md5 pa-3>
                                    <v-btn class="btn-box-shadow-primary mb-3" round flat outline color="#42DCA3" light><span>Non</span></v-btn>
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
        </div>
    </div>-->
</template>

<script>
import testModal from '../../components/modal/ParticularOptionRequestsModal';
export default {
    name: 'BooksLots',
    components: { testModal },
    props: ['lot', 'booked', 'bookbyother', 'state', 'user'],
    data: function() {
        return {
            particularOptionRequestsModal: false,
            professionalOptionRequestsModal: false,
            isBookedLot: '',
            isBookedByOther: '',
            colorBookedByMe: '#64D8B6',
            colorBookedByOther: 'red',
            colorUnbooked: '#5d5d5d',
            color: '',
            colorFalse: '#5d5d5d',
            colorPending: '#FFC400',
            colorDemand: '#FFC400',
            users: {},
        }
    },
    methods: {
        makeOptionRequest(lot, color, accompaniment) {
            console.log('makeOptionRequest');
            console.log(color);
            if(color === '#FFC400'){
                console.log('action unmakeRequest');
                axios.post('/option/unrequest/'+lot)
                    .then((response) => {
                        console.log(response);
                        this.particularOptionRequestsModal = false;
                        this.professionalOptionRequestsModal = false;
                        this.colorFalse = '#5d5d5d';
                        flash('Votre demande d\'option à bien été supprimée.', 'success');
                    }).catch(response => console.log(response.data));
            }else if(color === '#5d5d5d'){
                console.log('action makeRequest');
                axios.post('/option/request/' + lot + '/' + accompaniment)
                    .then((response) => {
                        console.log(response);
                        this.particularOptionRequestsModal = false;
                        this.professionalOptionRequestsModal = false;
                        this.colorFalse = '#FFC400';
                        flash('Votre demande d\'option à été envoyée.', 'success');
                    }).catch(response => console.log(response.data));
            }
        },
        unMakeOptionRequest(lot) {
            console.log('unMakeOptionRequest');
            axios.post('/option/unrequest/'+lot)
                .then((response) => {
                    console.log(response);
                    this.colorPending = '#5d5d5d';
                    flash('Votre demande d\'option à bien été supprimée.', 'success');
                }).catch(response => console.log(response.data));
        },
        openParticularOptionRequestsModal() {
            console.log('display particular option requests modal');
            this.particularOptionRequestsModal = true;
        },
        openProfessionalOptionRequestsModal() {
            console.log('display professional option requests modal');
            this.professionalOptionRequestsModal = true;
        },
        book(lot) {
            console.log('book');
            console.log(this.colorBookedByMe);
            this.color = '#64D8B6';
            axios.post('/book/lot/'+lot)
                .then((response) => {
                    this.isBookedLot = true;
                    flash('Votre demande d\'option à été envoyé.', 'success');
                }).catch(response => console.log(response.data));
        },
        unBook(lot) {
            console.log('unBook');
            console.log(this.colorUnbooked);
            this.color = '#5d5d5d';
            console.log(this.colorUnbooked);
            axios.post('/unbook/lot/'+lot)
                .then((response) => {
                    this.isBookedLot = false;
                    flash('Ce lot ne vous ai plus réservé', 'success');
                })
                .catch(response => console.log(response.data));
        },
        getState(userId, lot) {
            var user = this.users;
            var tab = [];
            var state = false;
            lot.forEach( function(e) {
                if(user.id === e.user_id){
                    if(e.state === 'pending'){
                        state = 'pending';
                        tab.push(state);
                    }else if(e.state === 'validated'){
                        state = 'validated';
                        tab.push(state);
                    } else if(e.state === 'refused'){
                        state = 'refused';
                        tab.push(state);
                    }
                }
            });
            return state;
        },
    }
}
</script>
