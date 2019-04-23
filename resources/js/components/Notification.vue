<template>
    <v-list two-line>
        <v-list-tile
                avatar

        >

            <v-list-tile-avatar>
                <img :src="getImages(avatar)">
            </v-list-tile-avatar>
            <v-list-tile-content>

                <v-list-tile-title v-html="type"></v-list-tile-title>
                <v-list-tile-sub-title v-html="message"></v-list-tile-sub-title>
            </v-list-tile-content>
            <v-list-tile-action>
                <!-- v-bind:href="/notifications/ + item.id" -->
                <v-btn icon ripple @click.stop="updateNotification(id)" >
                    <v-icon color="grey lighten-1">clear</v-icon>
                </v-btn>
            </v-list-tile-action>
        </v-list-tile>

    </v-list>
    <!--</v-menu>-->

</template>

<script>

    export default {
        props: ['id', 'type', 'data', 'avatar', 'message'],
        methods: {
            getImages(image) {
                if (image != null) {
                    return "/storage/" + image;
                }

            },
            showNotification(id){
                window.location.href = "/notifications/" + id;
            },
            updateNotification(notification){
                axios.post('/notifications/', notification, { 'headers': {'X-AUTH-TOKEN': localStorage.token}})
                    .then((response) => {
                        console.log(response.data);
                    }).catch(error => {
                    console.log(error.response);
                });
            },
        }

    }
</script>

<style scoped>

</style>