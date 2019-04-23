<template>
    <span>
    <v-tooltip top v-if="isFavorited" >
        <template v-slot:activator="{ on }" >
            <v-btn flat icon color="pink" v-on="on" @click.prevent="unFavorite(programme)">
                <v-icon >favorite</v-icon>
            </v-btn>
        </template>
        <span>Enlever le programme des favoris</span>
    </v-tooltip>
    <v-tooltip top v-else >
        <template v-slot:activator="{ on }" >
            <v-btn flat icon color="pink" v-on="on" @click.prevent="favorite(programme)">
                <v-icon >favorite_border</v-icon>
            </v-btn>
        </template>
        <span>Mettre le programme en favoris</span>
    </v-tooltip>
    </span>
</template>

<script>
    export default {
        name: 'Favorites',
        props: ['programme', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            if(this.favorited == 'true'){
                this.isFavorited = true;
            }else{
                this.isFavorited = false;
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
            favorite(programme) {
                axios.post('/favorite/programme/'+programme)
                    .then((response) => {
                        this.isFavorited = true;
                        flash('Le programme a bien été ajouté à vos favoris.', 'success');
                }).catch(response => console.log(response.data));
            },

            unFavorite(programme) {
                axios.post('/unfavorite/programme/'+programme)
                    .then((response) => {
                        this.isFavorited = false;
                        flash('Le programme a bien été retiré de vosfavoris.', 'success');
                    })
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>