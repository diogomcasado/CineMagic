@extends('layouts.app')


@section('content')

<h1>Listagem de Generos</h1>
<hr>
<<div class="container">
<table class="table table-bordered table-striped table-sm">
    </div>
    <a href="{{route('generos.create')}}" class="btn btn-success" role="button" aria-pressed="true"> Adicionar Genero</a>
    <table class="table">
        <thead>
             <tr> 
                <th>Code</th>
                <th>Tipo</th>
                
                
              
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($generos as $genero)
                <tr>
                    <td>{{$genero->code}}</td>
                    <td>{{$genero->nome}}</td>
                   
                   
              
                <td>
                    <form method="GET" action="{{ route('genero.edit', ['genero' => $genero->code]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                    <td>
                    <form method="POST" action="{{ route('genero.destroy', ['genero' => $genero->code]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja apagar este genero?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Apagar</button>
                    </form>

                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
  

@endsection