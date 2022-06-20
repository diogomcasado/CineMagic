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
use App\Models\Recibo;
use App\Services\Payment;
use PDF;

class CheckoutsController extends Controller
{

	
	public function index()
	{
		$recibos = Recibo::where('cliente_id', '=', Auth::user()->id)->paginate(15);
		$tipo_user = Auth::user()->tipo;
	
		// switch ($tipo_user) {
		// 	case 'C':
		// 		$recibos = Recibo::where('cliente_id', '=', Auth::user()->id);
		// 		break;
		// 	case 'F':
		// 		$recibos = Recibo::paginate(15);
		// 		break;
		// 	case 'A':
		// 		$recibos = Recibo::paginate(15);
		// 		break;
		// }
		
		return view('historico.list')->withRecibos($recibos);
	}

	public function store(Request $request)
	{

		$rules = [
			'nif' => 'required|digits:9',
			'endereco' => 'required|string',
			'tipo_pagamento' => ['required', Rule::in(['MC', 'PAYPAL', 'VISA'])],
			'ref_pagamento' => ['required', $request->tipo_pagamento == 'PAYPAL' ? 'email' : 'digits:16'],
			
		];

		$messages = [
			'nif.required' => 'Nif Obrigatório',
			'nif.digits' => 'O nif tem que ter 9 digitos',
			'endereco.required' => 'Endereço Obrigatório',
			'tipo_pagamento.required' => 'Tipo pagamento obrigatório',
			'tipo_pagamento.in' => 'Tipo de pagamento Invalido',
			'ref_pagamento.email'	=> 'Email da Ref.Pagamento Invalido',
			'ref_pagamento.digits' => 'Ref.Pagamento Invalida',
		];

		$input =  $request->validate($rules, $messages);
		$input['cliente_id'] = Auth::user()->cliente->id;
		$input['data'] = date('Y-m-d');

		$cart_items = Cart::content();
		$precos = Preco::all()->first();
		

		
	
		$recibo = Recibo::create($input);
		$newRecibo = Recibo::create($request->validated());
		

		if ($recibo) {
			Session::flash('success', "A encomenda #{$recibo->id} foi criada com sucesso!");
			Cart::destroy();
			Mail::to(Auth::user()->email)->send(new send_email_with_notification1($recibo));
			return redirect()->route('filmes.list');
		}
		return redirect()->back()->withErrors(['error', "Erro na compra!"]);
	}

	public function create()
	{
		return view('checkout.create');
	}


	public function update(Request $request, Recibo $recibo)
	{
		
		
			$pdf = PDF::loadView('pdf.pdf_view', compact('encomenda'));

			Storage::put('pdf_recibos/' . $recibo->id . '.pdf', $pdf->output());

			$recibo->recibo_pdf_url = $recibo->id . '.pdf';

			Mail::to(Auth::user()->email)->send(new NotificarFechada($encomenda));
	
		$pdf = PDF::loadView('pdf.pdf_recibo');

		Storage::put('pdf_recibos/' . $recibo->id . '.pdf', $pdf->output());

		$recibo->recibo_pdf_url = $recibo->id . '.pdf';

		$recibo->save();

		return redirect()->back()->with(['success', "A compra #{$recibo->id} foi atualizada com sucesso!"]);
	}

	public function pdf_recibo(Recibo $recibo)
	{

		
		return view('pdf.pdf_recibo');

}public function pdf_bilhete(Recibo $recibo)
{

	
	return view('pdf.pdf_bilhete');

}
}