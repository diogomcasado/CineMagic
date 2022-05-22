@extends('layouts.app')

<link href="/css/filmes/filme.css" rel="stylesheet">


@section('content')
    <h1>Catalogo</h1>
    <div class="filmes-list">
        @foreach ($filmesList as $filmes => $filme)
        <span class="filme">
            <a href="/filme/{{$filme->id}}">
                <img src="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}" alt="filme_image">
            </a>
            <p><strong>Titulo: </strong>{{ $filme->titulo }}</p>
            <p><strong>Sumario: </strong>{{ $filme->sumario }}</p>
        </span>
        @endforeach
    </div>

    {{ $filmesList->links() }}
@endsection

