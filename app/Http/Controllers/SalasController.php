<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SalasController extends Controller
{
 
    

    ///////////////////// Listagem de Salas

    public function index2()
    {
        // $user = User::findOrFail(Auth::id());
        // $cliente = Cliente::findOrFail(Auth::id());
        // if($user->tipo == 'F'){
        //     return abort(403, 'Unauthorized action.');
        // }

        #$full = $user->concat($cliente);


       // return view('filmes.lista', compact('filmes'));
        // return view('user.profile', compact('user', 'cliente'));
    }

    public function list()
    {
        $salas = Sala::paginate(50);

        return view('salas.list', compact('salas'));
    }




}
