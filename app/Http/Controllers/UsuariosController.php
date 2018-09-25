<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Categoria;
use App\Http\Controllers\ImageRepository;
use App\FileService;
use File;

class UsuariosController extends Controller
{
    use FileService;
    public function lista() {
        $pessoal = User::select('users.id', 'nome', 'email', 'data_nasc', 'categoria', 'thumb')->join('categorias', 'categorias.id', '=', 'id_categoria')->orderBy('users.id', 'desc')->get();
        return view('usuarios.listagem', compact('pessoal'));
    }

    public function novo() {
        $categoria = Categoria::all();
        return view('usuarios.form',  compact('categoria'));
    }
    
    public function adicionado(Request $request, ImageRepository $repo, User $users) 
    {
        if ($request->hasFile('imagem')) {
            $userImagem = $repo->saveImage($request->imagem);
        }
        
        if ($request->hasFile('imagem')) {
            $userImagemThum = $repo->saveImageThumbnail($request->imagem, 150);
        }

        $users->nome = $request->get('nome');
        $users->email = $request->get('email');
        $users->data_nasc = $request->get('data_nasc'); 
        $users->img = $userImagem;
        $users->thumb = $userImagemThum;
        $users->id_categoria = $request->get('id_categoria');
        $users->save();
        return back()->with('msg', 'Usuário '.$request->input('nome').' cadastrado com sucesso');
    }

    public function alter($id) {
        $pessoal = User::findOrFail($id);
        $categoria = Categoria::all();
        return view('usuarios.alterar', compact('pessoal', 'categoria'));
    }

    public function altera(Request $request, $id, ImageRepository $repo) {
        $users = User::findOrFail($id);
        $users->nome = $request->get('nome');
        $users->email = $request->get('email');
        $users->data_nasc = $request->get('data_nasc'); 
        if(!is_null($request->imagem))
        {
            $repo->apagarImages($users->img, $users->thumb);
            $userImagem = $repo->saveImage($request->imagem);
            $users->img = $userImagem;
            $userImagemThum = $repo->saveImageThumbnail($request->imagem, 150);
            $users->thumb = $userImagemThum;
        }
        else {
            dd($userImagem);
        }
        
        

        $users->id_categoria = $request->get('id_categoria');
        $users->save();
        return view('usuarios.alterado');
    }

    public function excluir(Request $request, $id){
        $pessoa = User::findOrFail($id);
        $pessoa->delete();
        return back()->with('msg', 'cadastrado com sucesso');
    }
}
