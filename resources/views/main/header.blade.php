
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
                <a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</div>
<div class="row">
    <div class="col-sm col-md-12">
        <div class="row mx-0 justify-content-between">
            <a href="{{env('BASE_URL')}}/" style="color: black">
                <img class="rounded theImg d-inline" src="{{url('/images/logo.png')}}"/>
                <div class="theTitle d-inline-block" style="margin-left: 5px">
                    <h2 class="d-inline font-weight-light title-mob">Libreia digital
                        <h4 class="d-inline font-weight-lighter title-mob">Seminario concordia</h4>
                    </h2>
                </div>
            </a>

            <div class="my-auto">
                <a id="menu-toggle" href="#" class="btn btn-default toggle d-block d-sm-none  show606"><i class="fas fa-bars"></i></a>
            </div>

            @guest
                <div class="text-right my-auto d-none d-sm-block hide606">
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
                                {{-- <span class="dropdown-title" style="margin-left:23px">Hola {{ Auth::user()->name }}</span> --}}
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
