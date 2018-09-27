<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class CategoriasController extends Controller
{
    public function lista() {
        $categorias = Categoria::orderBy('id', 'desc')->get();
        return view('categorias.listagem', compact('categorias'));
    }

    public function nova() {
        return view('categorias.form-categoria');
    }

    public function adicionadaCategoria(Request $request) {
        $categorias = Categoria::orderBy('id', 'desc')->get();
        $categorias = new Categoria(['categoria'=>$request->get('categoria'),]);
        /*if($categorias == $categorias->categoria)
        {
            return back()->with($errors, 'Categoria já cadastrada');
        }
        else{}*/
        $categorias->save();
        return back()->with('msg', 'Categoria cadastrada com sucesso');
        
    }

    public function alter($id) {
        $categorias = Categoria::find($id);
        return view('categorias.alterar', compact('categorias'));
    }

    public function altera(Request $request, $id) {
        $categorias = Categoria::findOrFail($id);
        $categorias->categoria = $request->categoria;
        $categorias->save();
        return redirect('/categorias')->with('msg', 'Categoria alterada com sucesso');
    }

    public function excluir(Request $request, $id){
        $categoria = Categoria::find($id);
        
        if ($categoria->usuarios->isNotEmpty()) {
            dd('laskdfjlas');
        }

        $categoria->delete();
        return redirect('/categorias')->with('msg', 'Categoria excluida com sucesso');
    }

    public function validacao(Request $request){
        $this->validate($request, [
            'categoria' => 'required|max:255|unique:categorias,categoria',
        ], ['categoria.required'=> 'O campo categoria deve ser preenchido', 'categoria.unique'=> 'A categoria já existe']);
    }
}
