@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout align-center justify-center row wrap>
            <h1>Ajout d'une annonce de location</h1>
            <v-flex md12>
                @guest
                    <add-location-form :user="false" :propertiestype="{{ $propertiesType }}"></add-location-form>
                @else
                    <add-location-form :user="{{ Auth()->user() }}" :propertiestype="{{ $propertiesType }}"></add-location-form>
                @endguest
            </v-flex>
        </v-layout>
    </v-container>
@endsection
