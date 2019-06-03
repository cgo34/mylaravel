@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout row wrap>
            <v-flex md12>
                <single-page :paged="'{{ addslashes($page) }}'"></single-page>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
