@extends('admin.layouts.app')

@section('content')
    @if (\Session::has('success'))
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-success">
                    <span>Libro agregado</span>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
        <form action="{{env('BASE_URL')}}/admin/post_pdf" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo del Libro</label>
                  <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">
                  <small id="emailHelp" class="form-text text-muted">Título a publicar</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Autor</label>
                    <select name="autor" class="form-control" id="exampleFormControlSelect1">
                      <option>pepe</option>
                      <option>roberto</option>
                    </select>
                </div>
                <div class="form-group disabled">
                  <label for="exampleInputPassword1">Identificacion interna</label>
                  <input name="ident" type="text" class="form-control disabled" id="identif" placeholder="ID" readonly>
                  <small id="path_int" class="form-text text-muted">Ubicación donde se va a guardar el pdf</small>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">El PDF</label>
                    <input name='theFile' type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>

                <div class="form-check">
                    <input name="type_data" type="radio" class="form-check-input" id="exampleCheck1" value='scan'>
                    <label class="form-check-label" for="exampleCheck1">es un PDF escanead</label>
                    <p class="alert alert-warning">Setear escaneado implica que la funcion de obtener texto puede salir incompleta, inclusio no funcionar</p>
                </div>
                <div class="form-check">
                    <input name="type_data" type="radio" class="form-check-input" id="exampleCheck1" value='original' checked>
                    <label class="form-check-label" for="exampleCheck1">es un PDF original</label>
                    <p class="alert alert-warning">Setear original implica que la funcion de obtener texto funciona. Pueden existir detalles</p>

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

        </div>
        <div class="col-md-3">

        </div>


    </div>
    <script>
        $('#title').on('keyup', function(){
            var a = $(this).val();
            var b = a.replace(/[^a-z0-9]/gi,'');
            $('#identif').val(b.toLowerCase());
        })

    </script>

@endsection
