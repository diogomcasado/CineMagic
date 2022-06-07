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
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>
@endsection