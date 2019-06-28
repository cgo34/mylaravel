@extends('layouts.app')
@section('content')
    <v-container fluid grid-list-md>
        @forelse($properties as $property)

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
            @foreach($property->properties as $lot)
                @php ($count++)
                @php ($favoriteslots[$lot->id] = ($lot->favorited()) ? 'true' : 'false' )
                @php ($mybookslots[$lot->id] = ($lot->myBooked()) ? 'true' : 'false' )
                @php ($bookslots[$lot->id] = $lot->isBooked())
                @if($lot->price < $minimum)
                    @php ($minimum = $lot->price)
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

                    <properties
                        :property="{{ $property }}"
                        :minimum="'{{ $minimum }}'"
                        :countfinal="'{{ $countFinal }}'"
                        :user="{{ Auth()->user() }}"
                    ></properties>
            @elseif($count !== $countBooked)
                    <properties
                        :property="{{ $property }}"
                        :minimum="'{{ $minimum }}'"
                        :countfinal="'{{ $countFinal }}'"
                        :user="{{ Auth()->user() }}"
                    ></properties>
            @endif
        @empty
            <p>Aucun programmes disponibles</p>
        @endforelse
    </v-container>
@endsection
