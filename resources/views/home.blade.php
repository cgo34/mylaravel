@extends('layouts.app')

@section('content')
    <layout></layout>
<div class="container-fluid">
    <div class="row mt-2 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <lot></lot>
        </div>
    </div>
</div>
@endsection
<script>
    import Lot from "./js/components/Lot";
    export default {
        components: {Lot}
    }
</script>