<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Seminario') }}</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer>
        <script src="{{ asset('js/bootstrap.js') }}" defer></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    </head>
    <style>

        @media (max-width: 575px) {
            .theImg {
                width: 75px;
            }
            .title-mob {
                font-size: 18px;
            }
            .theTitle {
                width: 165px;
            }
        }
    
        .pdrt {
            padding-top: 37px;
            padding-right: 27px;
        }
    
    </style>
<body>

    <div id="app" class="container-fluid">
        <div class="row border-bottom mb-5">
            <div class="col-md-12"> 
                <nav class="navbar navbar-default navbar-static-top">
                    <a class="navbar-brand" href="{{ env('BASE_URL') . url('/admin') }}">
                        Administración - Libreria Seminario
                    </a>
                    @if (Auth::guard('admin')->check())
                        <button type="button" class="btn navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            Menu
                        </button>
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="{{ URL::to('admin/add_admin') }}">Agregar admin</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                    
                </nav>
            </div>
        </div>
        @yield('content')
    </div>
</body>
</html>
