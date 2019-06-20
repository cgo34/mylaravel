<template>
    <div v-if="page === 'myfavorites'">
        <v-flex xs12 sm12 md12>
            <v-layout align-center row wrap class="programme-card" @click.stop="showLots = !showLots">
                <v-flex xs12 sm12 md2 pa-0 pt-0 pb-0>
                    <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                </v-flex>
                <v-flex xs12 sm12 md4 pl-4>
                    <v-layout row wrap>
                        <v-flex xs12 sm12 md12>
                            <div class="">
                                <h3 class="headline text-uppercase font-weight-bold grey--text text--darken-4">{{ name }}</h3>

                            </div>
                        </v-flex>
                    </v-layout>
                    <v-layout align-center row wrap>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094" class="mr-1">far fa-calendar-alt</v-icon> {{ livraison }} </span>
                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                <v-icon small>call</v-icon>
                            </v-btn>
                        </template>
                        <span>Être rappelé</span>
                        <call
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :becallModal.sync="becallModal"
                            v-on:update:becallModal="becallModal = $event"
                        ></call>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                <v-icon small>email</v-icon>
                            </v-btn>
                        </template>
                        <span>Contactez nous</span>

                        <contact
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :contactModal.sync="contactModal"
                            v-on:update:contactModal="contactModal = $event"
                        ></contact>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                <v-icon small>my_location</v-icon>
                            </v-btn>
                        </template>
                        <span>Dénoncer un client</span>
                        <denonce
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :denonceModal.sync="denonceModal"
                            v-on:update:denonceModal="denonceModal = $event"
                        ></denonce>
                    </v-tooltip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                            :userdata="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :countLots="count"
                            :listingLots="lots"
                            :favoritedlots="favoriteslots"
                            :bookedlots="bookslots"
                            :page="page"
                            :showLots.sync="showLots"
                            v-on:update:showLots="showLots = $event"

                        ></programme-lots>
                    </div>
                </v-flex>
                <!--<v-flex xs12 sm12 md2 pl-4>
                    <div class="">
                        <h3 class="headline primary-color">{{ name }}</h3>
                        <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                    </div>
                </v-flex>
                <v-flex xs12 sm12 md1>
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-right">
                    <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                </v-flex>
                <v-flex offset-md1></v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                    <v-icon>call</v-icon>
                                </v-btn>
                            </template>
                            <span>Être rappelé</span>
                            <call
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :becallModal.sync="becallModal"
                                    v-on:update:becallModal="becallModal = $event"
                            ></call>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                    <v-icon>email</v-icon>
                                </v-btn>
                            </template>
                            <span>Contactez nous</span>

                            <contact
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :contactModal.sync="contactModal"
                                    v-on:update:contactModal="contactModal = $event"
                            ></contact>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                    <v-icon>my_location</v-icon>
                                </v-btn>
                            </template>
                            <span>Dénoncer un client</span>
                            <denonce
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :denonceModal.sync="denonceModal"
                                    v-on:update:denonceModal="denonceModal = $event"
                            ></denonce>
                        </v-tooltip>
                </v-flex>
                <v-divider vertical></v-divider>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                                :userdata="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :countLots="count"
                                :listingLots="lots"
                                :favoritedlots="favoriteslots"
                                :bookedlots="bookslots"
                                :alreadybookslotsbyotheruser="alreadybookslotsbyotheruser"
                                :showLots.sync="showLots"
                                v-on:update:showLots="showLots = $event"
                        ></programme-lots>
                    </div>
                </v-flex>-->
            </v-layout>
        </v-flex>
    </div>
    <div v-else-if="page === 'mybooks'">
        <v-flex xs12 sm12 md12>
            <v-layout align-center row wrap class="programme-card" @click.stop="showLots = !showLots">
                <v-flex xs12 sm12 md2 pa-0 pt-0 pb-0>
                    <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                </v-flex>
                <v-flex xs12 sm12 md4 pl-4>
                    <v-layout row wrap>
                        <v-flex xs12 sm12 md12>
                            <div class="">
                                <h3 class="headline text-uppercase font-weight-bold grey--text text--darken-4">{{ name }}</h3>

                            </div>
                        </v-flex>
                    </v-layout>
                    <v-layout align-center row wrap>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094" class="mr-1">far fa-calendar-alt</v-icon> {{ livraison }} </span>
                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                <v-icon small>call</v-icon>
                            </v-btn>
                        </template>
                        <span>Être rappelé</span>
                        <call
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :becallModal.sync="becallModal"
                            v-on:update:becallModal="becallModal = $event"
                        ></call>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                <v-icon small>email</v-icon>
                            </v-btn>
                        </template>
                        <span>Contactez nous</span>

                        <contact
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :contactModal.sync="contactModal"
                            v-on:update:contactModal="contactModal = $event"
                        ></contact>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                <v-icon small>my_location</v-icon>
                            </v-btn>
                        </template>
                        <span>Dénoncer un client</span>
                        <denonce
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :denonceModal.sync="denonceModal"
                            v-on:update:denonceModal="denonceModal = $event"
                        ></denonce>
                    </v-tooltip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                            :userdata="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :countLots="count"
                            :listingLots="lots"
                            :favoritedlots="favoriteslots"
                            :bookedlots="bookslots"
                            :page="page"
                            :showLots.sync="showLots"
                            v-on:update:showLots="showLots = $event"

                        ></programme-lots>
                    </div>
                </v-flex>
                <!--<v-flex xs12 sm12 md2 pl-4>
                    <div class="">
                        <h3 class="headline primary-color">{{ name }}</h3>
                        <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                    </div>
                </v-flex>
                <v-flex xs12 sm12 md1>
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-right">
                    <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                </v-flex>
                <v-flex offset-md1></v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                    <v-icon>call</v-icon>
                                </v-btn>
                            </template>
                            <span>Être rappelé</span>
                            <call
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :becallModal.sync="becallModal"
                                    v-on:update:becallModal="becallModal = $event"
                            ></call>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                    <v-icon>email</v-icon>
                                </v-btn>
                            </template>
                            <span>Contactez nous</span>

                            <contact
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :contactModal.sync="contactModal"
                                    v-on:update:contactModal="contactModal = $event"
                            ></contact>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                    <v-icon>my_location</v-icon>
                                </v-btn>
                            </template>
                            <span>Dénoncer un client</span>
                            <denonce
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :denonceModal.sync="denonceModal"
                                    v-on:update:denonceModal="denonceModal = $event"
                            ></denonce>
                        </v-tooltip>
                </v-flex>
                <v-divider vertical></v-divider>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                                :userdata="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :countLots="count"
                                :listingLots="lots"
                                :favoritedlots="favoriteslots"
                                :bookedlots="bookslots"
                                :alreadybookslotsbyotheruser="alreadybookslotsbyotheruser"
                                :showLots.sync="showLots"
                                v-on:update:showLots="showLots = $event"
                        ></programme-lots>
                    </div>
                </v-flex>-->
            </v-layout>
        </v-flex>
    </div>
    <div v-else-if="page === 'mysearch'">
        <v-flex xs12 sm12 md12>
            <v-layout align-center row wrap class="programme-card" @click.stop="showLots = !showLots">
                <v-flex xs12 sm12 md2 pa-0 pt-0 pb-0>
                    <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                </v-flex>
                <v-flex xs12 sm12 md4 pl-4>
                    <v-layout row wrap>
                        <v-flex xs12 sm12 md12>
                            <div class="">
                                <h3 class="headline text-uppercase font-weight-bold grey--text text--darken-4">{{ name }}</h3>

                            </div>
                        </v-flex>
                    </v-layout>
                    <v-layout align-center row wrap>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094" class="mr-1">far fa-calendar-alt</v-icon> {{ livraison }} </span>
                        </v-flex>
                        <v-flex xs12 sm12 md4 class="text-md-left">
                            <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                <v-icon small>call</v-icon>
                            </v-btn>
                        </template>
                        <span>Être rappelé</span>
                        <call
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :becallModal.sync="becallModal"
                            v-on:update:becallModal="becallModal = $event"
                        ></call>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                <v-icon small>email</v-icon>
                            </v-btn>
                        </template>
                        <span>Contactez nous</span>

                        <contact
                            :user="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :contactModal.sync="contactModal"
                            v-on:update:contactModal="contactModal = $event"
                        ></contact>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                <v-icon small>my_location</v-icon>
                            </v-btn>
                        </template>
                        <span>Dénoncer un client</span>
                        <denonce
                            :idProgramme="id"
                            :nameProgramme="name"
                            :idLot="null"
                            :numberLot="null"
                            :denonceModal.sync="denonceModal"
                            v-on:update:denonceModal="denonceModal = $event"
                        ></denonce>
                    </v-tooltip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                            :userdata="user"
                            :idProgramme="id"
                            :nameProgramme="name"
                            :countLots="count"
                            :listingLots="lots"
                            :favoritedlots="favoriteslots"
                            :bookedlots="bookslots"
                            :page="page"
                            :showLots.sync="showLots"
                            v-on:update:showLots="showLots = $event"

                        ></programme-lots>
                    </div>
                </v-flex>
                <!--<v-flex xs12 sm12 md2 pl-4>
                    <div class="">
                        <h3 class="headline primary-color">{{ name }}</h3>
                        <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                    </div>
                </v-flex>
                <v-flex xs12 sm12 md1>
                    <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                        {{ dispositifs }}
                    </v-chip>
                </v-flex>
                <v-flex xs12 sm12 md2 class="text-md-right">
                    <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                </v-flex>
                <v-flex offset-md1></v-flex>
                <v-flex xs12 sm12 md2 class="text-md-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                    <v-icon>call</v-icon>
                                </v-btn>
                            </template>
                            <span>Être rappelé</span>
                            <call
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :becallModal.sync="becallModal"
                                    v-on:update:becallModal="becallModal = $event"
                            ></call>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                    <v-icon>email</v-icon>
                                </v-btn>
                            </template>
                            <span>Contactez nous</span>

                            <contact
                                    :user="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :contactModal.sync="contactModal"
                                    v-on:update:contactModal="contactModal = $event"
                            ></contact>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                    <v-icon>my_location</v-icon>
                                </v-btn>
                            </template>
                            <span>Dénoncer un client</span>
                            <denonce
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :idLot="null"
                                    :numberLot="null"
                                    :denonceModal.sync="denonceModal"
                                    v-on:update:denonceModal="denonceModal = $event"
                            ></denonce>
                        </v-tooltip>
                </v-flex>
                <v-divider vertical></v-divider>
                <v-flex xs12 sm12 md2 class="text-md-center">

                    <div>
                        count lots {{ count }}<br>
                        count favorites lots {{ countfavorites }}<br>
                        count booked lots {{ countbooked }}<br>
                        count lots disponibles {{ countfinal }}<br>
                        <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                        <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                        <programme-lots
                                :userdata="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :countLots="count"
                                :listingLots="lots"
                                :favoritedlots="favoriteslots"
                                :bookedlots="bookslots"
                                :alreadybookslotsbyotheruser="alreadybookslotsbyotheruser"
                                :showLots.sync="showLots"
                                v-on:update:showLots="showLots = $event"
                        ></programme-lots>
                    </div>
                </v-flex>-->
            </v-layout>
        </v-flex>
    </div>
    <div v-else>
        <v-flex xs12 sm12 md12>
                <v-layout align-center row wrap class="programme-card" @click.stop="showLots = !showLots">
                    <v-flex xs12 sm12 md2 pa-0 pt-0 pb-0>
                        <v-img :src="getImages(thumbnail)" aspect-ratio="1.7"></v-img>
                    </v-flex>
                    <v-flex xs12 sm12 md4 pl-4>
                        <v-layout row wrap>
                            <v-flex xs12 sm12 md12>
                                <div class="">
                                    <h3 class="headline text-uppercase font-weight-bold grey--text text--darken-4">{{ name }}</h3>

                                </div>
                            </v-flex>
                        </v-layout>
                        <v-layout align-center row wrap>
                            <v-flex xs12 sm12 md4 class="text-md-left">
                                <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                            </v-flex>
                            <v-flex xs12 sm12 md4 class="text-md-left">
                                <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094" class="mr-1">far fa-calendar-alt</v-icon> {{ livraison }} </span>
                            </v-flex>
                            <v-flex xs12 sm12 md4 class="text-md-left">
                                <span class="programme-list-icon grey--text text--darken-3 body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 sm12 md2 class="text-md-center">
                        <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                            {{ dispositifs }}
                        </v-chip>
                    </v-flex>
                    <v-flex xs12 sm12 md2 class="text-md-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn dark small outline icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                    <v-icon small>call</v-icon>
                                </v-btn>
                            </template>
                            <span>Être rappelé</span>
                            <call
                                :user="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :idLot="null"
                                :numberLot="null"
                                :becallModal.sync="becallModal"
                                v-on:update:becallModal="becallModal = $event"
                            ></call>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                    <v-icon small>email</v-icon>
                                </v-btn>
                            </template>
                            <span>Contactez nous</span>

                            <contact
                                :user="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :idLot="null"
                                :numberLot="null"
                                :contactModal.sync="contactModal"
                                v-on:update:contactModal="contactModal = $event"
                            ></contact>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn dark small outline icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                    <v-icon small>my_location</v-icon>
                                </v-btn>
                            </template>
                            <span>Dénoncer un client</span>
                            <denonce
                                :idProgramme="id"
                                :nameProgramme="name"
                                :idLot="null"
                                :numberLot="null"
                                :denonceModal.sync="denonceModal"
                                v-on:update:denonceModal="denonceModal = $event"
                            ></denonce>
                        </v-tooltip>
                    </v-flex>
                    <v-flex xs12 sm12 md2 class="text-md-center">

                        <div>
                            count lots {{ count }}<br>
                            count favorites lots {{ countfavorites }}<br>
                            count booked lots {{ countbooked }}<br>
                            count lots disponibles {{ countfinal }}<br>
                            <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                            <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                            <programme-lots
                                :userdata="user"
                                :idProgramme="id"
                                :nameProgramme="name"
                                :countLots="count"
                                :listingLots="lots"
                                :favoritedlots="favoriteslots"
                                :bookedlots="bookslots"
                                :alreadybookslotsbyotheruser="alreadybookslotsbyotheruser"
                                :status="state"
                                :showLots.sync="showLots"
                                v-on:update:showLots="showLots = $event"
                            ></programme-lots>
                        </div>
                    </v-flex>
                    <!--<v-flex xs12 sm12 md2 pl-4>
                        <div class="">
                            <h3 class="headline primary-color">{{ name }}</h3>
                            <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">location_on</v-icon> {{ city }}</span>

                        </div>
                    </v-flex>
                    <v-flex xs12 sm12 md1>
                        <v-chip class="btn-box-shadow-secondary font-weight-bold text-uppercase" outline color="#2196F3" text-color="#2196F3">
                            {{ dispositifs }}
                        </v-chip>
                    </v-flex>
                    <v-flex xs12 sm12 md2 class="text-md-right">
                        <span class="programme-list-icon grey-color body-2 font-weight-bold"><v-icon color="#00e094">euro</v-icon> Dès {{ minimum }} </span>
                    </v-flex>
                    <v-flex offset-md1></v-flex>
                    <v-flex xs12 sm12 md2 class="text-md-center">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d"  v-on="on" @click.stop="becallModal = !becallModal">
                                        <v-icon>call</v-icon>
                                    </v-btn>
                                </template>
                                <span>Être rappelé</span>
                                <call
                                        :user="user"
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :becallModal.sync="becallModal"
                                        v-on:update:becallModal="becallModal = $event"
                                ></call>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="contactModal = !contactModal">
                                        <v-icon>email</v-icon>
                                    </v-btn>
                                </template>
                                <span>Contactez nous</span>

                                <contact
                                        :user="user"
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :contactModal.sync="contactModal"
                                        v-on:update:contactModal="contactModal = $event"
                                ></contact>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn fab dark small  icon color="#5d5d5d" v-on="on" @click.stop="denonceModal = !denonceModal">
                                        <v-icon>my_location</v-icon>
                                    </v-btn>
                                </template>
                                <span>Dénoncer un client</span>
                                <denonce
                                        :idProgramme="id"
                                        :nameProgramme="name"
                                        :idLot="null"
                                        :numberLot="null"
                                        :denonceModal.sync="denonceModal"
                                        v-on:update:denonceModal="denonceModal = $event"
                                ></denonce>
                            </v-tooltip>
                    </v-flex>
                    <v-divider vertical></v-divider>
                    <v-flex xs12 sm12 md2 class="text-md-center">

                        <div>
                            count lots {{ count }}<br>
                            count favorites lots {{ countfavorites }}<br>
                            count booked lots {{ countbooked }}<br>
                            count lots disponibles {{ countfinal }}<br>
                            <v-btn v-if="favoritePage" round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" depressed dark @click.stop="showLots = !showLots">{{ countfavorites }} lots <v-icon>expand_more</v-icon></v-btn>
                            <v-btn v-else round  color="#00e094" class="btn-box-shadow-primary font-weight-bold" dark depressed @click.stop="showLots = !showLots">{{ countfinal }} lots <v-icon>expand_more</v-icon></v-btn>
                            <programme-lots
                                    :userdata="user"
                                    :idProgramme="id"
                                    :nameProgramme="name"
                                    :countLots="count"
                                    :listingLots="lots"
                                    :favoritedlots="favoriteslots"
                                    :bookedlots="bookslots"
                                    :alreadybookslotsbyotheruser="alreadybookslotsbyotheruser"
                                    :showLots.sync="showLots"
                                    v-on:update:showLots="showLots = $event"
                            ></programme-lots>
                        </div>
                    </v-flex>-->
                </v-layout>
            </v-flex>
    </div>
