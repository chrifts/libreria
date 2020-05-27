<div class="col-md-3 card-custom grid-item picture-item mb-5" order="{{$book->created_at}}" title="{{$book->title}}">
    <div class="w-100 d-none d-sm-block" id='div-img'>
        <img src="https://seminarioconcordia.com.ar/libreria/public/images/logo.png" class="d-block shadow theimg rounded-circle card-img-top" style="margin-left: 12px" alt="...">
    </div>
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-12 col-xs-12">
                <div class="card-body card-content-custom shadow picture-item__details">
                    <h5 class="card-title picture-item__title title">{{$book->title}}</h5>
                    <a href='{{env("BASE_URL")}}/author/{{$book->author->id}}' class="born" style="z-index: 2000">{{$book->author->name}}</a>
                    <p class="name" hidden>{{$book->theme}}</p>

                    @php
                        $desc = $book->description;
                    @endphp
                    
                    <p class="card-text">{{strlen($desc) > 200 ? substr($desc, 0, 197) . '...' : $desc}}</p>
                    <a href="{{Auth::check('web') ? env('BASE_URL').'/view_pdf/'.$book->internal_id.'/'.$book->is_large_file : env('BASE_URL').'/reg_flow'}}" class="btn btn-primary read_btn">Leer</a>
                </div>
            </div>
        </div>
    </div>
</div>