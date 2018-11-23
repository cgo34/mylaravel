@extends('layouts.app')

@section('content')
    <example-component></example-component>
    <div id="results">
        <div class="display">
            <header style="background: orange; color: #fff;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="cols" style="display: table-cell; width: 100%; ">
                            <div class="col col-md-1" style="width: 11%; display: table-cell "></div>
                            <div class="col col-md-1" style="width: 17%; display: table-cell ">Département</div>
                            <div class="col col-md-1" style="width: 15%; display: table-cell ">Loi</div>
                            <div class="col col-md-1" style="width: 9%; display: table-cell ">Prix m</div>
                            <div class="col col-md-1" style="width: 13%; display: table-cell ">Prix min</div>
                            <div class="col col-md-1" style="width: 9%; display: table-cell ">Rentabilité</div>
                            <div class="col col-md-1" style="width: 10%; display: table-cell ">Livraison</div>
                            <div class="col col-md-1" style="width: 16%; display: table-cell ">Lots disponibles</div>
                        </div>
                    </div>
                </div>
            </header>


            <div class="container-fluid">
                    @php ($prix_minimum = 0)
                    @php ($count_rentabilite = 0)
                    @php ($total_rentabilite = 0)
                    @php ($rentabilite = 0)
                    @foreach($programmes as $programme)
                        @foreach($lots as $lot)
                            @if ($lot->programme_id == $programme->id)
                                @php ($count_rentabilite++)
                                @php ($total_rentabilite += $lot->rentabilite)

                                @if($prix_minimum == 0)
                                    @php ($prix_minimum = $lot->prix)
                                @elseif($lot->prix <= $prix_minimum)
                                    @php ($prix_minimum = $lot->prix)
                                @endif
                            @endif
                        @endforeach
                        @php ($rentabilite = $total_rentabilite/$count_rentabilite)

                        <style>

                            .programme  {
                                height: 70px;
                                display: table;
                            }

                            .programme .cols {
                                display: table;
                            }

                            .programme .cols .cols-content {
                                display: table;
                            }

                            .programme .col {
                                display: table-cell !important;
                                vertical-align: middle !important;
                            }

                        </style>
                        <div id="{{ $programme->id }}" class="row programme" style="border-bottom: 1px solid #E2E8ED; padding: 0 5px; background: #fff; display: table;">
                            <div class="cols" style="display: table; width: 100%; ">
                                <div class="cols-content" style="display: table;">
                                    <div class="col col-md-1" style="width: 11%; padding: 0; display: table-cell "><img src="{{ $programme->thumbnail }}" style="width:100%"></div>
                                    <div class="col col-md-1" style="width: 17%; display: table-cell;"><span>{{ $programme->name }}</span><br>{{ $programme->ville }} ({{ $programme->code_postal }})</div>
                                    <div class="col col-md-1" style="width: 15%; display: table-cell;">{{ $programme->dispositifs->first()->name }}</div>
                                    <div class="col col-md-1" style="width: 9%; display: table-cell;">{{ $prix_minimum }}</div>
                                    <div class="col col-md-1" style="width: 13%; display: table-cell;">{{ $prix_minimum }}</div>
                                    <div class="col col-md-1" style="width: 9%; display: table-cell;">{{ $rentabilite }}</div>
                                    <div class="col col-md-1" style="width: 10%; display: table-cell;">{{ $programme->lots->first()->livraison }}</div>
                                    <div class="col col-md-1" style="width: 16%; display: table-cell; ">{{ $programme->lots->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <?php /*<div class="col-md-3">
                            <a href="/programmes/{{ $programme->slug }}">
                                <img src="{{ $programme->thumbnail }}" style="width:100%">
                                <span>{{ $programme->name }}</span>
                            </a>
                        </div> */ ?>
                        @php ($array_rentabilite = [])
                    @endforeach

            </div>
        </div>
    </div>


@endsection
