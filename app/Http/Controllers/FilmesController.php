<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmesController extends Controller
{
    public function index(Request $request)
    {
        $filmes = Filme::whereNull('custom');

        if ($request->inputsearch) {

            //$categorias_id = [];

            //$categorias = Categoria::where('nome', 'like', '%' . $request->inputsearch . '%')->get('id');
            //foreach ($categorias as $categoria) {
            //    array_push($categorias_id, strval($categoria->id));
            //}

            //$filmes->where('nome', 'like', '%' . $request->inputsearch . '%')
            //    ->orWhere('descricao', 'like', '%' . $request->inputsearch . '%')
            //    ->orWhereIn('categoria_id', $categorias_id);
        }

        if ($request->categoria_id != null) {
        //    $filmes->where('categoria_id', '=', $request->categoria_id);
        }

        $filmes = $filmes->paginate(12);


        $privada = false;
        //$cores = Cor::all();
        //$categorias = Categoria::all();
        $request->flash();
        return view('filme.list'); //, compact('xx', 'xx', 'xx', 'categorias'));
    }


}
