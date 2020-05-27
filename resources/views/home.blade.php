@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cards.css') }}">

<div class="mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">Bienvenido!</div>
            </div>
            <div class="alert alert-info">
                Libros más vistos
                    <a href='{{env('BASE_URL')}}/all_books' class="btn btn-outline-dark float-right" style="position: relative; bottom: 6px;">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="row">

        @foreach ($lastBooks as $book)
            @component('main.cardbook', ['book' => $book])
                
            @endcomponent
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class=" alert alert-info">
                Libros recientes
                <a href='{{env('BASE_URL')}}/all_books' class="btn btn-outline-dark float-right" style="position: relative; bottom: 6px; width: 25%">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="row">

        @foreach ($recents as $book)
            @component('main.cardbook', ['book' => $book])
                
            @endcomponent
        @endforeach
    </div>
    
</div>
@endsection
