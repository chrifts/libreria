@extends('layouts.app')

@section('content')
<style>

    .theimg {
        width: 100px;
        position: relative;
        top: 0px;
        z-index: 20;
    }

    .card-custom {
        /* padding-top: 70px !important */
    }

    .card-content-custom {
        margin-top: 35px;
    }
    @media (max-width: 991px) {

        .theimg {
            right: 0px;
            top: 0px;
        }

    }
    @media (max-width: 576px) {

    }

    @media (max-width: 767px) {
        #div-img {
            display: none !important;
        }
        .card-content-custom {
            margin-top: 0px;
        }
        .card-custom {
            margin: 7px 0px 7px 0px;
        }
    }
    #div-img {
        position: relative;
        top: 50px;
    }

</style>
<div class="mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    Bienvenido. Ultimos libros agregados :
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        @foreach ($lastBooks as $book)
            <div class="col-md-4 card-custom" title='{{$book->title}}'>
                <div class="w-100 d-none d-sm-block" id='div-img'>
                    <img src="https://seminarioconcordia.com.ar/libreria/public/images/logo.png" class="d-block mx-auto shadow theimg rounded-circle card-img-top" alt="...">
                </div>
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-xs-12">
                            <div class="card-body card-content-custom shadow">
                                <h5 class="card-title">{{$book->title}}</h5>
                                @php
                                    $desc = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa laborum corrupti, repellendus itaque tenetur fuga minus consequuntur. Labore delectus iste vel magni, consequatur quas ex adipisci eius exercitationem ad? Eligendi!'
                                @endphp
                                <p class="card-text">{{strlen($desc) > 200 ? substr($desc, 0, 197) . '...' : $desc}}</p>
                                <a href="{{env('BASE_URL').'/view_pdf/'.$book->internal_id.'/'.$book->is_large_file}}" class="btn btn-primary stretched-link">Leer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>
</div>
@endsection
