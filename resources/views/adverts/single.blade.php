@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-flex row wrap>
            <single-location
                :location="{{ $location }}"
                :user="{{ Auth()->user() }}"
            ></single-location>
        </v-flex>
    </v-container>
@endsection
