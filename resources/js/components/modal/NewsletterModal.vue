<template>
    <v-dialog v-model="newsletterModal" max-width="500px">
        <v-btn class="no-underline font-weight-semibold btn-box-shadow-white" round large slot="activator" color="#fff"><span class="primary-color">Je m'abonne</span></v-btn>
        <v-card>
            <v-card-title class="pt-4" style="display:block; text-align: center;">
                <h2 class="primary-color text-uppercase font-weight-bold">Inscription Newsletter</h2>
                <v-btn absolute top right icon dark style="top: 18px;" @click="newsletterModal = !newsletterModal">
                    <v-icon color="#000">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text class="pt-0 pb-0">
                <v-container grid-list-md class="pt-0 pb-0">
                    <v-layout row justify-center>
                        <v-flex xs12 md8>
                            <v-text-field color="#00e094" v-model="subscriber.firstname" label="Prénom*" required></v-text-field>
                            <v-text-field color="#00e094" v-model="subscriber.lastname" label="Nom*" required></v-text-field>
                            <v-text-field color="#00e094" v-on:keyup.enter="subscribe" v-model="subscriber.email" label="Email*" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-text class="align-center pt-0 pb-0">
                <v-container class="text-md-center">
                    <v-btn color="#00e094" round dark class="btn-box-shadow-primary"  @click="subscribe">Je m'abonne</v-btn>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
  name: "NewsletterModal",
    data: function (){
        return {
            newsletterModal: false,
            subscriber: {},
        }
    },
    methods: {
      subscribe() {
          console.log('subscriber');
          axios.post('/action/subscriber', this.subscriber)
              .then((response) => {
                  console.log(response);
                  this.newsletterModal = false;
                  flash('Vous êtes maintenant abonné a la newsletter Galileo.', 'success');
              }).catch(response => console.log(response.data));
      }
    },
};
</script>

<style scoped>

</style>
