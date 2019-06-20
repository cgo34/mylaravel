@extends('layouts.app')

@section('content')
    <v-container fluid grid-list-md class="programmes-list">
        <v-flex md12 >
            <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Mes demandes d'option</h2>
            <p class="headline text-uppercase ">Retrouvez toutes vos demandes d'options sur les différents lots</p>
        </v-flex>
    </v-container>
    <v-container fluid grid-list-md class="programmes-list pt-0">
        @forelse($programmes as $programme)

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
        @empty
            <p>Vous n'avez aucun lots en favoris</p>
        @endforelse
    </v-container>
@endsection
