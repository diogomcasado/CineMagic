@extends('layouts.app')

<link href="/css/filmes/filme.css" rel="stylesheet">


@section('content')
    <h1>Catálogo</h1>
    <div id="search_div_categoria" class="col-md justify-content-md-center">
                <!-- <select id="search_categoria" name="categoria_id" class="form-control ">
                    <option value="" selected>--Genero--</option> -->
                   
                    </option>
                  
                </select>
            </div>
            <form id="form_search" action="{{route('filmes.list')}}" method="GET">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input value="{{old('inputsearch')}}" name="inputsearch" id="input_search" type="search"
                    class="form-control" />
            </div>
           
            <button id="btn_search" type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i>
            </button>

        </div>

    </form>
    <div class="filmes-list">
        @foreach ($filmesListFinal as $filmes => $filme)
        <span class="filme">
            <a href="/filme/{{$filme->id}}">
                <img src="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}" alt="filme_image">
            </a>
            <p><strong>Titulo: </strong>{{ $filme->titulo }}</p>
            <p><strong>Sumario: </strong>{{ $filme->sumario }}</p>
        </span>
        @endforeach
    </div>

    {{ $filmesListFinal->links() }}
@endsection

