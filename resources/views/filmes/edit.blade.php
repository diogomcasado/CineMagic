@extends('layouts.app')
@section('title','Alterar Filme' )
@section('content')
    <form method="POST" action="{{route('filme.update', ['filme' => $filme]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('filmes.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('filme.edit', ['filme' => $filme]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
