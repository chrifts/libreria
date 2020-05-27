@extends('admin.layouts.app')

@section('content')
<a href="{{env('BASE_URL')}}/admin" class="btn btn-secondary">Volver</a>
    <h2 class="font-weight-lighter">Libros</h2>
    <div class="row">
        <div class="col-md-12">
                {{-- @foreach ($books as $book)
                    <div class="card mb-2 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">{{$book->autor}}</p>
                            <a href="#" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-secondary">Despulicar</a>

                            @if($user->id == 1)
                                <a
                                    class="btn btn-danger"
                                    href="delete_book/{{$book->id}}"
                                    onclick="event.preventDefault();
                                    document.getElementById('del-{{$book->id}}').submit();"
                                >
                                    Borrar
                                </a>
                                <form id="del-{{$book->id}}" action="delete_book/{{$book->id}}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </div>
                        @if($errors->any())
                            {!! implode('', $errors->all("<span class='text-danger'>:message</span>")) !!}
                        @endif
                    </div>
                @endforeach --}}

                <table class="table table-striped table-dark">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                            <th scope="row">{{$book->internal_id}}</th>
                            <td>{{$book->title}}</td>
                            <td>{{$book->autor}}</td>
                            <td>
                                <a href="#" class="btn btn-primary">Editar</a>
                                <a href="#" class="btn btn-secondary">Deshabilitar</a>

                                @if($user->id == 1)
                                    <a
                                        class="btn btn-danger"
                                        href="delete_book/{{$book->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('del-{{$book->id}}').submit();"
                                    >
                                        Borrar
                                    </a>
                                    <form id="del-{{$book->id}}" action="delete_book/{{$book->id}}" method="POST">
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
        </div>
    </div>

@endsection
