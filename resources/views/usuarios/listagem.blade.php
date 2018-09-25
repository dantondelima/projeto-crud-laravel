@extends('principal')
@section('conteudo')
   <table class="table">
     @foreach($pessoal as $p)
        <tr>
          <td style="border: 1px solid black">Nome:  {{$p->nome}} </td>
          <td style="border: 1px solid black">email: {{$p->email}} </td>
          <td style="border: 1px solid black">Data de nascimento: {{$p->data_nasc}} </td>
          <td style="border: 1px solid black">categoria: {{$p->categoria}}</td>
          <td style="border: 1px solid black">Foto: <img src="{{ $p->thumb}}"></td>
          <td style="border: 1px solid black">
            <a href="{{ route('usuarios.alterar', $p->id)}}">Alterar</a>
          </td>
          <td style="border: 1px solid black">
            <a href="{{ route('usuarios.excluir', $p->id)}}">Excluir</a>
          </td>
          
        </tr>
     @endforeach
    </table>
@stop