<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class CategoriasController extends Controller
{
    public function lista() {
        $categorias = Categoria::all();
        return view('categorias.listagem', compact('categorias'));
        
    }

    public function nova() {
        return view('categorias.form-categoria');
    }

    public function adicionadaCategoria(Request $request) {
        $categorias = new Categoria(['categoria'=>$request->get('categoria'),]);
        $categorias->save();
        return view('categorias.adicionado', compact('categorias'));
    }

    public function alter($id) {
        $categorias = Categoria::find($id);
        return view('categorias.alterar', compact('categorias'));
    }

    public function altera(Request $request, $id) {
        $categorias = Categoria::findOrFail($id);
        $categorias->categoria=$request->categoria;
        $categorias->save();
        return view('categorias.alterado');
    }

    public function excluir(Request $request, $id){
        $categoria = Categoria::find($id);
        
        if ($categoria->usuarios->isNotEmpty()) {
            dd('laskdfjlas');
        }

        $categoria->delete();
        return view('categorias.excluido');
    }
}
