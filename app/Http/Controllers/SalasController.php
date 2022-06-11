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
        $salas = Sala::paginate(50);

        return view('salas.list', compact('salas'));
    }


    public function create()
    {
        $sala = new Sala();
        return view('salas.create')
            ->withFilme($sala);
            

    }
    public function store(SalaPost $request)
    {
        $newSala = Sala::create($request->validated());
        return redirect()->route('salas')
            ->with('alert-msg', 'Sala "' . $newSala->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
    public function edit(Sala $sala)
    {
        $salas = Sala::all();
        return view('salas.edit')
            ->withFilme($sala);
            
    }
    public function update(SalaPost $request, Sala $sala)
    {
        $validated_data = $request->validated();
        $nome->fill($validated_data);
        $nome->save();
        return redirect()->route('salas.create')
            ->with('alert-msg', 'Sala "' . $sala->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Sala $sala)
    {
        $oldNome = $sala->nome;
        try {
            $sala->delete();
            return redirect()->route('salas.lista')
                ->with('alert-msg', 'Sala "' . $sala->nome . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('salas.list')
                    ->with('alert-msg', 'Não foi possível apagar a Filme "' . $oldTitulo . '", porque o filme tem sessões!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('salas.list')
                    ->with('alert-msg', 'Não foi possível apagar o Filme "' . $oldTitulo . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

}
