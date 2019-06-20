@extends('layouts.app')
@section('content')
    <v-container fluid>
        <v-layout wrap>
            <v-flex xs12 md12 text-md-center>
                <div id="filters">
                    <form action="{{ route('search') }}" method="POST">
                        @csrf
                        @method('POST')
                        <v-layout row wrap align-center>
                            <v-flex xs12 md3 offset-md1  pl-3>
                                <v-text-field
                                    color="#00e094"
                                    solo
                                    label="Location"
                                    prepend-inner-icon="place"
                                    id="city"
                                    name="city"
                                    value="{{request('city')}}"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md3  pl-3>
                                <dispositif-filter></dispositif-filter>
                            </v-flex>
                            <v-flex xs12 md3 pl-3>
                                <v-text-field
                                    color="#00e094"
                                    solo
                                    label="Budget"
                                    prepend-inner-icon="euro_symbol"
                                    id="price"
                                    name="price"
                                    value="{{ request('price') }}"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md2 text-md-left>
                                {{--<v-btn color="#42DCA3" type="submit" fab dark small  icon round depressed dark><v-icon>search</v-icon></v-btn>--}}
                                <v-btn class="btn-box-shadow-primary" type="submit" icon color="#00e094" depressed dark ><v-icon>search</v-icon></v-btn>
                            </v-flex>
                        </v-layout>
                    </form>
                </div>
            </v-flex>
        </v-layout>
    </v-container>
    <v-container grid-list-md class="programmes-list pt-0">
        <location-list></location-list>
        {{--@foreach($locations as $location)
            <location class="mb-3"
                :location="{{ $location }}"
                :user="{{ Auth()->user() }}"
            ></location>
        @endforeach
--}}
    </v-container>
@endsection
