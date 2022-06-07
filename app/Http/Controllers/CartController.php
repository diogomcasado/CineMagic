<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Configuracao;
use App\Models\Cart;
use Darryldecode\Cart\Helpers\Helpers;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $preco = Configuracao::all()->first()->preco_bilhete_sem_iva;
        //dd($precos);
        //dd($request->all());
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $preco,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Produto adicionado com sucesso!');

        return redirect()->route('cart.list');
    }

    public function list()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart.cart', compact('cartItems'));
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Produto removido!');

        return redirect()->route('cart.list');
    }

    public function clear()
    {
        \Cart::clear();

        session()->flash('success', 'Todos os produtos foram removidos!');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Produto atualizado!');

        return redirect()->route('cart.list');
    }

    public static function getSubTotal(){
        $subTotal = \Cart::getTotal();

        return $subTotal;
    }

    public static function getPercentagemIVA(){
        $percentagemIVA = Configuracao::all()->first()->percentagem_iva;

        return $percentagemIVA;
    }

    public static function getValorIVA(){
        $subTotal = app('App\Http\Controllers\CartController')->getSubTotal();
        $percentagemIVA = app('App\Http\Controllers\CartController')->getPercentagemIVA();

        $valorIVA = ($subTotal * ($percentagemIVA/100));
        $valorIVA = number_format((float)$valorIVA, 2, '.', '');

        return $valorIVA;
    }

    public static function getTotalIVA()
    {
        $valorIVA = app('App\Http\Controllers\CartController')->getValorIVA();

        $totalComIVA = app('App\Http\Controllers\CartController')->getValorIVA() + 
        app('App\Http\Controllers\CartController')->getSubTotal();
        $totalComIVA = number_format((float)$totalComIVA, 2, '.', '');

        return $totalComIVA;
    }
}
