<template>
    <v-tooltip bottom v-if="isFavoritedProperty" >
        <template v-slot:activator="{ on }" >
            <v-btn
                absolute
                class="btn-favorite"
                small
                dark
                fab
                color="white"
                v-on="on"
                @click.prevent="unFavorite(property)">
                <v-icon color="pink">favorite</v-icon>
            </v-btn>
        </template>
        <span>Enlever le bien des favoris</span>
    </v-tooltip>
    <v-tooltip bottom v-else >
        <template v-slot:activator="{ on }" >
            <v-btn
                absolute
                class="btn-favorite"
                small
                dark
                fab
                color="white"
                v-on="on"
                @click.prevent="favorite(property)">
                <v-icon color="pink">favorite_border</v-icon>
            </v-btn>
        </template>
        <span>Mettre le bien en favoris</span>
    </v-tooltip>
</template>

<script>
export default {
    name: 'FavoritesProperties',
    props: ['property', 'favorited'],
    data: function() {
        return {
            isFavoritedProperty: '',
        }
    },
    mounted() {
        if(this.favorited === true){
            this.isFavoritedProperty = true;
        }else{
            this.isFavoritedProperty = false;
        }
    },
    methods: {
        favorite(property) {
            axios.post('/favorite/property/'+property)
                .then((response) => {
                    console.log(response);
                    this.isFavoritedProperty = true;
                    flash('Le bien a été ajouté à vos favoris.', 'success');
                }).catch(response => console.log(response.data));
        },
        unFavorite(property) {
            axios.post('/unfavorite/property/'+property)
                .then((response) => {
                    this.isFavoritedProperty = false;
                    flash('Le bien a été retiré de vos favoris.', 'success');
                })
                .catch(response => console.log(response.data));
        }
    }
}
</script>

<style>
    .btn-favorite {
        left: -20px;
        top: 80px;
        box-shadow: none !important;
    }
</style>
