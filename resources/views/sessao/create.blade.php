@extends('layouts.app')
@section('title', 'Nova Sessao' )
@section('content')
    
    <form method="POST" action="{{route('sessoes.store')}}" class="form-group">
        @csrf
        @include('sessao.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('sessao.list')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
