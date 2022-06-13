@extends('layouts.app')


<link href="{{ asset('css/users/profile.css') }}" rel="stylesheet">


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

<h1>User Profile Page</h1>
<div class="main">
    <form action="{{ route('user.edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <div class="col-12">
            <!-- email_verified_at need to verify to put date  -->
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="col-12">
            <label for="name" class="form-label">NIF</label>
            <input type="text" class="form-control" id="nif" name="nif" value="{{ $cliente->nif }}">
        </div>

        <div class="col-12">
            <label for="name" class="form-label">Tipo de pagamento</label>
            <select class="form-control" name="tipo_pagamento" id="tipo_pagamento" value="{{ $cliente->tipo_pagamento }}">
                <option value="">N/A</option>
                <option value="mbway">MbWay</option>
                <option value="paypal">PayPal</option>
                <option value="visa">Visa</option>

            </select>
        </div>

        <div class="col-12">
            <label for="name" class="form-label">Referencia de pagamento</label>
            <input type="text" class="form-control" id="ref_pagamento" name="ref_pagamento" value="{{ $cliente->ref_pagamento }}">
        </div>

        <div class="col-12">
            <!-- password_updated_at to put date of password change -->
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="col-12">
            <label for="photo" class="form-label">Photo Link</label>
            <input type="file" id="photo" name="photo" class="form-control">
        </div>

        <div class="btn">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Save Profile</button>
        </div>
    </form>
</div>
@endsection