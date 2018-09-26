@extends('principal')
@section('conteudo')
   <table class="table">
     @foreach($categorias as $cat)
        <tr>
          <td>Categoria: {{$cat->categoria}} </td>
          <td>
           <a href="{{ route('categorias.alterar', $cat->id)}}">Alterar</a>
          </td>
          <td>
            <a href="{{ route('categorias.excluir', $cat->id)}}">Excluir</a>
          </td>
        </tr>
     @endforeach
    </table>
    @if(session('msg'))
      <div class="alert alert-success">
          <p>{{session('msg')}}</p>
      </div>
    @endif
@stop