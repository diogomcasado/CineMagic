@extends('layouts.app')
@section('title','Alterar Sala' )
@section('content')
    <form method="POST" action="{{route('user.update', ['user' => $user]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('user.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('user.list', ['user' => $user]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
