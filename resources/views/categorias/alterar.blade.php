@extends('principal')
@section('conteudo')

<div class="container">
      <h2>Alteração de registro</h2><br/>
      <form  action="{{ route('categorias.alterando', $categorias->id)}}" method="post">
      @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Nome">Nome:</label>
            <input type="text" class="form-control" name="categoria" value="{{$categorias->categoria}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Alterar</button>
          </div>
        </div>
    
@stop