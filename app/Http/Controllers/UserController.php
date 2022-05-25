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

    public function edit9999()
    {
        $id = Auth::id();
        $cliente = Cliente::find($id);
        if ($cliente) {
            return view('user.profile', compact('cliente'));
        } else {
            $user = User::findOrFail($id);
            return view('user.profile', compact('user'));
        }
    }

    public function edit(Request $request)
    {
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

        return redirect('/profile');
    
    }


}
