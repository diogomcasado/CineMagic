@extends('layouts.app')

@section('content')

<h1>Listagem de Recibos</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Recibo ID</th>
                <th>Cliente ID</th>
                <th>Data</th>
                <th>Preço Total</th>
                <th>Nif</th>
                <th>Tipo de Pagamento</th>
                <th>Ref. Pagamento</th>
                <th>PDF</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach($recibos as $rec)
            <tr>
                <td>{{ $rec->id }}</td>
                <td>{{ $rec->cliente_id}}</td>
                <td>{{ $rec->data }}</td>
                <td>{{ $rec->preco_total_com_iva}}</td>
                <td>{{ $rec->nif }}</td>
                <td>{{ $rec->tipo_pagamento }}</td>
                <td>{{ $rec->ref_pagamento }}</td>
                <th>{{$rec->recibo_pdf_url}}</th>
               </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection