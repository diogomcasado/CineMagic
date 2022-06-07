@extends('layouts.app')


<link href="{{ asset('css/users/admin.css') }}" rel="stylesheet">


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
    <h1>Administração</h1>
    <form action="{{ route('config.edit') }}" method="POST">
        @csrf
        <div class="col-12">
            <label for="name" class="form-label">Preço do bilhete sem IVA: </label>
            <div class="input">
                <input type="text" class="form-control" id="bilhete" name="bilhete"
                    value="{{ $config->preco_bilhete_sem_iva }}">
            </div>
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Percentagem do IVA: </label>
            <div class="input">
                <input type="text" class="form-control" id="iva" name="iva" value="{{ $config->percentagem_iva }}">
                
            </div>
        </div>


        <div class="btn">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Guardar</button>
        </div>
    </form>
</div>
@endsection