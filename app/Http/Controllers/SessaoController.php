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

    public function get_sessao(Request $request)
    {
        if (!$request->filme) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $sessoes = Sessao::where('filme_id', $request->filme_id)->get();
            foreach ($sessoes as $sessao) {
                $html .= '<option value="'.$sessao->id.'">'.$sessao->name.'</option>';
            }
        }
    
        return response()->json(['html' => $html]);
    }


    public function list()
    {
        $sessoes = Sessao::paginate(25);


        return view('sessao.list')->withSessoes($sessoes);;
    }
    public function create()
    {
     
            
        $sessao = new Sessao();
        return view('sessao.create')->withSessao($sessao);

    }
    public function store(SessaoPost $request)
    {
        $newSessao = Sessao::create($request->validated());
        $sessao->save();
        return redirect()->route('sessoes')
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
        return redirect()->route('sessoes.list')
            ->with('alert-msg', 'Sessao "' . $sessao->id . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

   
}
