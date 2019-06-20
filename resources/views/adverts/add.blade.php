@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout justify-center>
            <v-flex md12 class="text-md-center pt-3 pb-3">
                <h1>Déposé votre annonce sur Galileo</h1>
            </v-flex>
        </v-layout>
        <v-layout align-center justify-center row wrap>
            <v-flex md4>
                <v-card class="pb-4">
                    <v-card-title class="justify-center pb-0">
                        <h2 class="primary-color text-md-center headline font-weight-black mt-3"><img src="{{ asset('img/icons/auction.png') }}" width="36px"/><br>Vendre</h2>
                    </v-card-title>
                    <v-card-title class="justify-center pt-0">
                        <h3 class="title">Service payant</h3>
                    </v-card-title>
                    <v-list class="advert-features">
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#00e094">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Estimation gratuite de votre bien</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >

                            <v-list-tile-action class="justify-center">
                                <v-icon color="#00e094">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Accompagnement par un professionnel</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#00e094">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Sans engagement</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                    </v-list>
                    <v-card-actions class="justify-center">
                        <v-btn id="addAdvert" class="subheading text-none" round large color="#00e094" dark @click="goToAddAdvertPage()">Mettre mon bien en vente</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex md4>
                <v-card class="pb-4">
                    <v-card-title class="justify-center pb-0">
                        <h2 class="tertiary-color text-md-center headline font-weight-black mt-3"><img src="{{ asset('img/icons/key.png') }}" width="36px"/><br>Louer</h2>
                    </v-card-title>
                    <v-card-title class="justify-center pt-0">
                        <h3 class="title">Service gratuit</h3>
                    </v-card-title>
                    <v-list class="advert-features">
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#D81B60">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Votre annonce diffusée pendant 30 jours renouvelables sur le site Galileo</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >

                            <v-list-tile-action class="justify-center">
                                <v-icon color="#D81B60">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Service de particulier à particulier</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#D81B60">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Nombre de photos illimité</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                    </v-list>
                    <v-card-actions class="justify-center">
                        <v-btn href="/annonces/add/location" id="addAdvert" class="subheading text-none" round large color="#D81B60" dark @click="goToAddAdvertPage()">Mettre mon bien en location</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex md4>
                <v-card class="pb-4">
                    <v-card-title class="justify-center pb-0">
                        <h2 class="secondary-color text-md-center headline font-weight-black mt-3"><img src="{{ asset('img/icons/search.png') }}" width="36px"/><br>Acheter</h2>
                    </v-card-title>
                    <v-card-title class="justify-center pt-0">
                        <h3 class="title">Service gratuit</h3>
                    </v-card-title>
                    <v-list class="advert-features">
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#2196F3">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Votre annonce diffusée pendant 30 jours renouvelables sur le site Galileo</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >

                            <v-list-tile-action class="justify-center">
                                <v-icon color="#2196F3">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Mise en relation avec des vendeurs potentiels</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                        <v-list-tile
                        >
                            <v-list-tile-action class="justify-center">
                                <v-icon color="#2196F3">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Sans engagement</v-list-tile-sub-title>
                            </v-list-tile-content>

                        </v-list-tile>
                    </v-list>
                    <v-card-actions class="justify-center">
                        <v-btn id="addAdvert" class="subheading text-none" round large color="#2196F3" dark @click="goToAddAdvertPage()">Mettre ma recherche en ligne</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
