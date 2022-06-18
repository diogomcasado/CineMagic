@extends('layouts.app')

<link href="{{ asset('css/cart/cart.css') }}" rel="stylesheet">

@section('content')
<main class="my-8">
    <div class="container px-6 mx-auto">
        <div class="flex justify-center my-6">
            <div class="">
                @if ($message = Session::get('success'))

                <p class="alert alert-success">{{ $message }}</p>

                @endif
                <h3 class="">Carrinho</h3>
                <div class="flex-1">
                    <table class="table table-striped" cellspacing="0">
                        <thead>
                            <tr class="">
                                <th class=""></th>
                                <th class="">Nome</th>
                                <th class="">Quantidade</th>
                                <th class=""> Preço</th>
                                <th class=""> Remover </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="col-img">

                                    <a href="#">
                                        <div class="filme-imagem">
                                            <img src="{{ $item->attributes->image }}" class="rounded"
                                                alt="Thumbnail">
                                        </div>
                                    </a>

                                </td>
                                <td>
                                    <a href="#">
                                        <p class="">{{ $item->name }}</p>

                                    </a>
                                </td>
                                <td class="">
                                    <div class="">
                                        <div class="">

                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    class="quantidade" />
                                                <button type="submit" class="btn btn-secondary">Atualizar</button>
                                            </form>
                                        </div>

                                    </div>
                                </td>
                                <td class="">
                                    <span class="">
                                        €{{ $item->price }}
                                    </span>
                                </td>
                                <td class="">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="btn btn-danger">x</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>

                        Total sem IVA: €{{ Cart::getTotal() }}
                    </div>
                    <div>
                        Total com IVA({{ App\Http\Controllers\CartController::getPercentagemIVA() }}%): €{{ App\Http\Controllers\CartController::getTotalIVA() }}
                    </div>
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Remover todos</button>
                           

                        </form>
                        @if (Auth::user()) 
                        <a href="{{route('checkout.create')}}" class="btn btn-success" role="button" aria-pressed="true">Checkout</a>
                        @else
                        <html lang="pt-br">
                                <head>

                                    <!-- Bootstrap CSS -->
                           

                                    <title>Modal em Bootstrap | HomeHost</title>
                                </head>
                                <body>
                                    <!-- Botão que irá abrir o modal -->
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#meuModal" >Checkout</button>

                                    <!-- Modal -->
                                    <div id="meuModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Conteúdo do modal-->
                                        <div class="modal-content">

                                        <!-- Cabeçalho do modal -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Escola uma opção</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Corpo do modal -->
                                        <div class="modal-body">

                                        <a href="{{route('login')}}"> <button class="checkout-cta">Login
                                        
                                            
                                        </div>
                                        <a href="{{route('register')}}"> <button class="checkout-cta">Criar conta
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
                        @endif   
                        

                        
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>
@endsection