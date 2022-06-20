@extends('layouts.app')
<link href="{{ asset('css/checkout/checkout.css') }}" rel="stylesheet">

@section('content')


<main>
    <div class="basket">

        

        @CSRF
        <fieldset>
            <!-- Form Name -->
            <div class="col-md-8">
                <div class="card-header">
                    <span class="card-title">
                        Nova Compra
                    </span>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-8 control-label" for="name">Cliente</label>
                <div class="col-md-8">
                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md" value="{{Auth::user()->name}}">
                    @error('name')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="NIF">NIF</label>
                <div class="col-md-8">
                    <input id="nif" name="nif" type="text" placeholder="" class="form-control input-md" value="{{old('nif') ?? Auth::user()->cliente-> nif?? '' }}">
                    @error('nif')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror

                </div>
            </div>

            <!-- Text input-->
            
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-8 control-label" for="tipo_pagamento">Tipo de Pagamento</label>
                <div class="col-md-8">
                    <select id="tipo_pagamento" name="tipo_pagamento" class="form-control">
                        <option value="VISA" {{old('tipo_pagamento') ?? Auth::user()->cliente->tipo_pagamento == 'VISA'? 'Selected' : ''}}>
                            VISA</option>
                        <option value="MC" {{old('tipo_pagamento')  ?? Auth::user()->cliente->tipo_pagamento == 'MC'? 'Selected' : ''}}>
                            MC</option>
                        <option value="PAYPAL" {{old('tipo_pagamento')  ?? Auth::user()->cliente->tipo_pagamento == 'PAYPAL'? 'Selected' : ''}}>
                            PAYPAL</option>
                    </select>
                    @error('tipo_pagamento')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-8 control-label" for="ref_pagamento">Referencia</label>
                <div class="col-md-8">
                    <input id="ref_pagamento" name="ref_pagamento" type="text" placeholder="" class="form-control input-md" value="{{old('ref_pagamento') ?? Auth::user()->cliente->ref_pagamento ?? '' }}">
                    @error('ref_pagamento')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror

                </div>
            </div>
        </fieldset>
        <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-8 control-label" for="button1id"></label>
            <div class="col-md-8">
                <html lang="pt-br">
                                <head>

                                    <!-- Bootstrap CSS -->
                           

                                    <title>Modal em Bootstrap | HomeHost</title>
                                </head>
                                <body>
                                    <!-- Botão que irá abrir o modal -->
                                    <button method="POST" action="{{route('checkout.store')}}"  id="submit" name="submit" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#meuModal">Finalizar Compra</button>

                                    <!-- Modal -->
                                    <div id="meuModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Conteúdo do modal-->
                                        <div class="modal-content">

                                        <!-- Cabeçalho do modal -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Compra Realizada com sucesso</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Corpo do modal -->
                                        <div class="modal-body">


                                        <form action="{{ route('email.send_with_notification1') }}" method="POST">
                                        @csrf
                                        <input type="submit" value="ok" button class="checkout-cta">
                                    </form>
                                        </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Optional JavaScript -->
                                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                                </body>
                                </html>



                
                <a href="{{route('cart.list')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        </form>
    </div>
    <aside>
        <div id="summary-encomenda" class="summary">
            <div  class="checkout-table-container">
                <h2>Seu carrinho</h2>
               
                <div class="checkout-table" id="carrinho_encomendas">
                    @foreach (Cart::getContent() as $item)
                    <tr>
                    <div class="checkout-table-row">
                        <div class="summary-total" >
                        <div id="details-compra" class="product-image">
                           <td class="col-img">
                                        <div class="filme-imagem">
                                            <img src="{{ $item->attributes->image }}"  class="rounded"
                                                alt="Thumbnail">
                                        </div>
                                    </a>
                            </td>
                    </div>
                            <div  class="checkout-item-details">
                                <div class="checkout-table-item"> Filme: {{ $item->name }}</div>
                                <div class="checkout-table-price"> Preço: {{ $item->price }} €</div>
                                <div class="checkout-table-quantity"> Quantidade: {{ $item->quantity }}</div>
                            </div>
                        </div> <!-- end checkout-table -->
                        <div class="font-weight-bold">Subtotal: {{ $item->quantity*$item->price }}€</div>
                    </div> <!-- end checkout-table-row -->
                    <tr>
                    @endforeach
                </div> <!-- end checkout-table -->

                <div class="summary-total" >
                
                    <div class="font-weight-bold">Total: ({{ App\Http\Controllers\CartController::getPercentagemIVA() }}%): €{{ App\Http\Controllers\CartController::getTotalIVA() }}€</div>
                </div>
          
            </div> <!-- end checkout-totals -->

        </div>

        </div> <!-- end checkout-section -->
    </aside>
</main>
@endsection