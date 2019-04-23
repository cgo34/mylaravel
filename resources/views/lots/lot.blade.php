@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-flex row wrap>
            @if(Auth::check())
                <v-toolbar id="lot-toolbar" dark fixed inverted-scroll :scroll-target="scrolling-techniques"  flat  color="#65D6B5" class="mt-5 text-md-center">
                    <v-toolbar-items>
                            <v-btn href="#bien" flat>Le programme</v-btn>
                            <v-btn href="#lot" flat>Le lot</v-btn>
                            <v-btn href="#photo" flat>Photo</v-btn>
                            <v-btn href="#agence" flat>L'agence</v-btn>
                            <v-btn href="#quartier" flat>Le quartier</v-btn>
                            <v-btn href="#projet" flat>Votre projet</v-btn>
                        <v-divider class="mt-2 mb-2" vertical></v-divider>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on">
                                    <v-icon color="#fff">save_alt</v-icon>
                                </v-btn>
                            </template>
                            <span>Télécharger la fiche du lot</span>
                        </v-tooltip>
                    </v-toolbar-items>
                </v-toolbar>
                <v-container  grid-list-md >
                    <v-layout align-center>
                        <v-flex xs12 sm12 text-md-center>

                            <v-layout align-center >
                                <v-flex xs12 sm3 md3>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn icon v-on="on">
                                                <v-icon color="#65D6B5">save_alt</v-icon>
                                            </v-btn>
                                            <span>Télécharger la fiche du lot</span>
                                        </template>
                                        <span>Télécharger la fiche du lot</span>
                                    </v-tooltip>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn icon v-on="on">
                                                <v-icon color="#65D6B5">my_location</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Dénoncer un client</span>
                                    </v-tooltip>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn icon v-on="on">
                                                <v-icon color="#65D6B5">email</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Envoyer la fiche par email</span>
                                    </v-tooltip>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn icon v-on="on">
                                                <v-icon color="#65D6B5">share</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Partager la fiche lot</span>
                                    </v-tooltip>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-container>

                <v-container>

                    <v-flex ref="scroll" id="scrolling-techniques" class="scroll-y">
                        <v-layout>
                            <v-flex xs12 sm12 md12>
                                <v-card light color="white" class="pa-3">
                                    <v-layout>
                                        <v-flex xs4 sm4 md4>
                                            <v-card-title>
                                                <h3 class="title display-3 font-weight-bold text-uppercase grey--text text--darken-1 ">{{ $programme->name }}</h3>
                                            </v-card-title>
                                            <v-card-text>
                                                <v-chip color="#65D6B5" text-color="white" class="pr-3 pl-3">
                                                    @foreach($programme->dispositifs as $dispositif)
                                                        @php ($dispositifs = $dispositif->name)
                                                    @endforeach
                                                    <v-avatar>
                                                        <v-icon>account_balance</v-icon>
                                                    </v-avatar>
                                                    <b>{{ $dispositifs }}</b>
                                                </v-chip>
                                                <h4>Exclusivité Galileo</h4>
                                                <h4><v-icon>location_on</v-icon> {{ $programme->city }} {{ $programme->zipcode }}</h4>
                                                <v-card dark color="#5d5d5d" depressed class="pa-3">
                                                    <h4><b>{{ $lot->prix }}</b> <v-icon>euro_symbol</v-icon></h4>
                                                </v-card>
                                            </v-card-text>

                                        </v-flex>
                                        <v-flex xs8 sm8 md8>

                                            <v-img src="{{ Storage::disk(config('voyager.storage.disk'))->url($programme->thumbnail) ?: '' }}" aspect-ratio="1.7"></v-img>

                                        </v-flex>
                                    </v-layout>
                                </v-card>
                            </v-flex>
                        </v-layout>



                        <v-spacer class="mb-5"></v-spacer>

                        <h3 id="bien" class="lot-section headline mb-1 text-md-center text-uppercase grey--text text--darken-1"><v-icon color="#65D6B5">fas fa-city</v-icon> Le programme</h3>
                        <v-spacer class="mb-1"></v-spacer>
                        <div xs12 sm12 md12 class="mb-3">
                            <v-card light color="white" class="pa-3">
                                <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                            </v-card>
                        </div>
                        <v-spacer class="mb-5"></v-spacer>
                        <h3 id="lot" class="lot-section headline mb-1 text-md-center text-uppercase grey--text text--darken-1"><v-icon color="#65D6B5">fas fa-building</v-icon> Le lot {{ $lot->numero }}</h3>
                        <v-spacer class="mb-1"></v-spacer>
                        <v-layout>
                            <v-flex xs12 sm2 md2 offset-md1>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">account_balance</v-icon>
                                    <v-card-text class="px-0">
                                        <span class="primary-color font-weight-bold text-uppercase">Dispositif</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        @foreach($programme->dispositifs as $dispositif)
                                                {{ $dispositif->name }}
                                            @endforeach
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">business</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Type</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->type }}
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">swap_vert</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Etage</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->etage }}
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">explore</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Exposition</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->exposition }}
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">fullscreen</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Surface</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->surface }}m2
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-layout>
                            <v-flex xs12 sm2 md2 offset-md1>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">account_balance_wallet</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Prix/m2</span>
                                        <br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->prix_metres }} €
                                    </span></v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">trending_up</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Rentabilité</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->rentabilite }} %
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">euro_symbol</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Loyer</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->loyer }} €
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">calendar_today</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Livraison</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->livraison }}
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm2 md2>
                                <v-card light color="white" class="text-center  pt-3">
                                    <v-icon color="#65D6B5">schedule</v-icon>
                                    <v-card-text class="px-0"><span class="primary-color font-weight-bold text-uppercase">Actabilité</span><br>
                                        <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->actabilite }}
                                    </span>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-spacer class="mb-5"></v-spacer>
                        <h3 id="photo" class="lot-section headline mb-1 text-md-center text-uppercase grey--text text--darken-1"><v-icon color="#65D6B5">fas fa-images</v-icon> Photos</h3>
                        <v-flex xs12 sm12 md12>
                            <v-card light color="white" class="text-center  pa-3">
                                <v-carousel >
                                    @if(json_decode($programme->images))
                                        @foreach(json_decode($programme->images) as $file)
                                            <v-carousel-item
                                                    src="{{ Storage::disk(config('voyager.storage.disk'))->url($file) ?: '' }}"
                                            ></v-carousel-item>
                                        @endforeach
                                    @else
                                        <div><p>Aucune image</p></div>
                                    @endif
                                </v-carousel>
                            </v-card>
                        </v-flex>
                        <v-spacer class="mb-5"></v-spacer>
                        <h3 id="agence" class="lot-section headline  mb-1 text-md-center text-uppercase grey--text text--darken-1"><v-icon color="#65D6B5">fas fa-store-alt</v-icon> L'agence</h3>
                        <v-spacer class="mb-1"></v-spacer>
                        <div xs12 sm12 md12 class="mb-3">
                            <v-card light color="white" class="pa-3">
                                <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                            </v-card>
                        </div>
                        <v-spacer class="mb-5"></v-spacer>
                        <h3 id="quartier" class="lot-section headline mb-1 text-md-center text-uppercase grey--text text--darken-1"><v-icon color="#65D6B5">fas fa-map-signs</v-icon> Le quartier</h3>
                        <v-spacer class="mb-1"></v-spacer>
                        <div xs12 sm12 md12 class="mb-3">
                            <v-card light color="white" class="pa-3">
                                <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                            </v-card>
                        </div>
                    </v-container>

                    <v-flex xs12 sm6 offset-sm3>
                        <v-card>
                            <v-card-title primary-title>
                                <div>
                                    <h3 class="headline mb-0">Contenu restraint</h3>
                                    <div><p>Vous devez être connecté pour accèder a la fiche du lot</p></div>
                                </div>
                            </v-card-title>

                            <v-card-actions>
                                <login></login>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-flex>
            @else
                <v-container fluid grid-list-md fill-height>
                    <v-layout align-center>
                        <v-flex xs12 sm10 md10 text-md-center>
                            <v-layout align-center >
                                <v-flex xs12 sm3 md3>
                                    <v-card light color="white" class="text-center  pt-3">
                                        <a href=""><v-icon color="pink lighten-1">save_alt</v-icon> Télécharger la fiche du lot</a>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-card light color="white" class="text-center  pt-3">
                                        <a href=""><v-icon color="pink lighten-1">location_searching</v-icon> Dénoncer un client</a>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-card light color="white" class="text-center  pt-3">
                                        <a href=""><v-icon color="pink lighten-1">email</v-icon> Envoyer la fiche par email</a>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 sm3 md3>
                                    <v-card light color="white" class="text-center  pt-3">
                                        <a href=""><v-icon color="pink lighten-1">share</v-icon> Partager la fiche lot</a>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-flex xs12 sm6 md6>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <h3 class="title font-weight-bold text-uppercase grey--text text--darken-1 "><v-icon>business</v-icon> Le programme {{ $programme->name }}</h3>
                        </v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <v-carousel hide-delimiters>
                                @if(json_decode($programme->images))
                                    @foreach(json_decode($programme->images) as $file)
                                        <v-carousel-item
                                                src="{{ Storage::disk(config('voyager.storage.disk'))->url($file) ?: '' }}"
                                        ></v-carousel-item>
                                    @endforeach
                                @else
                                    <div><p>Aucune image</p></div>
                                @endif
                            </v-carousel>

                            <v-toolbar light :scroll-off-screen="true" :scroll-target="'#scrolling-techniques'" prominent color="white" class="my-3">
                                <v-toolbar-items>
                                    <v-btn href="#bien" flat>Le bien</v-btn>
                                    <v-btn href="#agence" flat>L'agence</v-btn>
                                    <v-btn href="#quartier" flat>Le quartier</v-btn>
                                    <v-btn href="#projet" flat>Votre projet</v-btn>
                                </v-toolbar-items>
                            </v-toolbar>


                            <div xs12 sm12 md12 class="mb-3">
                                <v-card light color="white" class="pa-3">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="bien" class="headline mb-0">Le bien</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </div>

                            <div xs12 sm12 md12 class="mb-3">
                                <v-card light color="white" class="pa-3">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="agence" class="headline mb-0">L'agence</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </div>

                            <div xs12 sm12 md12 class="mb-3">
                                <v-card light color="white" class="pa-3">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="quartier" class="headline mb-0">Le quartier</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </div>

                            <div xs12 sm12 md12 class="mb-3">
                                <v-card light color="white" class="pa-3">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="projet" class="headline mb-0">Votre projet</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </div>

                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm6 md6>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <h3 class="title font-weight-bold text-uppercase grey--text text--darken-1 "><v-icon>business</v-icon> Le lot {{ $lot->numero }}</h3>
                        </v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex xs12 sm2 md2 offset-sm1 offset-md1>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">account_balance</v-icon>
                                <v-card-text class="px-0">
                                    <span class="light-blue--text font-weight-bold text-uppercase">Dispositif</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        @foreach($programme->dispositifs as $dispositif)
                                            {{ $dispositif->name }}
                                        @endforeach
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">business</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Type</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->type }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">swap_vert</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Etage</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->etage }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">explore</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Exposition</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->exposition }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">fullscreen</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Surface</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->surface }}m2
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout class="mb-3">
                        <v-flex xs12 sm2 md2 offset-sm1 offset-md1>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">account_balance_wallet</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Prix/m2</span>
                                    <br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->prix_metres }} €
                                    </span></v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">trending_up</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Rentabilité</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->rentabilite }} %
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">euro_symbol</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Loyer</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->loyer }} €
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">calendar_today</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Livraison</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->livraison }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon color="light-blue">schedule</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Actabilité</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->actabilite }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-spacer></v-spacer>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <h3 class="title font-weight-bold text-uppercase grey--text text--darken-1 "><v-icon>border_clear</v-icon> Le plan</h3>
                        </v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex xs12 sm10 md10 offset-sm1 offset-md1>
                            <v-img src="/storage/{{ $lot->plan }}" aspect-ratio="1.7"></v-img>
                        </v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <h3 class="title font-weight-bold text-uppercase grey--text text--darken-1 "><v-icon>business</v-icon> Fiche technique</h3>
                        </v-flex>
                    </v-layout>
                    <v-layout class="mb-3">
                        <v-flex xs12 sm2 md2 offset-sm1 offset-md1>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon  color="pink lighten-1">account_balance</v-icon>
                                <v-card-text class="px-0">
                                    <span class="pink--text text--lighten-1 font-weight-bold text-uppercase">Dispositif</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        @foreach($programme->dispositifs as $dispositif)
                                            {{ $dispositif->name }}
                                        @endforeach
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>business</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Type</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->type }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>swap_vert</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Etage</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->etage }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>explore</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Exposition</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->exposition }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>fullscreen</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Surface</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->surface }}m2
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex xs12 sm11 md11 offset-sm1 offset-md1>
                            <h3 class="title font-weight-bold text-uppercase grey--text text--darken-1 "><v-icon>business</v-icon> Documents</h3>
                        </v-flex>
                    </v-layout>
                    <v-layout class="mb-3">
                        <v-flex xs12 sm2 md2 offset-sm1 offset-md1>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>account_balance_wallet</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Prix/m2</span>
                                    <br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->prix_metres }} €
                                    </span></v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>trending_up</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Rentabilité</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->rentabilite }} %
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>euro_symbol</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Loyer</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->loyer }} €
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>calendar_today</v-icon>
                                <v-card-text class="px-0"><span class="light-blue--text font-weight-bold text-uppercase">Livraison</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->livraison }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm2 md2>
                            <v-card light color="white" class="text-center  pt-3">
                                <v-icon>schedule</v-icon>
                                <v-card-text class="px-0"><span class="primary font-weight-bold text-uppercase">Actabilité</span><br>
                                    <span class="grey--text font-weight-bold text-uppercase">
                                        {{ $lot->actabilite }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm6 offset-sm3>
                    <v-card>
                        <v-card-title primary-title>
                            <div>
                                <h3 class="headline mb-0">Contenu restraint</h3>
                                <div><p>Vous devez être connecté pour accèder a la fiche du lot</p></div>
                            </div>
                        </v-card-title>

                        <v-card-actions>
                            <login></login>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            @endif
        </v-layout>
    </v-container>
@endsection
