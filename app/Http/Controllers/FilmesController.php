<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Sessao;
use App\Models\User;
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


    /////////////////////

    public function index2()
    {
        // $user = User::findOrFail(Auth::id());
        // $cliente = Cliente::findOrFail(Auth::id());
        // if($user->tipo == 'F'){
        //     return abort(403, 'Unauthorized action.');
        // }

        #$full = $user->concat($cliente);


        return view('filmes.lista', compact('filmes'));
        // return view('user.profile', compact('user', 'cliente'));
    }

    public function list()
    {
        $filmes = Filme::paginate(25);

        return view('filmes.lista', compact('filmes'));
    }

    public function create()
    {
        $filme = new Filme();
        
        return view('filmes.create')
            ->withFilme($filme);
            
    }
    public function store(FilmePost $request)
    {
        $newFilme = Filme::create($request->validated());
        return redirect()->route('admin.filmes')
            ->with('alert-msg', 'Filme "' . $newFilmes->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


}
