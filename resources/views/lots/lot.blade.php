@extends('layouts.app')

@section('content')
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 sm6 md6 >
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
                <h1>{{ $programme->name }}</h1>
                <h2>Lot <span>{{ $lot->id }}</span></h2>
                <table>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Parking</th>
                        <th>Etage</th>
                        <th>Surface</th>
                        <th>Exposition</th>
                    </tr>
                    </thead>


                </table>

            </v-flex>
        </v-layout>
    </v-container>
@endsection
