@extends('layouts.app')
@section('content')
    <v-container  grid-list-md>
        <v-layout row wrap>
            @if(Auth::check())
                <v-flex xs12 sm8 md8 :class="{'blur-content': showModal}">
                    <v-btn color="grey" dark href="javascript:history.go(-1)">Retour à la liste</v-btn>
                    @if(json_decode($programme->plaquette))
                        @foreach(json_decode($programme->plaquette) as $file)
                            <v-btn color="blue" dark href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}" target="_blank">Télécharger la plaquette</v-btn>
                        @endforeach
                    @else
                        <v-btn color="grey" dark >Aucune plaquette disponible</v-btn>
                    @endif
                    <v-btn color="orange" dark @click="dialog = true">Dénoncer un prospect</v-btn>
                    <h1>{{ $programme->name }}</h1>

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

                    <v-container fluid class="pa-1">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="bien" class="headline mb-0">Description du bien</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>

                    <v-container fluid class="pa-1 my-3">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="agence" class="headline mb-0">L'agence</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-container fluid class="pa-1">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="quartier" class="headline mb-0">Le quartier</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>

                    <v-container fluid class="pa-1 my-3">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 id="projet" class="headline mb-0">Votre projet</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-container fluid class="pa-1">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 class="headline mb-0">Description du bien</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>

                    <v-container fluid class="pa-1 my-3">
                        <v-layout row wrap>
                            <v-flex xs12 class="pa-3 white">
                                <v-card light color="white">
                                    <v-card-title primary-title class="pl-0">
                                        <h3 class="headline mb-0">L'agence</h3>
                                    </v-card-title>
                                    <v-card-text class="px-0"><p>{{ $programme->description }}</p></v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
                <v-flex xs12 sm4 md4 >
                    <h2>Lots disponibles</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Type</th>
                            <th>Parking</th>
                            <th>Etage</th>
                            <th>Surface</th>
                            <th>Exposition</th>
                        </tr>
                        </thead>
                        @foreach($lots as $lot)
                            @if ($lot->programme_id == $programme->id)
                                <tr>
                                    <td><span>{{ $lot->numero }}</span></td>
                                    <td><span>{{ $lot->type }}</span></td>
                                    <td><span>{{ $lot->parking }}</span></td>
                                    <td><span>{{ $lot->etage }}</span></td>
                                    <td><span>{{ $lot->surface }}</span></td>
                                    <td><span>{{ $lot->exposition }}</span></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </v-flex>
            @else
                <v-flex xs12 sm6 offset-sm3>
                    <v-card>
                        <v-card-title primary-title>
                            <div>
                                <h3 class="headline mb-0">Contenu restraint</h3>
                                <div><p>Vous devez être connecté pour accèder au programme</p></div>
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

