<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filme;
use App\Models\Sessao;
use Carbon\Carbon;
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

        dd($filmesListFinal);

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
}
