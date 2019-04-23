@extends('content')
@section('searchform')
<p>test</p>
<form action="/search" method="POST" role="search">
{{ csrf_field() }}
<div class="input-group">
    <input type="text" class="form-control" name="q"
           placeholder="Search programme"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
</div>
</form>
@endsection