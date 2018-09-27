@extends('principal')
@section('conteudo')
   <table class="table table-bordered text-justify">
        <thead class="thead-dark" class="text-center">
          <th class="text-center">Nome</th>
          <th class="text-center">email</th>
          <th class="text-center">Data de nascimento</th>
          <th class="text-center">categoria</th>
          <th class="text-center">Foto</th>
          <th colspan="2" class="text-center">Ação</a>
          </th>
        </thead>
        @foreach($pessoal as $p)
        <tr>
            <td class="text-center align-middle">{{$p->nome}} </td>
            <td class="text-center align-middle">{{$p->email}} </td>
            <td class="text-center align-middle">{{ date('d/m/Y', strtotime($p->data_nasc)) }} </td>
            <td class="text-center align-middle">{{$p->categoria}}</td>
            <td class="text-center align-middle"><img src="{{ $p->thumb}}"></td>
            <td class="text-center align-middle">
              <a href="{{ route('usuarios.alterar', $p->id)}}" class="badge badge-warning">Alterar</a>
            </td>
            <td class="text-center align-middle">
              <a href="{{ route('usuarios.excluir', $p->id)}}" class="badge badge-danger">Excluir</a>
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