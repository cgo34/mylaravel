@extends('layouts.app')
@section('content')
    <v-container fluid>
        <v-layout wrap>
            <v-flex xs12 md12>
                    <v-flex xs12 md12 text-md-center>
                        <div id="filters">
                            <form action="{{ route('search') }}" method="POST">
                                @csrf
                                @method('POST')
                                <v-layout row wrap align-center>
                                    <v-flex xs12 md3 offset-md1 pl-3>
                                        <v-text-field
                                            color="#00e094"
                                            solo
                                            label="Location"
                                            prepend-inner-icon="place"
                                            id="city"
                                            name="city"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md3 pl-3>
                                        <dispositif-filter
                                        ></dispositif-filter>
                                    </v-flex>
                                    <v-flex xs12 md3 pl-3>
                                        <v-text-field
                                            color="#00e094"
                                            solo
                                            label="Budget"
                                            prepend-inner-icon="euro_symbol"
                                            id="price"
                                            name="price"
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
            </v-flex>
        </v-layout>
    </v-container>
    <actif-filter-search
        :actifcity="'{{ request('city') }}'"
        :actiflaw="'{{ $dispo }}'"
        :actifprice="'{{ request('price') }}'"
    ></actif-filter-search>
    <v-container fluid grid-list-md class="programmes-list">
        @if($programmes != '[]')
            {{--@foreach($programmes as $programme)
                @php ($count = 0)
                @php ($lots = array())
                @php ($favoriteslots = array())
                @foreach($programme->dispositifs as $dispositif)
                    @php ($dispositifs = $dispositif->name)
                @endforeach
                @php ($minimum = 1000000000)
                @foreach($programme->lots as $lot)
                    @php ($count++)
                    @php ($lots[] = $lot)
                    @php ($favoriteslots[$lot->id] = ($lot->favorited()) ? 'true' : 'false' )
                    @if($lot->prix < $minimum)
                        @php ($minimum = $lot->prix)
                    @endif
                @endforeach
                @if($minimum === 1000000000)
                    @php($minimum = 'N.C')
                @endif

                @php ($favorites = ($programme->favorited()) ? 'true' : 'false' )

                <v-card width="100%" hover>
                    <programme
                        :id="'{{ $programme->id }}'"
                        :thumbnail="'{{ addslashes($programme->thumbnail) }}'"
                        :images="'{{ addslashes($programme->images) }}'"
                        :name="'{!! addslashes($programme->name) !!}'"
                        :livraison="'{{ $programme->date_livraison }}'"
                        :city="'{{ $programme->city }}'"
                        :zipcode="'{{ $programme->zipcode }}'"
                        :dispositifs="'{{ $dispositifs }}'"
                        :count="'{{ $count }}'"
                        :lots="'{{ json_encode($lots) }}'"
                        :minimum="'{{ $minimum }}'"
                        :favorites="'{{ $favorites }}'"
                        :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                        :user="'{{ Auth()->user() }}'"
                    ></programme>
                </v-card>
                <v-spacer class="mt-1"></v-spacer>
            @endforeach--}}
            @foreach($programmes as $programme)
                @php ($count = 0)
                @php ($countFavorites = 0)
                @php ($countBooked = 0)
                @php ($lots = array())
                @php ($favoriteslots = array())
                @php ($bookslots = array())
                @foreach($programme->dispositifs as $dispositif)
                    @php ($dispositifs = $dispositif->name)
                @endforeach
                @php ($minimum = 1000000000)
                @foreach($programme->lots as $lot)
                    @php ($count++)
                    @php ($lots[] = $lot)
                    @php ($favoriteslots[$lot->id] = ($lot->favorited()) ? 'true' : 'false' )
                    @php ($bookslots[$lot->id] = ($lot->isBooked()) ? 'true' : 'false' )
                    @if($lot->prix < $minimum)
                        @php ($minimum = $lot->prix)
                    @endif
                @endforeach
                @foreach($favoriteslots as $key => $favoritelot)
                    @if($favoritelot === 'true')
                        @php ($countFavorites++)
                    @endif
                @endforeach
                @foreach($bookslots as $key => $booklot)
                    @if($booklot === 'true')
                        @php ($countBooked++)
                    @endif
                @endforeach
                @if($minimum === 1000000000)
                    @php($minimum = 'N.C')
                @endif

                @php($countFinal = $count - $countBooked)
                @php ($favorites = ($programme->favorited()) ? 'true' : 'false' )
                @php ($books = ($programme->booked()) ? 'true' : 'false' )

                <v-card width="100%" hover>
                    <programme
                        :id="'{{ $programme->id }}'"
                        :thumbnail="'{{ addslashes($programme->thumbnail) }}'"
                        :images="'{{ addslashes($programme->images) }}'"
                        :name="'{!! addslashes($programme->name) !!}'"
                        :livraison="'{{ $programme->date_livraison }}'"
                        :city="'{{ $programme->city }}'"
                        :zipcode="'{{ $programme->zipcode }}'"
                        :dispositifs="'{{ $dispositifs }}'"
                        :count="'{{ $count }}'"
                        :countfavorites="'{{ $countFavorites }}'"
                        :countbooked="'{{ $countBooked }}'"
                        :countfinal="'{{ $countFinal }}'"
                        :lots="'{{ json_encode($lots) }}'"
                        :minimum="'{{ $minimum }}'"
                        :favorites="'{{ $favorites }}'"
                        :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                        :books="'{{ $books }}'"
                        :bookslots="'{{ json_encode($bookslots) }}'"
                        :user="'{{ Auth()->user() }}'"
                    ></programme>
                </v-card>
                <v-spacer class="mt-1"></v-spacer>
            @endforeach
        @else
            @php($user = Auth::user())
                        <contact-form
                            :user="'{{ $user }}'"
                        ></contact-form>
        @endif
    </v-container>
@endsection
