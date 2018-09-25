<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class UsuariosController extends Controller
{

    public function lista() {
        $pessoal = User::select('users.id', 'nome', 'email', 'data_nasc', 'categoria', 'img')->join('categorias', 'categorias.id', '=', 'id_categoria')->get();
        return view('usuarios.listagem', compact('pessoal'));
    }

    public function novo() {
        $categoria = Categoria::all();
        return view('usuarios.form',  compact('categoria'));
    }
    
    public function adicionado(Request $request, User $user) 
    {
        $user->criarUsuario($request->all(), $request->file('imagem'));

        return back()->with('msg', 'Usuário '.$request->input('nome').' cadastrado com sucesso');
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
