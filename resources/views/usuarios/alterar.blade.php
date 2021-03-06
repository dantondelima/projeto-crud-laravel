@extends('principal')
@section('conteudo')

<div class="container">
      <h2>Alteração de registro</h2><br/>
      <form  action="{{ route('usuarios.alterando', $pessoal->id)}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Nome">Nome:</label>
            <input type="text" class="form-control" name="nome" value="{{$pessoal->nome}}">
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Email">Email:</label>
              <input type="text" class="form-control" name="email" value="{{$pessoal->email}}">
            </div>
          </div>
        <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Email">Categoria:</label>
              <select name="id_categoria">
              @foreach($categoria as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
              @endforeach
              </select>
            </div>
          </div>
          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Data">Data:</label>
              <input type="date" class="form-control" name="data_nasc" value="{{$pessoal->data_nasc}}">
            </div>
          </div>
          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <input type="file" name="imagem"> 
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Alterar</button>
          </div>
        </div>
      @if(session('msg'))
        <div class="alert alert-success">
          <p>{{session('msg')}}</p>
        </div>
      @endif
@stop