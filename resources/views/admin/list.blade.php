@extends('layout.index')
@section('title', 'Todos os Usuários')
@section('link', 'USUÁRIO / LISTAR TODOS')
@section('conteudo')
@include('layout.includes.mensagens')
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>CPF</th>
      <th>Nome</th>
      <th>Nome de Guerra</th>
      <th>E-mail</th>
      <th>Perfil</th>
      <th>Unidade</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($listaDeUsuarios as $usuario)
          <tr>
            <td>{{$usuario->CPF}}</td>
            <td>{{$usuario->NOME}}</td>
            <td>{{$usuario->NOME_GUERRA}}</td>
            <td>{{$usuario->EMAIL}}</td>
            <td>{{$usuario->PERFIL->SIGLA}}</td>
            <td>{{$usuario->UNIDADE->SIGLA}}</td>
            <td>
            <a class="btn btn-small" href="{{route('admin.usuario.editUser', $usuario->ID)}}">
              <i class="fa fa-edit">
              </i>
            </a>
            </td>
            <td>
            <a class="btn btn-small" href="{{route('admin.usuario.deleteUser', $usuario->ID)}}">
              <i class="fa fa-trash">
              </i>
            </a>
            </td>
          </tr>
      @endforeach
  </table>

@endsection

