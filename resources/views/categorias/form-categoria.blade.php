@extends('principal')
@section('conteudo')

<div class="container">
      <h2>Cadastro de categoria</h2><br/>
      <form  action="/categorias/adiciona-categoria">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Nome">Categoria:</label>
            <input type="text" class="form-control" name="categoria">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Adicionar</button>
          </div>
        </div>
    @if(session('msg'))
      <div class="alert alert-success">
          <p>{{session('msg')}}</p>
      </div>
    @endif
@stop