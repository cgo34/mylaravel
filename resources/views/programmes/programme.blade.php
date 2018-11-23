@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>{{ $programme->name }}</h1>
                <img src="{{ $programme->thumbnail }}" style="width:100%">
                <p>{!! $programme->description !!}</p>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Lots disponibles</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Type</th>
                            <th>Parking</th>
                            <th>Etage</th>
                            <th>Surface</th>
                            <th>Exposition</th>
                        </tr>
                    </thead>

                @foreach($lots as $lot)
                    @if ($lot->programme_id == $programme->id)
                        <tr>
                            <td><span>{{ $lot->numero }}</span></td>
                            <td><span>{{ $lot->type }}</span></td>
                            <td><span>{{ $lot->parking }}</span></td>
                            <td><span>{{ $lot->etage }}</span></td>
                            <td><span>{{ $lot->surface }}</span></td>
                            <td><span>{{ $lot->exposition }}</span></td>
                        </tr>
                    @endif

                @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
