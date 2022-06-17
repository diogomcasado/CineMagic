@extends('layouts.app')
@section('title', 'Novo User' )
@section('content')
    <form method="POST" action="{{route('user.store')}}" class="form-group">
        @csrf
        @include('user.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('user.list')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
