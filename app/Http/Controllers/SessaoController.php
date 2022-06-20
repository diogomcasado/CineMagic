<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\Sessao;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Bilhete;
use Carbon\Carbon;
use App\Http\Requests\SessaoPost;
use Auth;

class SessaoController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        if($user->tipo != 'F'){
            return abort(403, 'Unauthorized action.');
        }

        $dataHoje = Carbon::now()->toDateString();
        $filmesListFinal = Filme::whereHas('sessao', function($query){
            $query->where('data', '>', Carbon::now()->toDateString());
        })->get();

        // dd($filmesListFinal);
 
      
        return view('sessao.controlo', compact('filmesListFinal'));
    }

    public function get_data($id)
    {
        //$sessoes = Sessao::where('filme_id', $id)->pluck("data","id");

        $sessoes = Sessao::where('filme_id', $id)
        ->groupBy('data')
        ->having('data', '>', Carbon::now()->toDateString())
        ->pluck("data");

        //dd($sessoes);
        return json_encode($sessoes);
        
    }

    public function get_horario($id, $data)
    {
        //dd($data);
        $sessoes = Sessao::where('filme_id', $id)
        ->whereDate('data', '=', $data)
        ->pluck("horario_inicio", "id");

        //dd($sessoes);
        return json_encode($sessoes);
        
    }

    public function sessao($sessao_id)
    {
        $sessao = Sessao::findOrFail($sessao_id);

        //$sessoes = $filme->sessao->where('data', '>', Carbon::today());
        $filme_id = $sessao->filme_id;
        $filme = Filme::findOrFail($filme_id);
        //dd($filme);
      
        $data = array (
            "sessao" => $sessao,
            "filme" => $filme,

        );

        //dd($sessoes);

        return view('sessao.controloSessao')->with($data);
        //->withSessao($sessao)
    }

    public function bilhete(Request $request)
    {
        $bilhete_id = $request->bilhete;
        $sessao_id = $request->id_sessao;
        $filme_id = $request->id_filme;
        
        
        $bilhete = Bilhete::findOrFail($bilhete_id);
        $filme = Filme::findOrFail($filme_id);
        $sessao = Sessao::findOrFail($sessao_id);

        $cliente_id = $bilhete->cliente_id;

        $cliente = Cliente::findOrFail($cliente_id);
        $user = User::findOrFail($cliente_id);

        $data = array (
            "sessao" => $sessao,
            "filme" => $filme,
            "bilhete" => $bilhete,
            "cliente" => $cliente,
            "user" => $user,

        );

        if($bilhete->sessao_id == $sessao_id)
        {
            return view('sessao.controloBilhete')->with($data);
        } else {
            return back()->with('error', 'O bilhete não é da sessão selecionada');
        }
        return back()->with('error', 'O bilhete não é da sessão selecionada');
        
    }


    public function list()
    {
        $sessoes = Sessao::paginate(25);


        return view('sessao.list')->withSessoes($sessoes);
    }
    public function create()
    {
     
            
        $sessao = new Sessao();
        return view('sessao.create')->withSessao($sessao);

    }
    public function store(SessaoPost $request)
    {
        $newSessao = Sessao::create($request->validated());
      
        return redirect()->route('sessoes.list')
            ->with('alert-msg', 'Sessao "' . $newSessao->id . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
    
    public function edit(Sessao $sessao)
    {
       
        return view('sessao.edit')
            ->withSessao($sessao);
            
    }
    
    public function update(SessaoPost $request, Sessao $sessao)
    {
        $sessao->fill($request->validated());
        $sessao->save();
        return redirect()->route('sessao.list')
            ->with('alert-msg', 'Sessao "' . $sessao->id . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Sessao $sessao)
     {
         $oldSessao = $sessao->id;
         try {
             $sessao->delete();
             return redirect()->route('sessao.list')
                 ->with('alert-msg', 'Sessao "' . $oldSessao . '" foi apagado com sucesso!')
                 ->with('alert-type', 'success');
         } catch (\Throwable $th) {
 
             if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                 return redirect()->route('sessao.list')
                     ->with('alert-msg', 'Não foi possível apagar o Sala "' . $oldSessao . '", porque este Sala já está em uso!')
                     ->with('alert-type', 'danger');
             } else {
                 return redirect()->route('sessao.list')
                     ->with('alert-msg', 'Não foi possível apagar o Sala "' . $oldSessao . '". Erro: ' . $th->errorInfo[2])
                     ->with('alert-type', 'danger');
             }
         }
     }

    
}

       
    