<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriasController extends Controller
{
    public function nova() {
        return view('categorias.form-categoria');
    }

    public function adicionadaCategoria(Request $request) {
        $categorias = new Categoria(['categoria'=>$request->get('categoria'),]);
        $categorias->save();
        return view('categorias.adicionado', compact('categorias'));
    }
}
