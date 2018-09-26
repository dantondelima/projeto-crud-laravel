<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categoria;
use App\Http\Controllers\ImageRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\enviarEmail;

class UsuariosController extends Controller
{
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
        $this->validacao($request);

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
        Mail::send('emails.email', [], function($message){
            $message->to('danton.lima@kbrtec.com.br');
            $message->subject('Assunto do email');
            $message->from('smtp@kbrtec.com.br');
        });

        return back()->with('mensagem', 'Usuário cadastrado com sucesso');
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
        return back()->with('msg', 'Usuário alterado com sucesso');
    }

    public function excluir(Request $request, $id){
        $pessoa = User::findOrFail($id);
        $pessoa->delete();
        return back()->with('msg', 'excluido com sucesso');
    }

    public function validacao(Request $request){
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required|max:255',
            'data_nasc' => 'required',
            'imagem' => 'required'
        ], ['nome.required'=> 'O campo nome deve ser preenchido', 'email.required'=> 'O campo email deve ser preenchido', 'data_nasc.required'=> 'O campo data de nascimento deve ser preenchido','imagem.required'=> 'O campo imagem deve ser preenchido']);
    }
}