</template>

<script>

    import ProgrammeLots from './ProgrammeLots';
    import Call from '../actions/Call';
    import Contact from '../actions/Contact';
    import Denonce from '../actions/Denonce';
    import Favorites from '../Favorites';


    export default {
        name: "Programme",
        components: {
            ProgrammeLots,
            Call,
            Contact,
            Denonce,
            Favorites,
        },
        props: ['id', 'thumbnail', 'images', 'name', 'city', 'zipcode', 'dispositifs', 'livraison', 'count', 'countfavorites', 'countbooked', 'countfinal', 'lots', 'minimum', 'favorites', 'favoriteslots', 'page', 'books', 'bookslots', 'alreadybookslotsbyotheruser', 'bookspage', 'user', 'state'],
        data: function() {
            return {
                showLots: false,
                becallModal: false,
                contactModal: false,
                denonceModal: false,
                isFavorites: '',
                direction: 'right',
                fab: false,
                fling: false,
                hover: false,
                tabs: null,
                top: false,
                right: true,
                bottom: true,
                left: false,
                transition: 'slide-y-reverse-transition',
                favoritePage: this.favoritespage,
                results: [],
                userdata: '',

            }
        },
        computed: {
            countLots() {

            },
            activeFab () {
                switch (this.tabs) {
                    case 'one': return { 'class': 'green', icon: 'call' }
                    case 'two': return { 'class': 'blue', icon: 'email' }
                    case 'three': return { 'class': 'red', icon: 'location_searching' }
                    default: return {}
                }
            }
        },
        watch: {
            top (val) {
                this.bottom = !val
            },
            right (val) {
                this.left = !val
            },
            bottom (val) {
                this.top = !val
            },
            left (val) {
                this.right = !val
            }
        },
        methods: {
            getImages(image) {
                if (image != null) {
                    return "/storage/" + image;
                }

            },
            outside: function(e) {
                this.$emit('update:contactModal', false);
            },
        },
        directives: {
            'click-outside': {
                bind: function(el, binding, vNode) {
                    // Provided expression must evaluate to a function.
                    if (typeof binding.value !== 'function') {
                        const compName = vNode.context.name;
                        let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`;
                        if (compName) { warn += `Found in component '${compName}'` }

                        console.warn(warn);
                    }
                    // Define Handler and cache it on the element
                    const bubble = binding.modifiers.bubble;
                    const handler = (e) => {
                        if (bubble || (!el.contains(e.target) && el !== e.target)) {
                            binding.value(e);
                        }
                    }
                    el.__vueClickOutside__ = handler;

                    // add Event Listeners
                    document.addEventListener('click', handler);
                },

                unbind: function(el, binding) {
                    // Remove Event Listeners
                    document.removeEventListener('click', el.__vueClickOutside__);
                    el.__vueClickOutside__ = null;

                }
            }
        }
    }
</script>

<style scoped>
    .v-carousel, .v-card {
        box-shadow: none;
    }

    .container.programmes-list {
        padding: 1px 0;
    }

    .container.grid-list-md.programmes-list .layout:only-child {
        margin: 0px;
    }

    .programme-card {
        background: #fff;
    }

    .programme-card .headline {
        font-size: 18px!important;
        line-height: 32px!important;
    }

    /* This is for documentation purposes and will not be needed in your application */
    #create .v-speed-dial {
        position: absolute;
    }

    #create .v-btn--floating {
        position: relative;
    }

    .programmes-list:hover h3.headline {
        color: #00e094;
    }

    .programme-list-icon {
        font-family: 'Montserrat';
    }

</style>
