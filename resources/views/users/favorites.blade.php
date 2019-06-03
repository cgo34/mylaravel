@extends('layouts.app')

@section('content')
    <v-container fluid grid-list-md class="programmes-list">
        <v-flex md12 class="page-header">
            <h3>Mes favoris</h3>
        </v-flex>
        @php( $listeProgramme = array() )

        {{-- Add id programme of lot if not in programme list --}}
        @foreach ($myFavoritesLots as $myFavoriteLot)
            @if(!in_array($myFavoriteLot->programme_id, $listeProgramme))
                @php($listeProgramme[] = $myFavoriteLot->programme_id)
            @endif
        @endforeach

        @foreach($listeProgramme as $programme_id)

            {{-- Define variable --}}
            @php ($programme = app('App\Programme')->find($programme_id))
            @php ($count = 0)
            @php ($countFavorites = 0)
            @php ($countBooked = 0)
            @php ($minimum = 1000000000)
            @php ($lots = array())
            @php ($favoriteslots = array())
            @php ($bookslots = array())

            {{-- Define Dispositif Programme --}}
            @foreach($programme->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach

            {{-- Define Favorites Lots --}}
            @foreach ($myFavoritesLots as $myFavoriteLot)
                {{ $myFavoriteLot }}
                @if($myFavoriteLot->programme_id == $programme->id)
                    @php ($count++)
                    @php ($lots[] = $myFavoriteLot)
                    @php ($favoriteslots[$myFavoriteLot->id] = ($myFavoriteLot->favorited()) ? 'true' : 'false' )
                    @php ($bookslots[$myFavoriteLot->id] = ($myFavoriteLot->booked()) ? 'true' : 'false' )
                    @if($myFavoriteLot->prix < $minimum)
                        @php ($minimum = $myFavoriteLot->prix)
                    @endif
                @endif
            @endforeach

            {{-- Count Favorites Lots --}}
            @foreach($programme->lots as $lot)
                @foreach($favoriteslots as $key => $favoritelot)
                    @if($lot->id === $key)
                        @php ($countFavorites++)
                    @endif
                @endforeach
            @endforeach

            {{-- Count Booked Lots --}}
            @foreach($bookslots as $key => $booklot)
                @if($booklot === 'true')
                    @php ($countBooked++)
                @endif
            @endforeach

            {{-- Define Minimum Price Lot --}}
            @if($minimum === 1000000000)
                @php($minimum = 'N.C')
            @endif

            {{-- Define isFavorite Programme --}}
            @php ($favorites = ($programme->favorited()) ? 'true' : 'false' )

            {{-- Define isBooked Programme --}}
            @php ($books = ($programme->booked()) ? 'true' : 'false' )

            {{-- Define Page --}}
            @php ($page = 'myfavorites' )

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
                    :lots="'{{ json_encode($lots) }}'"
                    :minimum="'{{ $minimum }}'"
                    :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                    :favorites="'{{ $favorites }}'"
                    :books="'{{ $books }}'"
                    :bookslots="'{{ json_encode($bookslots) }}'"
                    :page="'{{ $page }}'"
                    :user="'{{ Auth()->user() }}'"
                ></programme>
            </v-card>
            <v-spacer></v-spacer>
        @endforeach
    </v-container>
@endsection
