<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao;
use App\Models\User;
use Auth;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $config = Configuracao::findOrFail(1);
        //dd($config);

        if($user->tipo == 'F' || $user->tipo == 'C'){
            return abort(403, 'Unauthorized action.');
        }

        return view('user.admin', compact('config'));

    }

    public function edit(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'bilhete' => 'required|max:99|min:1|numeric',
            'iva' => 'required|max:99|min:1|integer',
        ],
        [
        'bilhete.required'  => 'Preço do bilhete obrigatório',
        'bilhete.max'       => 'Preco do bilhete deve ser no maximo 99',
        'bilhete.min'       => 'Preco do bilhete deve ser no minimo 1',
        'bilhete.numeric'   => 'Preco do bilhete tem de ser um valor numerico',
        'iva.required'      => 'IVA do bilhete obrigatório',
        'iva.max'           => 'IVA do bilhete deve ser no maximo 99',
        'iva.min'           => 'IVA do bilhete deve ser no minimo 1',
        'iva.integer'       => 'IVA tem de ser um valor inteiro',
        ]
    );

        $bilhete =  $request->input('bilhete');
        $iva =      $request->input('iva');

        Configuracao::where('id',1)->update(['preco_bilhete_sem_iva'=>$bilhete]);
        Configuracao::where('id',1)->update(['percentagem_iva'=>$iva]);

        session()->flash('success', 'Valores editados com sucesso!');

        if($user->tipo == 'F' || $user->tipo == 'C'){
            return abort(403, 'Unauthorized action.');
        }

        return redirect()->route('config');
    }
}
