<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filme;
use App\Models\Sessao;
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

    
}

       
    