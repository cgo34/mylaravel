@extends('layouts.app')

@section('content')
    <v-container fluid grid-list-md class="programmes-list">
        <div class="page-header">
            <h3>My Favorites</h3>
        </div>
        {{--@forelse ($myFavorites as $myFavorite)
            @php ($count = 0)
            @php ($lots = array())
            @foreach($myFavorite->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach
            @foreach($myFavorite->lots as $lot)
                @php ($count++)
                @php ($lots[] = $lot)
            @endforeach
            @php ($favorites = ($myFavorite->favorited()) ? 'true' : 'false' )
            <programme
                    :id="'{{ $myFavorite->id }}'"
                    :images="'{{ addslashes($myFavorite->images) }}'"
                    :name="'{!! addslashes($myFavorite->name) !!}'"
                    :livraison="'{{ $myFavorite->date_livraison }}'"
                    :city="'{{ $myFavorite->ville }}'"
                    :zipcode="'{{ $myFavorite->code_postal }}'"
                    :dispositifs="'{{ $dispositifs }}'"
                    :count="'{{ $count }}'"
                    :lots="'{{ json_encode($lots) }}'"
                    :favorites="'{{ $favorites }}'"
            ></programme>
            <v-spacer></v-spacer>
        @empty
            <p>You have no favorite programmes.</p>
        @endforelse--}}



        {{--@php ($lots = array())
        @forelse ($myFavoritesLots as $myFavoriteLot)
            {{ $myFavoriteLot }}


            @php ($programme = app('App\Programme')->find($myFavoriteLot->programme_id))

            <p>{{ $myFavorite->name }} => {{ $myFavoriteLot->number }} [{{ $myFavoriteLot->id }}]</p>
            @php ($lots[] = $myFavoriteLot)

            @php ($favorites = ($myFavorite->favorited()) ? 'true' : 'false' )

                <programme
                        :id="'{{ $myFavorite->id }}'"
                        :images="'{{ addslashes($myFavorite->images) }}'"
                        :name="'{!! addslashes($myFavorite->name) !!}'"
                        :livraison="'{{ $myFavorite->date_livraison }}'"
                        :city="'{{ $myFavorite->ville }}'"
                        :zipcode="'{{ $myFavorite->code_postal }}'"
                        :dispositifs="'{{ $dispositifs }}'"
                        :count="'{{ $count }}'"
                        :lots="'{{ json_encode($lots) }}'"
                        :favorites="'{{ $favorites }}'"
                ></programme>
                <v-spacer></v-spacer>



        @empty
            <p>You have no favorite lots.</p>
        @endforelse--}}



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
            @php ($lots = array())
            @php ($favoriteslots = array())
            {{-- Define dispositif --}}
            @foreach($programme->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach

            {{-- Define lots --}}
            @foreach ($myFavoritesLots as $myFavoriteLot)
                @if($myFavoriteLot->programme_id == $programme->id)
                    @php ($count++)
                    @php ($lots[] = $myFavoriteLot)
                    @php ($favoriteslots[$myFavoriteLot->id] = ($myFavoriteLot->favorited()) ? 'true' : 'false' )
                @endif
            @endforeach

            {{-- Define isFavorite --}}
            @php ($favorites = ($programme->favorited()) ? 'true' : 'false' )
            @php ($favoritespage = 'true' )

            <programme
                    :id="'{{ $programme->id }}'"
                    :images="'{{ addslashes($programme->images) }}'"
                    :name="'{!! addslashes($programme->name) !!}'"
                    :livraison="'{{ $programme->date_livraison }}'"
                    :city="'{{ $programme->ville }}'"
                    :zipcode="'{{ $programme->code_postal }}'"
                    :dispositifs="'{{ $dispositifs }}'"
                    :count="'{{ $count }}'"
                    :lots="'{{ json_encode($lots) }}'"
                    :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                    :favorites="'{{ $favorites }}'"
                    :favoritespage="'{{ $favoritespage }}'"
            ></programme>
            <v-spacer></v-spacer>

        @endforeach
        {{--@php( $listeProgramme = array() )

        --}}{{-- Add programme id in programme list --}}{{--
        @forelse ($myFavorites as $myFavorite)
            @php($listeProgramme[] = $myFavorite->id)
        @empty
            <p>You have no favorite lots.</p>
        @endforelse

        --}}{{-- Add id programme of lot if not in programme list --}}{{--
        @foreach ($myFavoritesLots as $myFavoriteLot)
            @if(!in_array($myFavoriteLot->programme_id, $listeProgramme))
                @php($listeProgramme[] = $myFavoriteLot->programme_id)
            @endif
        @endforeach

        @foreach($listeProgramme as $programme_id)

            --}}{{-- Define variable --}}{{--
            @php ($programme = app('App\Programme')->find($programme_id))
            @php ($count = 0)
            @php ($lots = array())
            @php ($favoriteslots = array())
            --}}{{-- Define dispositif --}}{{--
            @foreach($programme->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach

            --}}{{-- Define lots --}}{{--
            @foreach ($myFavoritesLots as $myFavoriteLot)
                @if($myFavoriteLot->programme_id == $programme->id)
                    @php ($count++)
                    @php ($lots[] = $myFavoriteLot)
                    @php ($favoriteslots[$myFavoriteLot->id] = ($myFavoriteLot->favorited()) ? 'true' : 'false' )
                @endif
            @endforeach

            --}}{{-- Define isFavorite --}}{{--
            @php ($favorites = ($programme->favorited()) ? 'true' : 'false' )

            <programme
                    :id="'{{ $programme->id }}'"
                    :images="'{{ addslashes($programme->images) }}'"
                    :name="'{!! addslashes($programme->name) !!}'"
                    :livraison="'{{ $programme->date_livraison }}'"
                    :city="'{{ $programme->ville }}'"
                    :zipcode="'{{ $programme->code_postal }}'"
                    :dispositifs="'{{ $dispositifs }}'"
                    :count="'{{ $count }}'"
                    :lots="'{{ json_encode($lots) }}'"
                    :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                    :favorites="'{{ $favorites }}'"
            ></programme>
            <v-spacer></v-spacer>

        @endforeach--}}
    </v-container>
@endsection