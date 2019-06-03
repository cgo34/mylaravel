<template>
    <v-container>
        <v-layout row wrap>
            <v-flex md12>
                <h3 class="lot-section headline  mb-1 text-md-center text-uppercase font-weight-bold black--text text--text--darken-3 mb-3">Autres lots qui peuvent vous intéressez</h3>
            </v-flex>
            <v-flex md4
                    v-for="(lot,i) in additionalLots"
                    v-bind:key="i"
            >
                <lots-grid
                    :idprogramme="lot.idprogramme"
                    :idlot="lot.idlot"
                    :thumbnail="lot.thumbnail"
                    :dispositifs="lot.dispositifs"
                    :name="lot.name"
                    :city="lot.city"
                    :price="lot.price"
                ></lots-grid>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: "LotsAdditional",
    props: ['idlot', 'dispositifs', 'city', 'price'],
    data: function() {
        return {
            additionalLots: [],
        }
    },
    mounted() {
        var _this = this;
        axios.get('/lots/additional/' + this.idlot + '/' + this.city + '/' + this.price ).then((response) => {
            console.log(this.city);
            console.log(this.price);
            console.log(response);
            console.log('forEach');
            response.data.forEach(function(element) {
                console.log(element);
               element.lots.forEach(function(e) {
                   console.log(e);
                   _this.additionalLots.push({idprogramme: element.id, idlot: e.id, thumbnail: element.thumbnail, dispositifs: element.dispositifs, name: element.name, city: element.city, price: e.prix});
               });
            });
        }).catch(error => {
            console.log(error);
        });
    },
    methods: {
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }

        },
    },
};
</script>

<style scoped>

</style>
