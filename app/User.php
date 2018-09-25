<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FileService;

class User extends Model
{
    use FileService;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nome', 'email', 'data_nasc', 'id_categoria', 'img', 'thumb',
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function criarUsuario($dados, $imagem)
    {
        $dados['img'] = $this->uploadFile($imagem, '/users', true);
        return $this->create($dados);
    }

}

/*
$pessoa->nome=$request->nome;
        $pessoa->email=$request->email;
        $pessoa->id_categoria=$request->id_categoria;
        $pessoa->data_nasc=$request->data_nasc;
        */
