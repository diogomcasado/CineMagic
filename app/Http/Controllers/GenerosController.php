<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\GeneroPost;
class GenerosController extends Controller
{
 
    

    ///////////////////// Listagem de Generos



    public function list()
    {
        $generos = Genero::all();

        return view('generos.list')->withGeneros($generos);
    }


    public function create()
    {
     
            
        $genero = new Genero();
        return view('generos.create')->withGenero($genero);

    }
    public function store(GeneroPost $request)
    {
        $newGenero = Genero::create($request->validated());
       
        return redirect()->route('genero.list')
            ->with('alert-msg', 'Genero "' . $newGenero->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    
        }
    public function edit(Genero $genero)
    {
       
        return view('generos.edit')
            ->withGenero($genero);
            
    }
    public function update(GeneroPost $request, Genero $genero)
    {
        $genero->fill($request->validated());
        $genero->save();
        return redirect()->route('genero.list')
            ->with('alert-msg', 'Genero "' . $genero->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Genero $genero)
     {
         $oldGenero = $genero->code;
         try {
             $genero->delete();
             return redirect()->route('genero.list') 
                 ->with('alert-msg', 'Genero "' . $oldGenero . '" foi apagado com sucesso!')
                 ->with('alert-type', 'success');
         } catch (\Throwable $th) {
 
             if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                
                 return redirect()->route('genero.list')
                     ->with('alert-msg', 'Não foi possível apagar o Genero "' . $oldGenero . '". Erro: ' . $th->errorInfo[2])
                     ->with('alert-type', 'danger');
             }
         }
     }

}
