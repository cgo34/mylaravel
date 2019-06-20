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
    <v-container fluid grid-list-md class="programmes-list pt-0">
        @foreach($programmes as $programme)

            {{-- Define Variables --}}
            @php ($count = 0)
            @php ($countFavorites = 0)
            @php ($countMyBooked = 0)
            @php ($countBooked = 0)
            @php ($lots = array())
            @php ($favoriteslots = array())
            @php ($mybookslots = array())
            @php ($bookslots = array())

            {{-- Define Minimum Price --}}
            @php ($minimum = 1000000000)

            {{-- Define Array for Count Details --}}
            @foreach($programme->lots as $lot)
                @php ($count++)
                @php ($favoriteslots[$lot->id] = ($lot->favorited()) ? 'true' : 'false' )
                @php ($mybookslots[$lot->id] = ($lot->myBooked()) ? 'true' : 'false' )
                @php ($bookslots[$lot->id] = $lot->isBooked())
                @if($lot->prix < $minimum)
                    @php ($minimum = $lot->prix)
                @endif
            @endforeach

            {{-- Count Favorites Lots --}}
            @foreach($favoriteslots as $key => $favoritelot)
                @if($favoritelot === 'true')
                    @php ($countFavorites++)
                @endif
            @endforeach

            {{-- Count My Booked Lots --}}
            @foreach($mybookslots as $key => $mybooklot)
                @if($mybooklot === 'true')
                    @php ($countMyBooked++)
                @endif
            @endforeach

            {{-- Count Booked Lots --}}
            @foreach($bookslots as $key => $booklot)
                @if($booklot === 'true')
                    @php ($countBooked++)
                @endif
            @endforeach

            {{-- Define Minimum Price --}}
            @if($minimum === 1000000000)
                @php($minimum = 'N.C')
            @endif

            {{-- Count Final Number of Lots --}}
            @if($count === $countBooked && $countMyBooked > 0)
                @php($countFinal = $countMyBooked)
            @elseif($count !== $countBooked)
                @php($countFinal = $count - $countBooked)
            @endif

            @if($count === $countBooked && $countMyBooked > 0)
                <v-card width="100%" hover class="mb-3">
                    <programmes
                        :programme="{{ $programme }}"
                        :minimum="'{{ $minimum }}'"
                        :countfinal="'{{ $countFinal }}'"
                        :user="{{ Auth()->user() }}"
                    ></programmes>
                </v-card>
            @elseif($count !== $countBooked)
                <v-card width="100%" hover class="mb-3">
                    <programmes
                        :programme="{{ $programme }}"
                        :minimum="'{{ $minimum }}'"
                        :countfinal="'{{ $countFinal }}'"
                        :user="{{ Auth()->user() }}"
                    ></programmes>
                </v-card>
            @endif
        @endforeach
    </v-container>
@endsection
