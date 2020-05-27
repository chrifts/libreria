@extends('admin.layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/progressbar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>
    <a href="{{env('BASE_URL')}}/admin" class="btn btn-secondary">Volver</a>

    @if (\Session::has('success'))
        <div class="row mt-3" id='row_added'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-success">
                    <span>Libro agregado.</span>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    @endif
    @if (\Session::has('mime_error'))
        <div class="row mt-3" id='row_added'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <span>El archivo tiene que ser de extensión pdf</span>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
        <form action="{{env('BASE_URL')}}/admin/post_pdf" method="POST" enctype="multipart/form-data" id='theForm'>
                @csrf

                <div class="form-group">
                  <label for="exampleInputEmail1">Título del Libro</label>
                  <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Ingrese título">
                </div>
                <div class="form-group disabled">
                    <label for="exampleInputPassword1">Identificacion interna</label>
                    <input name="ident" type="text" class="form-control disabled" id="identif" placeholder="ID" readonly>
                    <small id="path_int" class="form-text text-muted">Ubicación donde se va a guardar el pdf</small>
                </div>
                <div class="form-group">
                    <label for="">Autor</label>
                    <select name='autor' class="select-autor form-control"  data-width="100%">
                        <option value="" >Seleccionar Autor</option>
                        @foreach ($autores as $a)
                            <option value="{{$a['name']}}">{{$a['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tema/s</label>
                    <select name='temas[]' class="select-theme form-control" multiple="multiple" data-width="100%">
                        @foreach ($temas as $t)
                            <option value="{{$t}}">{{$t}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea style="height: 100px" name='descrip' form="theForm" maxlength="180" class="form-control"></textarea>
                    <small id="char_rest" class="form-text text-muted">Máximo 180 caracteres.</small>

                </div>
                <div class="form-group">
                    <div class="upload-btn-wrapper w-100">
                        <button class="btn btn-success w-100">Seleccionar PDF</button>
                        <input type="file" name="theFile" accept=".pdf" />
                    </div>
                    <div id='fileData' class="alert alert-info" style="display: none">
                        <span style='font-size: 18px;' class='font-weight-bold'>Archivo seleccionado:</span>
                    </div>
                </div>

                <div class="form-group w-100 btn-group btn-group-toggle" id='toggles'>
                    <label id='togg_scan' class="form-check-label btn btn-secondary" for="Check1">es un PDF escaneado
                        <input name="type_data" type="radio"  id="Check1" value='scan'>
                    </label>
                    {{-- <span class="alert alert-warning">Setear escaneado implica que la funcion de obtener texto puede salir incompleta, inclusio no funcionar</span> --}}
                    <label id='togg_noscan' class="form-check-label btn btn-secondary active" for="Check2">es un PDF original
                        <input name="type_data" type="radio"  id="Check2" value='original' checked>
                    </label>
                    {{-- <span class="alert alert-warning">Setear original implica que la funcion de obtener texto funciona. Pueden existir detalles</span> --}}

                </div>

                <button type="submit" class="btn btn-primary enviar w-100 mb-5">Continuar</button>
                <button type="submit" class="btn btn-secondary process" disabled style="display: none">Procesando</button>
              </form>

        </div>
        <div class="col-md-3">

        </div>
    </div>
    <div class="row mb-5" id='loadingBook' style="display: none">
        <div class="col-md-12">
            <div class="linear-progress-material">
                <div class="bar bar1"></div>
                <div class="bar bar2"></div>
            </div>
        </div>
    </div>
    <script src="/js/pdf_form.js"></script>
@endsection
