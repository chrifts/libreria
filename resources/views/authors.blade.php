@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>Autores</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($authors as $author)
                <a href="{{env('BASE_URL')}}/author/{{$author->id}}"> {{$author->name}}</a>
            @endforeach
        </div>
    </div>
    

@endsection