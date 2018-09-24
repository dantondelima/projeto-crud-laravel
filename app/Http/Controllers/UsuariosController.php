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

    public function store(Request $request)
    {
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;
    
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->image->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
    
            // Faz o upload:
            $upload = $request->image->storeAs('categories', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
    
        }
    }

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
        $date = $request->get('data_nasc');
        $data = implode("-", array_reverse(explode("-", $date)));
        $users = new User(['nome'=>$request->get('nome'), 'email'=>$request->get('email'), 'data_nasc'=>$data, 'id_categoria'=>$request->get('id_categoria')]);
        $users->save();

        return view('usuarios.adicionado', compact('users'));
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
