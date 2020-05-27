@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <img src="" alt="" width="200px">
            <h4>{{$author->name}}</h4>
        </div>
        <div class="col-md-8"></div>
    </div>
    <div class="row">
        @foreach ($author->books as $book)
            @component('main.cardbook', ['book' => $book])
                
            @endcomponent
        @endforeach
    </div>
    

@endsection