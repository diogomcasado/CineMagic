<?php

namespace App\Http\Controllers;


use App\Mail\NotificarAnulada;
use App\Mail\NotificarFechada;
use App\Mail\NotificarPaga;
use App\Mail\NotificarPendente;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
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


}
