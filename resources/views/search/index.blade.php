@extends('layouts.app')
@section('content')


    <v-flex xs12 sm12 sm12>
        <searchbar></searchbar>
        <form action="/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" id="city" name="city"
                       placeholder="Search city"/>
                <button type="submit" class="btn btn-default">
                    <v-icon>search</v-icon>
                </button>
            </div>
        </form>
    </v-flex>
    <v-container fluid grid-list-md class="programmes-list">

        @foreach($programmes as $programme)
            @php ($count = 0)
            @php ($lots = array())
            @php ($favoriteslots = array())
            @foreach($programme->dispositifs as $dispositif)
                @php ($dispositifs = $dispositif->name)
            @endforeach
            @foreach($programme->lots as $lot)
                @php ($count++)
                @php ($lots[] = $lot)
                @php ($favoriteslots[$lot->id] = ($lot->favorited()) ? 'true' : 'false' )
            @endforeach

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
                    :favorites="'{{ $favorites }}'"
                    :favoriteslots="'{{ json_encode($favoriteslots) }}'"

            ></programme>
            <v-spacer></v-spacer>
        @endforeach

    </v-container>
@endsection