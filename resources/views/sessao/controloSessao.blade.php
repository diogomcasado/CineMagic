@extends('layouts.app')


<link href="{{ asset('css/sessao/controlo-sessao.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

@section('content')



@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="main">
    <h1>Controlo de acesso á sessão {{ $sessao->id }}</h1>
    
        
        <div class="caixa">
            <div class="filme">
                <div class="column1">
                    <div class="filme-imagem">
                        <img src="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}" alt="filme_image">
                    </div>
                </div>

                <div class="column2">
                    <div class="filme-info-area">

                        <div class="flex-container">
                            <div class="filme-label">Titulo: {{ $filme->titulo}}</div>
                            <div class="filme-label">Sumario: {{ $filme->sumario}}</div>
                            <div class="filme-label">Genero: {{ $filme->genero_code}}</div>
                            <div class="filme-label">Ano: {{ $filme->ano}}</div>
                            <div class="filme-label">Data sessão: {{ $sessao->data}}</div>
                            <div class="filme-label">Hora: {{ $sessao->horario_inicio}}</div>
                            <div class="filme-label">Sala: {{ $sessao->sala_id}}</div>


                        </div>

                        </p>
                    </div>
                </div>

                <form method="POST" action="{{route('encontra.bilhete')}}" class="form-group">
                    @csrf
                    <input class="form-control" type="text" name="bilhete" id="bilhete" placeholder="Numero bilhete">
                    <input type="hidden" value="{{ $sessao->id }}" name="id_sessao">
                    <input type="hidden" value="{{ $filme->id }}" name="id_filme">
                    <button type="submit" class="btn btn-primary">Checkar bilhete</button>
                </form>
            </div>
    
</div>

@endsection