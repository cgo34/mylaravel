<template>
    <v-card
        color="white"
        class="post-list-item"
    >
        <v-img
            :src="getImages(thumbnail)"
            aspect-ratio="1.75"
        >
        </v-img>
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    <a :href="/actualites/+slug">
                        {{ name }}
                    </a>
                </h3>
                <p>{{ excerpt }}</p>
            </div>
        </v-card-title>

        <v-card-actions>
            <v-btn flat color="#64D8B6">Immobilier</v-btn>
            <v-btn flat color="#64D8B6">Fiscalité</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    name: "Post",
    props: ['slug', 'thumbnail', 'name', 'categories', 'excerpt', 'date'],
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
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        opacity: .5;
        position: absolute;
        width: 100%;
    }
</style>
