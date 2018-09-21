<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categoria;

class UsuariosController extends Controller
{
    public function lista() {
        $pessoal = User::select('users.id', 'nome', 'email', 'categoria')->join('categorias', 'categorias.id', '=', 'id_categoria')->get();
        return view('usuarios.listagem', compact('pessoal'));
    }

    public function mostra() {
        $id = Request::route('id');
        $pessoa = User::find($id);
        return view('usuarios.detalhes', compact('pessoa'));
    }

    public function novo() {
        $categoria = Categoria::all();
        return view('usuarios.form',  compact('categoria'));
    }

    public function adicionado(Request $request) {

        $users = new User(['nome'=>$request->get('nome'), 'email'=>$request->get('email'), 'id_categoria'=>$request->get('id_categoria')]);
        $users->save();

        return view('usuarios.adicionado', compact('users'));
    }


    public function alter($id) {
        $pessoal = User::find($id);
        return view('usuarios.alterar', compact('pessoal'));
    }

    public function altera(Request $request, $id) {
        try{
            $pessoa = User::find($id);
            $pessoa->nome=$request->nome;
            $pessoa->email=$request->email;
            $pessoa->save();
        }
        catch(Exception $ex)
        {
            return dd($ex);
        }
        return view('usuarios.alterado');
    }

    public function excluir(Request $request, $id){
        $pessoa = User::find($id);
        $pessoa->delete();
        return view('usuarios.excluido');
    }
}
