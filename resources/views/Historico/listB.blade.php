@extends('layouts.app')

@section('content')

<h1>Listagem de Bilhetes</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Bilhete ID</th>
                <th>Recibo ID</th>
                <th>Cliente ID</th>
                <th>Sessao ID</th>
                <th>Lugar ID</th>
                <th>Preço sem iva</th>
                <th>Estado</th>
                
              
            </tr>
        </thead>
        <tbody>
            @foreach($bilhetes as $bilhe)
            <tr>
                <td>{{ $bilhe->id }}</td>
                <td>{{ $bilhe->recibo_id }}</td>
                <td>{{ $bilhe->cliente_id}}</td>
                <td>{{ $bilhe->sessao_id }}</td>
                <td>{{ $bilhe->lugar_id}}</td>
                <td>{{ $bilhe->preco_sem_iva }}</td>
                <td>{{ $bilhe->estado }}</td>
               </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection