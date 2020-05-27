<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Biblioteca digital - Seminario Concordia</title>
    <link rel="shortcut icon" href="/images/logo.png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Scripts -->
    {{-- <script src="{{mix('js/app.js')}}" defer></script> --}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<style>
    .theLine {
        position: relative; 
        height: 0px; 
        top: 82px;
    }
    
    @media (max-width: 992px) {
        .theLine {
            top: 135px;
        }
    }
    @media (max-width: 768px) {
        .theLine {
            top: 52px;
        }
    }
    .the-bod {
        position: relative; 
        bottom: 85px;
    }
    .hdr {
        margin-top: 20px;
    }
    @media (max-width: 768px) {
        .the-bod {
            bottom: 0px;
        }
        .hdr {
            margin-top: 0px;
        }
    }
</style>
<body>
    <div class="w-100 border-bottom theLine"></div>
    <div class="container mt-2">
        <div label='header' id='_hdr' class="hdr" >
            @section('sidebar')
                @component('main.header')

                @endcomponent
            @show
        </div>

        <div class="the-bod" label='body'>
            @yield('content')
        </div>
    </div>
</body>
</html>
