<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Sessao;
use App\Models\User;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\SalaPost;
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
        $salas = Sala::paginate(15);

        return view('salas.list')->withSalas($salas);
    }


    public function create()
    {
     
            
        $sala = new Sala();
        return view('salas.create')->withSala($sala);

    }
    public function store(SalaPost $request)
    {
        $newSala = Sala::create($request->validated());
       
        return redirect()->route('sala.list')
            ->with('alert-msg', 'Sala "' . $newSala->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    
        }
    public function edit(Sala $sala)
    {
       
        return view('salas.edit')
            ->withSala($sala);
            
    }
    public function update(SalaPost $request, Sala $sala)
    {
        $sala->fill($request->validated());
        $sala->save();
        return redirect()->route('sala.list')
            ->with('alert-msg', 'Sala "' . $sala->id . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Sala $sala)
     {
         $oldName = $sala->id;
         try {
             $sala->delete();
             return redirect()->route('sala.list')
                 ->with('alert-msg', 'Sala "' . $oldName . '" foi apagado com sucesso!')
                 ->with('alert-type', 'success');
         } catch (\Throwable $th) {
 
             if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                 return redirect()->route('salas')
                     ->with('alert-msg', 'Não foi possível apagar o Sala "' . $oldName . '", porque este Sala já está em uso!')
                     ->with('alert-type', 'danger');
             } else {
                 return redirect()->route('salas')
                     ->with('alert-msg', 'Não foi possível apagar o Sala "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                     ->with('alert-type', 'danger');
             }
         }
     }

}
