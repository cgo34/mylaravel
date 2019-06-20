<template>
    <v-dialog v-model="parrainageModal" max-width="600px">
        <v-btn class="no-underline font-weight-semibold btn-box-shadow-white" round large slot="activator" color="#00e094" dark><span>Parrainez un proche</span></v-btn>
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">Parrainer</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="parrainageModal = false">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text class="pt-0 pb-0">
                <v-container grid-list-md class="pt-0 pb-0">
                    <v-layout v-if="!user" row justify-center class="pa-5 pb-3">
                        {{ user }}
                        <v-flex xs12 md12>
                            <h3>Parrain</h3>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="parrain.firstname" label="Firstname*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="parrain.lastname" label="Lastname*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="parrain.email" label="Email*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="parrain.phone" label="Phone*" required></v-text-field>
                        </v-flex>
                    </v-layout>
                    <v-layout row justify-center class="pa-5 pt-0 pb-0">
                        <v-flex xs12 md12>
                            <h3>Filleul</h3>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="filleul.firstname" label="Firstname*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="filleul.lastname" label="Lastname*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="filleul.email" label="Email*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field color="#42DCA3" v-model="filleul.phone" label="Phone*" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-text class="align-center pt-0 pb-0">
                <v-container class="text-md-center">
                    <v-btn color="#42DCA3" round dark class="btn-box-shadow-primary"  @click="sendParrainage">Envoyer</v-btn>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "ParrainageModal",
    props: ['user'],
    data: function (){
        return {
            hover: false,
            parrainageModal: false,
            parrain: {},
            filleul: {},
            firstname: '',
            lastname: '',
            email: '',
            phone: '',
            active: 0,
        }
    },
    methods: {
        mouseOver: function(){
            this.active = !this.active;
        },
        sendParrainage() {
            var _this = this;
            var parrainage = {parrain : _this.parrain, filleul : _this.filleul};
            console.log('test parrainage');
            console.log(parrainage);
            axios.post('/action/parrainage', parrainage).then((response) => {
                console.log('test parrainage response');
                console.log(response);
                console.log(parrainage);

                this.parrain = '';
                this.filleul = '';

                this.parrainageModal = false;
            }).catch(error => {
                console.log(error.response);
                console.log(error.response.data.errors);
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    console.log(this.errors);
                }
            });
        },
    }
};
</script>

<style scoped>

</style>
