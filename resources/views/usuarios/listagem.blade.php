@extends('principal')
@section('conteudo')
   <table class="table">
     @foreach($pessoal as $p)
        <tr>
          <td>Nome:  {{$p->nome}} </td>
          <td>email: {{$p->email}} </td>
          <td>categoria: {{$p->categoria}}</td>
          <td>
            <a href="{{ route('usuarios.alterar', $p->id)}}">Alterar</a>
          </td>
          <td>
            <a href="{{ route('usuarios.excluir', $p->id)}}">Excluir</a>
          </td>
          
        </tr>
     @endforeach
    </table>
@stop