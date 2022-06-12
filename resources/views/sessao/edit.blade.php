@extends('layouts.app')
@section('title','Alterar Sessao' )
@section('content')
    <form method="POST" action="{{route('sessao.update', ['sessao' => $sessao]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('sessao.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('sessao.list', ['sessao' => $sessao]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
