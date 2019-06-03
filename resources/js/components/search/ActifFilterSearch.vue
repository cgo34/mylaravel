<template>
    <v-container fluid>
        <v-layout wrap>
            <v-flex md12>
                <v-card color="white" hover>
                    <v-layout wrap align-center>
                        <v-flex md3>
                            <v-card-text>
                                Résultats de votre recherche :
                            </v-card-text>
                        </v-flex>
                        <v-flex md9 class="text-md-left">
                            <v-chip v-if="actifcity" class="btn-box-shadow-secondary" text-color="white" color="#6495ed" v-model="city" @click="city = !city">{{ actifcity }}</v-chip>
                            <v-chip v-if="actiflaw" class="btn-box-shadow-secondary" text-color="white" color="#6495ed" v-model="law" @click="law = !law">{{ actiflaw }}</v-chip>
                            <v-chip v-if="actifprice" class="btn-box-shadow-secondary" text-color="white" color="#6495ed" v-model="price" @click="price = !price">{{ actifprice }} €</v-chip>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
  name: "ActifFilterSearch",
    props: ['actifcity', 'actiflaw', 'actifprice'],
    data () {
        return {
            city: true,
            law: true,
            price: true,
        }
    }
};
</script>

<style scoped>

</style>
