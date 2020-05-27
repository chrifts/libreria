<link rel="stylesheet" href="/css/header.css">
<div id="sidebar-wrapper" class="border-left">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-default text-right toggle d-block border-bottom pdrt"><i class="fas fa-times"></i></a>
        <li>
            <a href="{{env('BASE_URL')}}/" class="btn-link">Home</a>
        </li>
        @guest
            <li>
                <a href="{{env('BASE_URL')}}/login" class="btn-link">Inicia sesion</a>
            </li>
            <li>
                <a href="{{env('BASE_URL')}}/register" class="btn-link">Registrate</a>
            </li>
        @else
            <li>
                <a href="{{env('BASE_URL')}}/authors" class="btn-link">Autores</a>
            </li>
            <li>
                <a href="{{env('BASE_URL')}}/all_books" class="btn-link">Buscador de libros</a>
            </li>
            <li>
                <a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form-mob').submit();">
                {{ __('Logout') }}
                </a>

                <form id="logout-form-mob" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</div>
<div class="row new-head">
    <a href="{{env('BASE_URL')}}/" class="logoDiv">
        <img class="rounded theImg d-inline" src="{{url('/images/logo.png')}}"/>
    </a>
    <div class="col-sm col-md-12">
        
        <div class="row mx-0 justify-content-end">
            <div class="theTitle d-inline-block w-100" style="margin-left: 140px">
                <h2 class="d-block font-weight-bold title-mob full-tit">Biblioteca digital <span style="font-weight: 100 !important; font-size: 20px;">Seminario Concordia</span></h2>
                <div class="divided-tit" style="display: none;">
                    <h2 class="d-block font-weight-bold title-mob">Biblioteca digital</h2>
                    <h2 class="d-block title-mob" style="font-weight: 100; font-size: 20px;">Seminario Concordia</h2>
                </div>
                
                
            </div>

            <div class="my-auto">
                <a id="menu-toggle" href="#" class="btn btn-default toggle d-block show606"><i class="fas fa-bars"></i></a>
            </div>

            @guest
                <div class="text-right my-auto d-none d-sm-block hide606" style="z-index: 2000; bottom: 5px; position: relative;">
                    <a type="button" class="btn btn-info" href="{{env('BASE_URL')}}/login">Inicia sesion</a>
                    <a type="button" class="btn btn-primary" href="{{env('BASE_URL')}}/register">Registrate</a>
                </div>
            @else
                <div class="text-right my-auto d-none d-sm-block hide606">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class='dropdown-item' href="{{env('BASE_URL')}}/authors" class="btn-link">Autores</a>
                                
                                <a class='dropdown-item' href="{{env('BASE_URL')}}/all_books" class="btn-link">Buscador de libros</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                
                            </div>
                            

                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</div>
<script>
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
</script>
