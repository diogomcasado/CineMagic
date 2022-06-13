@extends('layouts.app')


@section('content')

<h1>Listagem de Sessões</h1>
<hr>
<<div class="container">
<table class="table table-bordered table-striped table-sm">
    </div>
    <a href="{{route('sessoes.create')}}" class="btn btn-success" role="button" aria-pressed="true">Adicionar Sessao</a>
    <table class="table">
        <thead>
             <tr> 
                <th></th>
                <th>ID</th>
                <th>Filme_id</th>
                <th>Sala_id</th>
                <th>data</th>
                <th>Hora Inicio</th>
               
              
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessoes as $sessao)
                <tr>
                    <td>
                        
                    </td>
                    <td>{{$sessao->id}}</td>
                    <td>{{$sessao->filme_id}}</td>
                    <td>{{$sessao->sala_id}}</td>
                    <td>{{$sessao->data}}</td>
                    <td>{{$sessao->horario_inicio}}</td>
                   
              
                <td>
                    <form  action="{{ route('sessao.edit', ['sessao' => $sessao->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                    <td>
                        
                    <form method="POST" action="{{ route('sessao.destroy', ['sessao' => $sessao->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja apagar esta sessao?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Apagar</button>
                    </form>

                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    {{ $sessoes->withQueryString()->links() }}

@endsection