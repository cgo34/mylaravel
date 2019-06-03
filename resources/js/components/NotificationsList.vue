<template>
        <v-list two-line>
            <template v-for="(item, index) in notifications">
                <v-subheader
                        v-if="item.header"
                        :key="item.header"
                >
                    {{ item.header }}
                </v-subheader>

                <v-divider
                        v-else-if="item.divider"
                        :key="index"
                        :inset="item.inset"
                        class="mt-0 mb-0"
                ></v-divider>

                <v-list-tile
                        v-else
                        :key="index"
                        avatar
                        @click.stop="showNotification(item.id)"
                >

                    <v-list-tile-avatar>
                        <img :src="getImages(item.avatar)">
                    </v-list-tile-avatar>
                    <v-list-tile-content>

                        <v-list-tile-title v-html="item.type"></v-list-tile-title>
                        <v-list-tile-sub-title v-html="item.message"></v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <!-- v-bind:href="/notifications/ + item.id" -->
                        <v-btn icon ripple @click.stop="updateNotification(id)" >
                            <v-icon color="grey lighten-1">clear</v-icon>
                        </v-btn>
                    </v-list-tile-action>
                </v-list-tile>

            </template>
        </v-list>
    <!--</v-menu>-->

</template>

<script>
    export default {
        data () {
            return {
                listnotifications: [],
                notifications: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                statistiques: {
                   'denonce': '',
                   'contact': '',
                   'call': ''
                },

            }
        },
        mounted () {
            axios.get('/list-notifications')
                .then((response) => {
                    this.listnotifications =  response.data;
                    console.log(this.listnotifications);
                    var _this = this;
                    var countDenonce = '';
                    var countContact = '';
                    var countCall = '';
                    this.listnotifications.forEach(function(element) {
                        console.log('notification');
                        let typeNotif = '';
                        let msg = '';

                        if(element.type === "App\\Notifications\\NewDenonce"){
                            console.log('dénonce');
                            typeNotif = 'Nouvelle Dénonce';
                            countDenonce++;

                            if(element.data.programme === null){
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' a dénoncé un client';
                            }else{
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' a dénoncé un client pour le programme : ' + element.data.programme.name;
                            }
                        }else if(element.type === "App\\Notifications\\ContactNotification"){
                            console.log('contact');
                            typeNotif = 'Nouveau Contact';
                            countContact++;

                            if(element.data.programme === null){
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' vous a contacté';
                            }else{
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' vous a contacté pour le programme : ' + element.data.programme.name;
                            }
                        }else if(element.type === "App\\Notifications\\NewCall"){
                            console.log('call');
                            typeNotif = 'Nouveau Call';
                            countCall++;

                            if(element.data.programme === null){
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' souhaite être rappelé';
                            }else{
                                msg = element.data.user.firstname + '.' + element.data.user.lastname.substring(0, 1) + ' souhaite être rappelé pour le programme : ' + element.data.programme.name;
                            }
                        }

                        _this.statistiques.denonce = countDenonce;
                        _this.statistiques.contact = countContact;
                        _this.statistiques.call = countCall;

                        _this.notifications.push({id: element.id, type: typeNotif, avatar: element.data.user.avatar, message: msg});
                        _this.notifications.push({divider: true, inset: true });

                        console.log('array');
                        console.log(_this.notifications);
                    });
                }).catch(error => {
                    console.log(error);
                });
        },
        methods: {
            getImages(image){
                if(image != null){
                    return "/storage/"+image;
                }

            },
            removeItem(notification){
                for(var i = 0; i < this.notifications.length; i++){
                    if(this.notifications[i]['id'] === notification){
                        alert('in array');
                        delete this.notifications[i];
                    }
                }
                console.log('List notifs after update');
                console.log(this.notifications);
                return this.notifications;
            },
            showNotification(id){
                alert('show');
                window.location.href = "/notifications/" + id;
                /*axios.get('/notification/read/', id)
                    .then((response) => {
                        console.log(response.data);
                    }).catch(error => {
                    console.log(error.response);
                });*/
            },
            updateNotification(notification){
                alert('Update');
                /*for(var i = 0; i < this.notifications.length; i++){
                    console.log(notification);
                    console.log(this.notifications[i]['id']);
                    console.log('--------------------------------------');
                    if(this.notifications[i]['id'] === notification){
                        alert('in array');
                        delete this.notifications[i];
                    }
                }
                console.log('List notifs after update');*/
                console.log(notification);
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
