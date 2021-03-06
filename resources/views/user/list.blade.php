@extends('layouts.app')


@section('content')

<h1>Listagem de Clientes</h1>
<hr>
<div class="container">
<a   href="{{route('user.create')}}"  class="btn btn-success" role="button" aria-pressed="true">Adicionar Cliente</a>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Utilizador</th>
                <th>Bloqueado</th>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}" 
                alt="Foto do aluno"  class="img-profile rounded-circle" style="width:40px;height:40px">
                </td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tipo }}</td>
                <td>{{$user->bloqueado == '1'? 'Bloqueado' : ''}}</td>
                <td>
                    <form method="POST" action="{{ route('user.bloquear', ['user' => $user->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <button class="btn btn-warning btn-sm">{{$user->bloqueado == '1'? 'Desbloquear' : 'Bloquear'}}</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('user.destroy2', ['user' => $user->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja excluir este utilizador?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>

                </td>
                @if($user->tipo != 'C')
                <td>
                    <form method="GET" action="{{ route('user.edit2', ['user' => $user->id]) }}"
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                @endif
                </td>
                
            </tr>
            @empty
            <tr>
                <td colspan="6">Nenhum registo encontrado para listar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
</div>
{{ $users->links() }}
@endsection