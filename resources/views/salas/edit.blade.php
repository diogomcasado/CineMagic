@extends('layouts.app')
@section('title','Alterar Sala' )
@section('content')
    <form method="POST" action="{{route('sala.update', ['sala' => $sala]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('salas.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('sala.list', ['sala' => $sala]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
