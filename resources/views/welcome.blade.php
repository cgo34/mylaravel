@extends('layouts.app')

@section('content')
    @php ($countProgrammes = 0)
    @php ($countLots = 0)
    @foreach($programmes as $programme)
        @php ($countProgrammes++)
    @endforeach
    @foreach($lots as $lot)
        @php ($countLots++)
    @endforeach
    <v-content>
        <section>
            <v-parallax src="{{ asset('img/galileo-home-banner.jpg') }}" height="800">
                <v-layout
                        column
                        align-center
                        justify-center
                        class="white--text"
                >
                    <v-flex xs10 offset-xs1 py-4 fill-height>
                        <h1 class="white--text mt-2 mb-2 display-1 text-xs-center">Galileo</h1>
                        <h2 class="mb-3 text-xs-center">Le moteur de recherche pour les professionnels de l'immobilier</h2>
                        <search></search>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <p class="stats"><strong class="selection-color">{{ $countProgrammes }}</strong> programmes et <strong class="selection-color">{{ $countLots }}</strong> lots disponibles</p>
                                </div>
                            </div>
                        </div>
                    </v-flex>
                </v-layout>
            </v-parallax>
        </section>
    </v-content>
@endsection
