@extends('principal')
@section('conteudo')
   <table class="table table-bordered">
     @foreach($pessoal as $p)
        <tr>
          <td>Nome:  {{$p->nome}} </td>
          <td>email: {{$p->email}} </td>
          <td>Data de nascimento: {{ date('d/m/Y', strtotime($p->data_nasc)) }} </td>
          <td>categoria: {{$p->categoria}}</td>
          <td>Foto: <img src="{{ $p->thumb}}"></td>
          <td>
            <a href="{{ route('usuarios.alterar', $p->id)}}">Alterar</a>
          </td>
          <td>
            <a href="{{ route('usuarios.excluir', $p->id)}}">Excluir</a>
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