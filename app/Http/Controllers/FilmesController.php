<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class FilmesController extends Controller
{
 
    public function index(Request $request)
    {
        $dataHoje = Carbon::now()->toDateString();
        $filmesListFinal = Filme::whereHas('sessao', function($query){
            $query->where('data', '>', Carbon::now()->toDateString());
        })->simplePaginate(12);

        return view('filmes.list', compact('filmesListFinal'));

    }

    public function detalhes(Request $request)
    {
        $filme = Filme::findOrFail($request->route('id'));

        $sessoes = $filme->sessao->where('data', '>', Carbon::today());
      


        $data = array (
            "filme" => $filme,
            "sessoes" => $sessoes

        );

        //dd($sessoes);

        return view('filmes.detalhes') ->with($data);
       
    }




}
