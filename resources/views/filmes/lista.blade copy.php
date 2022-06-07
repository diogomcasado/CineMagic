<!-- @extends('layouts.app')


@section('content')

<h1>Listagem de Filmes</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Sumario</th>
                <
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($filmesLista as $filmes => $filme)
            <tr>
                <td>{{ $filme->id }}</td>
                <td>{{ $filme->name }}</td>
                <td>{{ $filme->email }}</td>
                <td>{{ $filme->tipo }}</td>
            
                <td>
                    
                </td>
                <td>
                    <form method="POST" action="{{ route('filme.destroy', ['filme' => $filme->id]) }}"
                        style="display: inline" onsubmit="return confirm('Deseja excluir este utilizador?');">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-sm">Apagar</button>
                    </form>

                </td>
                <!-- @if($filme->tipo != 'C')
                <td>
                    <form method="GET" action=""
                        style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="get">
                        <button class="btn btn-secondary btn-sm">Editar</button>
                    </form>
                @endif -->
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
{{ $filmesLista ->links() }}
@endsection -->