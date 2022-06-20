@extends('layouts.app')
@section('title', 'Novo Genero' )
@section('content')
    <form method="POST" action="{{route('generos.store')}}" class="form-group">
        @csrf
        @include('generos.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('genero.list')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
