@extends('layouts.app')

@section('content')
    <v-container fluid grid-list-md class="programmes-list">
        <v-flex md12 >
            <h2 class="display-1 text-uppercase font-weight-bold grey--text text--darken-4 pa-2">Mes demandes d'option</h2>
            <p class="headline text-uppercase ">Retrouvez toutes vos demandes d'options sur les différents lots</p>
        </v-flex>
        @php( $listeProgramme = array() )

        {{-- Add id programme of lot if not in programme list --}}
        {{ $myOptionRequests }}
        @foreach ($myOptionRequests as $myOptionRequest)
            @if(!in_array($myOptionRequest->programme_id, $listeProgramme))
                @php($listeProgramme[] = $myOptionRequest->programme_id)
            @endif
        @endforeach


        @foreach($listeProgramme as $programme_id)

            {{-- Define variable --}}
            @php ($programme = app('App\Programme')->find($programme_id))
            @php ($count = 0)
            @php ($countBooks = 0)
            @php ($minimum = 1000000000)
            @php ($lots = array())
            @php ($favoriteslots = array())
            @php ($bookslots = array())

            {{-- Define Dispositif Programme --}}
            @foreach($programme->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach

            {{-- Define Books lots --}}
            @foreach ($myOptionRequests as $myOptionRequest)
                @if($myOptionRequest->programme_id == $programme->id)
                    @php ($count++)
                    @php ($lots[] = $myOptionRequest)
                    @php ($favoriteslots[$myOptionRequest->id] = ($myOptionRequest->favorited()) ? 'true' : 'false' )
                    @php ($bookslots[$myOptionRequest->id] = ($myOptionRequest->booked()) ? 'true' : 'false' )
                    @if($myOptionRequest->prix < $minimum)
                        @php ($minimum = $myOptionRequest->prix)
                    @endif
                    @php($state = $myOptionRequest->pivot->state)
                @endif
            @endforeach



            {{-- Count Booked Lots --}}
            @foreach($myOptionRequests as $key => $myOptionRequest)
                @if($myOptionRequest === 'true')
                    @php ($countBooks++)
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
            @php ($page = 'mybooks' )

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
                    :countfinal="'{{ $countBooks }}'"
                    :lots="'{{ json_encode($lots) }}'"
                    :minimum="'{{ $minimum }}'"
                    :favoriteslots="'{{ json_encode($favoriteslots) }}'"
                    :favorites="'{{ $favorites }}'"
                    :page="'{{ $page }}'"
                    :books="'{{ $books }}'"
                    :bookslots="'{{ json_encode($bookslots) }}'"
                    :user="'{{ Auth()->user() }}'"
                    :state="'{{ $state }}'"
                ></programme>
            </v-card>
            <v-spacer></v-spacer>
        @endforeach
    </v-container>
@endsection
