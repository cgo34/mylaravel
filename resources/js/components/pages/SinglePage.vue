<template>
    <div>
        <v-flex xs12 sm12 md12>
            <v-card light color="#fff" hover>
                <v-img :src="getImages(page.image)" height="350" aspect-ratio="1.7"></v-img>
                <v-card-title>
                    <h1 class="display-1">{{ page.title }}</h1>
                </v-card-title>
                <v-card-text>
                    <p v-html="page.body"></p>
                </v-card-text>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
export default {
  name: "SinglePage",
    props: ['paged'],
    methods: {
        getImages(image) {
            if (image != null) {
                return "/storage/" + image;
            }

        },
    },
    computed: {
        page() {
            return JSON.parse(this.paged);
        }
    }
};
</script>

<style scoped>

</style>
