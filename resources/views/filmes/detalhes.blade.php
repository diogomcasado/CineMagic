@extends('layouts.app')


<link href="{{ asset('css/filmes/detalhes.css') }}" rel="stylesheet">


@section('content')

<div class="titulo">
    <h2>Filme: {{ $filme->titulo }}</h2>
</div>

<form action="{{route('filmes.list')}}" method="post">
    @csrf
    <div class="caixa">
        <div class="filme">
            <div class="column1">
                <div class="filme-imagem">
                    <img src="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}" alt="filme_image">
                </div>
            </div>

            <div class="column2">
                <div class="filme-info-area">
                    <p>
                        <div class="filme-label">Sumario: </div>
                        <div class="filme-info-desc">{{ $filme->sumario}}</div>
                    </p>
                    <p>&nbsp;</p>
                    <p>
                        <div class="filme-label">Genero: </div>
                        <div class="filme-info-desc">{{ $filme->genero_code}}</div>
                    </p>
                    <p>&nbsp;</p>
                    <p>
                        <div class="filme-label">Ano: </div>
                        <div class="filme-info-desc">{{ $filme->ano}}</div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <select name="sessao" id="idSessao">
        @foreach($filme->sessao as $abr => $id)
        <option value="{{$abr}}" {{old('sessao')==$abr?'selected':''}}>{{$id->data}} {{$id->horario_inicio}} Sala: {{$id->sala_id}}</option>
        @endforeach
    </select>

    <div class="cart-btn">
        <button class="btn btn-primary" type="submit">ADD to Cart</button>
    </div>

</form>
</div>
@endsection