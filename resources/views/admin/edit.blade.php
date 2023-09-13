@extends('layout.index')
@section('conteudo')
@include('layout.includes.mensagens')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edição de Usuários</h3>
    </div>
    <form role="form" method="POST">
        @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="CPF">CPF</label>
          <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="{{ $usuario->CPF }}"readonly>
        </div>
        <div class="form-group">
          <label for="NOME">Nome</label>
          <input type="text" class="form-control" id="NOME" name="NOME" placeholder="NOME" value="{{ $usuario->NOME }}" >
        </div>
        <div class="form-group">
            <label for="NOME_GUERRA">Nome de Guerra</label>
            <input type="text" class="form-control" id="NOME_GUERRA" name="NOME_GUERRA" placeholder="NOME DE GUERRA" value="{{ $usuario->NOME_GUERRA }}">
        </div>
        <div class="form-group">
            <label for="EMAIL">E-mail</label>
            <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="EMAIL" value="{{ $usuario->EMAIL }}" >
        </div>
        <div class="form-group">
          <label for="PERFIL">Perfil</label>
          <select class="form-control" name="PERFIL" id="PERFIL">
              @foreach ($perfis as $perfil)
              @if ($perfil->ID == $usuario->perfil->ID)
              <option value="{{$perfil->ID}}" selected>{{$perfil->SIGLA}}</option>
              @else
              <option value="{{$perfil->ID}}">{{$perfil->SIGLA}}</option>
              @endif
              @endforeach
          </select>
        </div> 
        <div class="form-group">
            <label for="UNIDADE">Unidade</label>
                <select class="form-control" name="UNIDADE" id="UNIDADE"  required>
                    @foreach ($unidades as $unidade)
                    @if ($unidade->ID == $usuario->unidade->ID)
                    <option value="{{$unidade->ID}}" selected>{{$unidade->SIGLA}}</option>
                    @else
                    <option value="{{$unidade->ID}}">{{$unidade->SIGLA}}</option>
                    @endif
                    @endforeach
                </select>
        </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-lg btn-primary pull-right">Atualizar</button>
      </div>
    </form>
@endsection