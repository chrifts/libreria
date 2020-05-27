@extends('layouts.app')

@section('content')
    <link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
    
    <div id="libros">
        <div class="form-group">
            <input class="search w-100 ms-choice" placeholder=" Buscar por título, autor o temas" />
        </div>
        {{-- <div class="filters-group">
            <input class="textfield filter__search js-shuffle-search ms-choice mb-3" type="search" id="filters-search-input" placeholder=" Buscar por título" />
        </div> --}}

        <div class="form-group row">
            
                <div class="col-md-6 col-xs-12">
                    <select class="date_s mb-3" id='select1' multiple='multiple' style="width:100%;" data-placeholder="Autor">
                    </select>
                </div>
                <div class="col-md-6 col-xs-12">
                    <select class="name_s " id='select2' multiple='multiple' style="width:100%;" data-placeholder="Tema">
                        @foreach ($temas as $tema)
                            <option value="{{$tema}}">{{$tema}}</option>
                        @endforeach
                    </select>
                </div>
            
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <h5>Resultado: <span id='count_books'></span></h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <fieldset class="filters-group">
                    <h5 class="filter-label">Ordenar</h5>
                    <div class="btn-group sort-options btn-group-toggle">
                        <button onclick='sortList("date", this)' class="btn btn-outline-dark">
                            Más reciente
                        </button>
                        <button onclick='sortList("title", this)' class="btn btn-outline-dark">
                            Título
                        </button>
                    </div>
                  </fieldset>
            </div>
        </div>

        <div class="list row " id='id01'>
            @foreach ($books as $book)
                @component('main.cardbook', ['book' => $book])
                    
                @endcomponent
            @endforeach
        </div>
    </div>
  
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.0/list.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/5.2.3/shuffle.min.js"></script>
    <script src="/js/shuffle.js"></script>
    

@endsection