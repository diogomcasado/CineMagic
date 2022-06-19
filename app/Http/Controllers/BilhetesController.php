<?php

namespace App\Http\Controllers;

use Redirect;
use App\Models\User;
use App\Mail\NotificarAnulada;
use App\Mail\NotificarFechada;
use App\Mail\NotificarPaga;
use App\Mail\NotificarPendente;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Bilhete;


class BilhetesController extends Controller
{

	
	public function list()
	{
		$bilhetes = Bilhete::where('cliente_id', '=', Auth::user()->id)->paginate(15);
		$tipo_user = Auth::user()->tipo;
	
		
		
		return view('historico.listB')->withBilhetes($bilhetes);
	}

	public function valida_bilhete(Request $request)
	{
		$user = User::findOrFail(Auth::id());

		if($user->tipo == 'F'){

			$bilhete_id = $request->id_bilhete;
		
			$sessao = $request->id_sessao;
			//dd($sessao);

			DB::update('update bilhetes set estado = ? where id = ?',["usado",$bilhete_id]);

			$bilhete = Bilhete::findOrFail($bilhete_id);

			//dd($sessao);


			return redirect()->route('controlo.sessao', ['sessao' => $sessao])->with('message', 'Bilhete validado');
		}

		else{
			return abort(403, 'Unauthorized action.');
		}
	}


}
