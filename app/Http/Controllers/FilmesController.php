<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Genero;
use App\Models\Sessao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\FilmePost;




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
        $generos = Genero::paginate(25);
        $filme = new Filme();
 
        return view('filmes.create')
            ->withFilme($filme)
            ->withGeneros($generos);;
            

    }
    public function store(FilmePost $request)
    {
        $newFilme = Filme::create($request->validated());
        return redirect()->route('filmes')
            ->with('alert-msg', 'Filme "' . $newFilme->titulo . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
    public function edit(Filme $filme)
    {
        $filmes = Filme::all();
        return view('filmes.edit')
            ->withFilme($filme);
            
    }
    public function update(FilmePost $request, Filme $filme)
    {
        $validated_data = $request->validated();
        $titulo->fill($validated_data);
        $titulo->save();
        return redirect()->route('filmes.create')
            ->with('alert-msg', 'Filme "' . $filme->titulo . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Filme $filme)
    {
        $oldTitulo = $filme->titulo;
        try {
            $filme->delete();
            return redirect()->route('filmes.lista')
                ->with('alert-msg', 'Disciplina "' . $filme->titulo . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'Não foi possível apagar a Filme "' . $oldTitulo . '", porque o filme tem sessões!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'Não foi possível apagar o Filme "' . $oldTitulo . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
