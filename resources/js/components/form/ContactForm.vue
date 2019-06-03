<template>
    <!-- contact modal -->
        <v-card hover>
            <v-card-title>
                <v-flex md12 class="text-md-center">
                    <h3>Nous somme désolé, mais aucuns programmes ne correspond à votre recherche</h3>
                    <h4>Utilisez le formulaire ci dessous pour nous expliqué plus précisement votre projet</h4>
                </v-flex>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Prénom*" v-model="usercontact.firstname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Nom*" v-model="usercontact.lastname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Email*" v-model="usercontact.email" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sd6 md6>
                            <v-text-field label="Téléphone*" v-model="usercontact.phone" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md12>
                            <v-text-field v-model="usercontact.address" label="Adresse*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="usercontact.zipcode" label="Code postal*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-text-field v-model="usercontact.city" label="Ville*"  required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-textarea
                                v-model="usercontact.message"
                                name="message"
                                label="Message"
                                value=""
                            ></v-textarea>
                        </v-flex>

                    </v-layout>
                </v-container>
                <small>*indicates required field</small>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="#42DCA3" round dark @click="contactClient()">Envoyer</v-btn>
            </v-card-actions>
        </v-card>
</template>

<script>
export default {
    name: "ContactForm",
    props: ['user'],
    data: function () {
        return {
            usercontact: {},
            programme: {
                'id': '', 'name': '',
            },
            lot: {
                'id': '', 'number': '',
            },
        }
    },
    mounted() {
        console.log('user');
        console.log(this.user);
        console.log(this.user.id);
        console.log(this.user.firstname);
        console.log(this.user.lastname);
        this.usercontact = JSON.parse(this.user);

        console.log(this.usercontact);
        console.log(this.usercontact.id);
        console.log(this.usercontact.firstname);
        console.log(this.usercontact.lastname);
    },
    methods: {
        contactClient() {
            var _this = this;
            var calling = {client : _this.usercontact, programme : _this.programme, lot : _this.lot};
            console.log(calling);
            axios.post('/action/contact', calling ).then((response) => {
                this.user = {}; //Clear input fields.
                flash('Votre demande de contact à bien été prise en compte.', 'success');
            }).catch(error => {
                console.log(error.response);
            });
        },
    },
}
</script>

<style scoped>

</style>
