<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\ImageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class UsuariosController extends Controller
{

    public function lista() {
        $pessoal = User::select('users.id', 'nome', 'email', 'categoria')->join('categorias', 'categorias.id', '=', 'id_categoria')->get();
        return view('usuarios.listagem', compact('pessoal'));
    }

    /*public function mostra() {
        $id = Request::route('id');
        $pessoa = User::find($id);
        return view('usuarios.detalhes', compact('pessoa'));
    }*/

    public function novo() {
        $categoria = Categoria::all();
        return view('usuarios.form',  compact('categoria'));
    }

    public function adicionado(Request $request) {
        dd($request);
        $users = new User(['nome'=>$request->get('nome'), 'email'=>$request->get('email'), 'data_nasc'=>$request->get('data_nasc'), 'id_categoria'=>$request->get('id_categoria')]);
        $users->save();

        return view('usuarios.adicionado', compact('users'));
    }

    public function store(Request $request, ImageRepository $repo)
    {
        $pessoa = User::create($request->except('imagem'));
        
        if ($request->hasFile('imagem')) {
        $product->path_image = $repo->saveImage($request->primaryImage, $pessoa->nome_img, 'users', 250);
        }

    }

    public function alter($id) {
        $pessoal = User::findOrFail($id);
        $categoria = Categoria::all();
        return view('usuarios.alterar', compact('pessoal', 'categoria'));
    }

    public function altera(Request $request, $id) {
        $pessoa = User::findOrFail($id);
        $pessoa->nome=$request->nome;
        $pessoa->email=$request->email;
        $pessoa->save();
        return view('usuarios.alterado');
    }

    public function excluir(Request $request, $id){
        $pessoa = User::findOrFail($id);
        $pessoa->delete();
        return view('usuarios.excluido');
    }
}
