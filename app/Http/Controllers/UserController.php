<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $cliente = Cliente::findOrFail(Auth::id());
        if($user->tipo == 'F'){
            return abort(403, 'Unauthorized action.');
        }

        #$full = $user->concat($cliente);


        return view('user.profile', compact('user', 'cliente'));
    }

    public function list()
    {
        $users = User::paginate(25);

        return view('user.list', compact('users'));
    }

    public function bloquear(User $user)
    {

        $user->bloqueado = $user->bloqueado == '1' ? '0' : '1';
        $user->save();

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        if ($user->tipo == 'C') {
            $user->cliente->delete();
        }
        $user->delete();

        return redirect()->route('user.list');
    }


    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:99|min:1',
            'nif' => 'required|numeric|between:100000000,999999999',
            'email' => 'email:rfc,dns',
            'photo' => 'image',
            
        ],
        [
        'name.required'  => 'Nome obrigatório',
        'name.max'       => 'Nome deve ter no maximo 99 carateres',
        'name.min'       => 'Nome no minimo 1 carater',
        'nif.required'  => 'NIF obrigatório',
        'nif.between'   => 'NIF inválido',
        'nif.numric'    => 'NIF inválido',
        ]
        );

        $name =     $request->input('name');
        $email =    $request->input('email');
        $photo =    $request->input('photo');
        $nif =      $request->input('nif');
        $tipo_pagamento = $request->input('tipo_pagamento');
        $ref_pagamento = $request->input('ref_pagamento');

        $data = array(
            "name"      => $name,
            "email"     => $email,
            "nif"       => $nif,
            "tipo_pagamento" => $tipo_pagamento,
            "ref_pagamento" => $ref_pagamento
        );

        if(!empty($request->photo)){
            Storage::delete('storage/fotos/' . $request->file('foto_url'));
            $path = $request->file('foto_url')->store('storage/fotos');
            $path = str_replace('storage/fotos/', '', $path);
            DB::table('users')
                ->where('id', $id)
                ->update(['foto_url' => $path]);
        }

        if(!empty($request->input('password'))){
            $password = Hash::make($request->input('password'));
            $data["password"] = $password;
        }
    
        $cliente = Cliente::find(Auth::id());
        if ($cliente) {
            $cliente->update($request->except('_token', '_method'));
        } else {
            $user = User::findOrFail($id);
            $user->update($request->except('_token', '_method'));
        }

        session()->flash('success', 'Valores editados com sucesso!');

        return redirect('/profile');
    
    }


}
