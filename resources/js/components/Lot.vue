<template>
    <v-layout>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-img
                        src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
                        aspect-ratio="2.75"
                ></v-img>

                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Kangaroo Valley Safari</h3>
                        <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
                    </div>
                </v-card-title>

                <v-card-actions>
                    <v-btn flat color="orange">Share</v-btn>
                    <v-btn flat color="orange">Explore</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import Programmes from './Programmes'


    export default {
        resource: null,
        /*props: ['programmes'],*/
        data () {
            return {
                lot: {},
                card_text: 'Lorem ipsum dolor sit amet, brute iriure accusata ne mea. Eos suavitate referrentur ad, te duo agam libris qualisque, utroque quaestio accommodare no qui. Et percipit laboramus usu, no invidunt verterem nominati mel. Dolorem ancillae an mei, ut putant invenire splendide mel, ea nec propriae adipisci. Ignota salutandi accusamus in sed, et per malis fuisset, qui id ludus appareat.',

            }
        },
        mounted () {
            axios.get('/programmes/'+this.programme.id+'/lots/'+ props.item.id)
                .then((response) => {
                    this.lot = response.data
                    console.log(lot);
                })
        },
        components: {
            Programmes,
        }
    }
</script>
<style scoped>

</style>