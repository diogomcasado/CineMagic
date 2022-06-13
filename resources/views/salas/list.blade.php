@extends('layouts.app')


@section('content')

<h1>Listagem de salas</h1>
<hr>
<<div class="container">
<table class="table table-bordered table-striped table-sm">
    </div>
    <a href="{{route('salas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Adicionar sala</a>
    <table class="table">
        <thead>
             <tr> 
                <th>ID</th>
                <th>Nome</th>
                
                
              
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td>{{$sala->id}}</td>
                    <td>{{$sala->nome}}</td>
                   
                   
              
                <td>
                    <form method="GET" action="{{ route('sala.edit', ['sala' => $sala->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                    <td>
                    <form method="POST" action="{{ route('sala.destroy', ['sala' => $sala->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja apagar este sala?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Apagar</button>
                    </form>

                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    {{ $salas->withQueryString()->links() }}

@endsection