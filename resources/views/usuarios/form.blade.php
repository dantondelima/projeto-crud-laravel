@extends('principal')
@section('conteudo')
<style>
  .lista{
    color: red;
  }
</style>
<div class="container">
      <h2 class="text-center">Cadastro de pessoa</h2><br/>
      <form method="post" action="{{ route('usuarios.notifica-novo') }}" enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Nome">Nome:</label>
            <input type="text" class="form-control" maxlength="255" name="nome" value="{{ old('nome') }}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Email">Email:</label>
              <input type="text" class="form-control" maxlength="255" name="email" value="{{ old('email') }}">
            </div>
          </div>
          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Data">Data:</label>
              <input type="date" class="form-control" name="data_nasc" value="{{ old('data_nasc')}}">
            </div>
          </div>
          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Categoria">Categoria:</label>
              <select name="id_categoria">
              @foreach($categoria as $categoria)
                <option class="form-control" @if(old('categoria')==$categoria->id) {{'selected="selected"'}} @endif value="{{ $categoria->id }}"> {{$categoria->categoria}}</option>
              @endforeach
              </select>
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <input type="file" name="imagem" value="{{ old('imagem') }}>
         </div>

        </div>
        <div class="row">
        <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Adicionar</button>
          </div>
        </div>
        </div>
    </form>    
    @if( isset($errors) && count($errors) != 0)
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          <p>{{$error}}</p>
        @endforeach
      </div>
    @elseif(session('mensagem'))
    <div class="alert alert-success">
          <p>{{session('mensagem')}}</p>
      </div>
    @endif

   </div>

@stop