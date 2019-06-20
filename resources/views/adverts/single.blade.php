@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-flex row wrap>
            @if(Auth::check())
                <single-location
                    :location="{{ $location }}"
                    :user="{{ Auth()->user() }}"
                ></single-location>
            @else
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
        </v-flex>
    </v-container>
@endsection
