@extends('layouts.app')


@section('content')

<h1>Listagem de Filmes</h1>
<hr>
<<div class="container">
<table class="table table-bordered table-striped table-sm">
    </div>
    <a href="{{route('filmes.create')}}" class="btn btn-success" role="button" aria-pressed="true">Adicionar Filme</a>
    <table class="table">
        <thead>
             <tr> 
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
                    <td>{{$filme->id}}</td>
                    <td>{{$filme->titulo}}</td>
                    <td>{{$filme->genero_code}}</td>
                    <td>{{$filme->sumario}}</td>
                   
              
                <td>
                    <form method="GET" action=""
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