@extends('admin.layouts.app')

@section('content')

    <div class="row justify-content-end">
        <div class="col-md-2 border-right">
            <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link primary" href="subir_pdf">Subir pdf</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary" href="pdf_to_text">test pdf</a>
                  </li>
                <li class="nav-item">
                  <a href="{{ URL::to('admin/add_admin') }}" class="nav-link">Agregar admin</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ route('admin.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-10">
            <h2 class="font-weight-lighter">Administradores</h2>
            <div class="row">
                <div class="col-lg-6">
                    @foreach ($admins as $admin)
                        <div class="card mb-2">
                            <div class="card-body">
                            <h5 class="card-title {{$admin->email == $user->email ? 'text-danger' : ''}}">{{$admin->id == 1 ? 'Admin principal' : $admin->name}} {{$admin->email == $user->email ? '(Tú)' : ''}}</h5>
                            <p class="card-text">{{$admin->email}}</p>
                            <a href="#" class="btn btn-primary">Editar</a>
                                @if($user->id == 1 && $admin->id !== 1)
                                    <a
                                        class="btn btn-danger"
                                        href="delete/{{$admin->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('del-{{$admin->id}}').submit();"
                                    >
                                        Borrar
                                    </a>
                                    <form id="del-{{$admin->id}}" action="delete/{{$admin->id}}" method="POST">
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </div>
                            @if($errors->any())
                                {!! implode('', $errors->all("<span class='text-danger'>:message</span>")) !!}
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
