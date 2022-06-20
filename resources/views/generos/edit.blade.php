@extends('layouts.app')
@section('title','Alterar Genero' )
@section('content')
    <form method="POST" action="{{route('genero.update', ['genero' => $genero]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('generos.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('genero.list', ['genero' => $genero]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
