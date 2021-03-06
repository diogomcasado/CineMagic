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
       
        $privada = false;
        $generos = Genero::all();

         if ($request->inputsearch) {

            $filmesListFinal = Filme::where('titulo', 'like', '%' . $request->inputsearch . '%')->get('id');
            

            // $filmesListFinal=Filme::where('titulo', 'like', '%' . $request->inputsearch . '%');
        }else{

            $filmesListFinal = Filme::whereHas('sessao', function($query){
                $query->where('data', '>', Carbon::now()->toDateString());
            })->simplePaginate(12);
        }
        

        $request->flash();
        return view('filmes.list', compact('filmesListFinal','privada','generos'));

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

   

    public function list(Request $request)
    {

        $generos = Genero::all();

         if ($request->inputsearch) {

            

            $filmes = Filme::where('titulo', 'like', '%' . $request->inputsearch . '%')->get('id');

        }elseif ($request->genero_code != null) {
            $filmes=Filme::where('genero_code', '=', $request->genero_code);
        }else{

            $filmes = Filme::all();

        }

         
       
        
        return view('filmes.lista', compact('filmes','generos'));
    }

    public function create()
    {
        $generos = Genero::paginate(25);
        $filme = new Filme();
        return view('filmes.create')
            ->withFilme($filme)
            ->withGeneros($generos);
            

    }
    public function store(FilmePost $request)
    {
        $newFilme = Filme::create($request->validated());
       
        return redirect()->route('filmes.lista')
            ->with('alert-msg', 'Filme "' . $newFilme->titulo . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    
        }
    Public function edit(Filme $filme)
        {
            $generos = Genero::all();
            return view('filmes.edit')
                ->withFilme($filme)
                ->withGeneros($generos);
        }    
       
  

    public function update(FilmePost $request, Filme $filme)
        {
            $filme->fill($request->validated());
            $filme->save();
            return redirect()->route('filmes.lista')
                ->with('alert-msg', 'Filme "' . $filme->id . '" foi alterado com sucesso!')
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
            // $th ?? a exce????o lan??ada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a pr??xima linha para verificar qual a informa????o que a exce????o tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'N??o foi poss??vel apagar a Filme "' . $oldTitulo . '", porque o filme tem sess??es!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'N??o foi poss??vel apagar o Filme "' . $oldTitulo . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
