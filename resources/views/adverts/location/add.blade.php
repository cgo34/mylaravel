@extends('layouts.app')

@section('content')
    <v-container  grid-list-md>
        <v-layout align-center justify-center row wrap>
            <v-flex md12>
                @guest
                    <add-advert-form :user="false" user_type="particular" type="Location" :propertiestype="{{ $propertiesType }}"></add-advert-form>
                @else
                    <add-advert-form :user="{{ Auth()->user() }}" type="Location" :propertiestype="{{ $propertiesType }}"></add-advert-form>
                @endguest
            </v-flex>
        </v-layout>
    </v-container>
@endsection
