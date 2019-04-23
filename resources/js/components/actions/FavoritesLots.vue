<template>
    <span>
    <v-tooltip top v-if="isFavoritedLot" >
        <template v-slot:activator="{ on }" >
            <v-btn flat icon color="pink" v-on="on" @click.prevent="unFavorite(lot)">
                <v-icon >favorite</v-icon>
            </v-btn>
        </template>
        <span>Enlever le lot des favoris</span>
    </v-tooltip>
    <v-tooltip top v-else >
        <template v-slot:activator="{ on }" >
            <v-btn flat icon color="pink" v-on="on" @click.prevent="favorite(lot)">
                <v-icon >favorite_border</v-icon>
            </v-btn>
        </template>
        <span>Mettre le lot en favoris</span>
    </v-tooltip>
    </span>
</template>

<script>
    export default {
        name: 'FavoritesLots',
        props: ['lot', 'favorited'],

        data: function() {
            return {
                isFavoritedLot: '',
            }
        },

        mounted() {
            if(this.favorited == 'true'){
                this.isFavoritedLot = true;
            }else{
                this.isFavoritedLot = false;
            }
            //this.$emit('update:favorited', this.isFavorited);

        },

        computed: {
            isFavorite() {
                return this.favorited;
                //this.isFavorited = !!this.favorited;
                //this.$emit('update:favorited', this.isFavorited);
            },
        },

        methods: {
            favorite(lot) {
                axios.post('/favorite/lot/'+lot)
                    .then((response) => {
                        console.log(response);
                        this.isFavoritedLot = true;
                        flash('Le lot a bien été ajouté à vos favoris.', 'success');
                    }).catch(response => console.log(response.data));
            },

            unFavorite(lot) {
                axios.post('/unfavorite/lot/'+lot)
                    .then((response) => {
                        this.isFavoritedLot = false;
                        flash('Le lot a bien été retiré de vos favoris.', 'success');
                    })
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>