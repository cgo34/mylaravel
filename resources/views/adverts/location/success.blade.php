@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout align-center justify-center row wrap>
            <h1>Votre annonce de location a été ajouté avec succès</h1>
            <v-flex md12>
                <p>Merci pour votre annonce de location</p>
                {{ $property }}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
