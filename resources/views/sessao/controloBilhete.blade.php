@extends('layouts.app')


<link href="{{ asset('css/sessao/controlo-sessao.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

@section('content')

@if ($message = Session::get('success'))

<p class="alert alert-success">{{ $message }}</p>

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
                            <div class="filme-label">ID do bilhete: {{ $bilhete->id}}</div>
                            <div class="filme-label">ID do recibo: {{ $bilhete->recibo_id}}</div>
                            <div class="filme-label">ID do cliente: {{ $bilhete->cliente_id}}</div>
                            <div class="filme-label">Status: {{ $bilhete->estado}}</div>
                            <div class="filme-label">Nif: {{ $cliente->nif}}</div>
                            <div class="filme-label">Referencia pagamento: {{ $cliente->ref_pagamento}}</div>
                            <div class="filme-label">Nome: {{ $user->name}}</div>
                            <div class="filme-label">Email: {{ $user->email}}</div>
                            
                            


                        </div>

                        </p>
                    </div>
                </div>

                @if ($bilhete->estado == "não usado" )
                <form method="POST" action="{{route('bilhete')}}" class="form-group">
                    @csrf
                    
                    <input type="hidden" value="{{ $sessao->id }}" name="id_sessao">
                    <input type="hidden" value="{{ $bilhete->id }}" name="id_bilhete">
                    <button type="submit" class="btn btn-primary">Validar bilhete</button>
                </form>
                @else
                    <h4 class="mb-3">Bilhete já usado</h4>
                @endif
            </div>
    
</div>

@endsection