<template>
    <div>
        <v-flex xs12 sm12 md12>
            <v-card light color="#fff" hover>
                <v-img :src="getImages(article.image)" height="350" aspect-ratio="1.7"></v-img>
                <v-card-title>
                    <h1 class="display-1">{{ article.title }}</h1>
                </v-card-title>
                <v-card-text>
                    <p v-html="article.body"></p>
                </v-card-text>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
export default {
    name: "SinglePost",
    props: ['post'],
    methods: {
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }

        },
    },
    mounted () {
      console.log(article);
    },
    computed: {
        article() {
            return JSON.parse(this.post);
        }
    }
};
</script>

<style scoped>

</style>
