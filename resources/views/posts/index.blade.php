@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout row wrap>
            <v-flex md12>
                <single-post :post="'{{ addslashes($post) }}'"></single-post>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
