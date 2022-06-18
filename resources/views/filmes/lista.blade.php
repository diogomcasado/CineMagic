@extends('layouts.app')


@section('content')

<h1>Listagem de Filmes</h1>
<hr>
<<div class="container">
<table class="table table-bordered table-striped table-sm">
<div id="search_div_filme" class="col-md justify-content-md-center">
                <select id="search_genero" name="genero_code" class="form-control ">
                    <option value="" selected>--Genero--</option>
                   
                    @foreach($generos as $genero)
                    <option value="{{$genero->code}}" {{ old("genero_code") == $genero->code ? "selected" : "" }}>
                        {{$genero->code}}
                    </option>
                    @endforeach
                  
                </select>
    </div>
            <form id="form_search" action="{{route('filme.lista')}}" method="GET">
        
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
    </div>
    <a href="{{route('filmes.create')}}" class="btn btn-success" role="button" aria-pressed="true">Adicionar Filme</a>
    <table class="table">
        <thead>
             <tr> 
                <th></th>
                <th>ID</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Sumario</th>
                
              
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $filme)
                <tr>
                    <td>
                        <img src="{{$filme->cartaz_url ? asset('storage/cartazes/' . $filme->cartaz_url) : asset('img/default_img.png') }}" alt="Foto do aluno"  class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{$filme->id}}</td>
                    <td>{{$filme->titulo}}</td>
                    <td>{{$filme->genero_code}}</td>
                    <td>{{$filme->sumario}}</td>
                   
              
                <td>
                    <form  action="{{ route('filme.edit', ['filme' => $filme->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                    <td>
                        
                    <form method="POST" action="{{ route('filme.destroy', ['filme' => $filme->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja apagar este filme?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Apagar</button>
                    </form>

                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    {{ $filmes->withQueryString()->links() }}

@endsection