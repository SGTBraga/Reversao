@extends('layout.index')
@section('conteudo')
@include('layout.includes.mensagens')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Cadastro de Usuários</h3>
    </div>
    <form role="form" method="POST">
        @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="CPF">CPF</label>
          <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" required value={{old('CPF')}}>
        </div>
        <div class="form-group">
          <label for="NOME">Nome</label>
          <input type="text" class="form-control" id="NOME" name="NOME" placeholder="NOME" required value={{old('NOME')}}>
        </div>
        <div class="form-group">
            <label for="NOME_GUERRA">Nome de Guerra</label>
            <input type="text" class="form-control" id="NOME_GUERRA" name="NOME_GUERRA" placeholder="NOME DE GUERRA" required value={{old('NOME_GUERRA')}}>
        </div>
        <div class="form-group">
            <label for="EMAIL">E-mail</label>
            <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="EMAIL" required value={{old('EMAIL')}}>
        </div>
        <div class="form-group">
            <label for="PERFIL">Perfil</label>
                <select class="form-control" name="PERFIL" id="PERFIL" required >
                    <option value="">SELECIONE UM PERFIL</option>
                    @foreach ($perfis as $perfil)
                    <option value="{{$perfil->ID}}">{{$perfil->SIGLA}}</option>
                    @endforeach
                </select>
        </div>    
        <div class="form-group">
            <label for="UNIDADE">Unidade</label>
                <select class="form-control" name="UNIDADE" id="UNIDADE"  required>
                    <option value="">SELECIONE UMA UNIDADE</option>
                    @foreach ($unidades as $unidade)
                    <option value="{{$unidade->ID}}">{{$unidade->SIGLA}}</option>
                    @endforeach
                </select>
        </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-lg btn-primary pull-right">Enviar</button>
      </div>
    </form>
@endsection
@push('custom-scripts')
<script>
  $('#CPF').inputmask('999.999.999-99');
</script> 
@endpush