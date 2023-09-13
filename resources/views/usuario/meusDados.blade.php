@extends('layout.index')
@section('title', 'Usuário')
@section('link', 'USUÁRIO / MEUS DADOS')
@section('conteudo')
<style>
    .label_group {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    }
</style>
<div id="sucesso">

</div>
<div id="erro">

</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box-body">
            @include('layout.includes.mensagens')
            <div class="callout callout-success" style="display: none" id="message-email-sucesso">
                <h4><i class="fa fa-check"></i> Sucesso</h4>
                <p></p>
            </div>
            <div class="callout callout-danger"  style="display: none" id="message-email-erro">
                <h4><i class="fa fa-close"></i> Erro</h4>
                <p></p>
            </div>
            <div class="callout callout-success" style="display: none" id="message-senha-sucesso">
                <h4><i class="fa fa-check"></i> Sucesso</h4>
                <p></p>
            </div>
            <div class="callout callout-danger"  style="display: none" id="message-senha-erro">
                <h4><i class="fa fa-close"></i> Erro</h4>
                <p></p>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados do Usuário</h3>
                </div>
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="CPF" class="col-sm-2 control-label col-md-offset-1">CPF</label>
                            <div class="col-sm-6">
                                <input type="CPF" class="form-control" id="CPF" placeholder="CPF" value="{{$usuario->getCPFComMascara()}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nome" class="col-sm-2 control-label col-md-offset-1">Nome: </label>
                            <div class="col-sm-6">
                                <input type="nome" class="form-control" id="nome" placeholder="Nome" value="{{ $usuario->NOME }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nome_guerra" class="col-sm-2 control-label col-md-offset-1">Nome de Guerra: </label>
                            <div class="col-sm-6"> 
                                <input type="nome_guerra" class="form-control" id="nome_guerra" placeholder="Nome de Guerra" value="{{ $usuario->NOME_GUERRA }}" readonly>
                            </div>
                        </div>
                        <div class="input-group col-md-8 col-md-offset-2">
                            <!-- /btn-group -->
                            <span class="input-group-addon label_group"><b>Email:</b> &nbsp;&nbsp;</span>
                            <input type="email" class="form-control" id="email"  placeholder="Email"  value="{{ $usuario->EMAIL }}" readonly>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-email"><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <br>
                        <div class="input-group col-md-8 col-md-offset-2">
                            <!-- /btn-group -->
                            <span class="input-group-addon label_group"><b>Senha:</b>&nbsp;</span>
                            <input type="password" class="form-control" id="senha"  placeholder="Senha" readonly>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-senha"><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="unidade" class="col-sm-2 control-label col-md-offset-1">Unidade: </label>
                            <div class="col-sm-6"> 
                                <input type="unidade" class="form-control" id="unidade" placeholder="Unidade" value="{{ $usuario->unidade->SIGLA }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="perfil" class="col-sm-2 control-label col-md-offset-1">Perfil: </label>
                            <div class="col-sm-6"> 
                                <input type="perfil" class="form-control" id="perfil" placeholder="Perfil" value="{{ $usuario->perfil->SIGLA }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-email">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="#" method="POST" id="formAlterarEmail">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="Email Atual" class="col-sm-2 control-label col-md-offset-1">Email Atual: </label>
                                            <div class="col-sm-6"> 
                                                <input class="form-control" id="emailAtual" value="{{ $usuario->EMAIL }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Novo Email" class="col-sm-2 control-label col-md-offset-1">Novo Email: </label>
                                            <div class="col-sm-6"> 
                                                <input type="email" name="novoEmail"  id="novoEmail" class="form-control" placeholder="Novo Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="limparCamposEmail()">Fechar</button>
                                        <button type="submit" class="btn btn-primary"> Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                    <div class="modal fade" id="modal-senha">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="#" method="POST" id="formAlterarSenha">
                                    <input type="hidden" name="id" value ="{{ $usuario->ID }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="senhaAntiga" class="col-sm-4 control-label col-md-offset-1">Senha Antiga: </label>
                                            <div class="col-sm-6"> 
                                                <input name="senhaAntiga" type="password" class="form-control" id="senhaAntiga" placeholder="Senha Antiga" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="novaSenha" class="col-sm-4 control-label col-md-offset-1">Nova Senha: </label>
                                            <div class="col-sm-6"> 
                                                <input name="novaSenha"  type="password" class="form-control" id="novaSenha" placeholder="Nova Senha" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="novaSenhaOutraVez" class="col-sm-4 control-label col-md-offset-1">Nova Senha (outra vez): </label>
                                            <div class="col-sm-6"> 
                                                <input name="novaSenhaOutraVez"  type="password" class="form-control" id="novaSenhaOutraVez" placeholder="Nova Senha (outra vez)" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="limparCamposSenha()">Fechar</button>
                                        <button type="submit" class="btn btn-primary"> Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function limparCamposSenha() {
        $("#novaSenha").val("");
        $("#novaSenhaOutraVez").val("");
        $("#senhaAntiga").val("");
        $('#message-email-erro').hide();
        $('#message-email-sucesso').hide();
    }

    function limparCamposEmail() {
        $("#emailAtual").val($("#email").val());
        $("#novoEmail").val("");
        $('#message-senha-erro').hide();
        $('#message-senha-sucesso').hide();


    }

    $(document).ready(function () {
        $('#formAlterarSenha').submit(function (event) {
            $('#message-senha-erro').hide();
            $('#message-senha-sucesso').hide();
            event.preventDefault();
            usuario = {
                id: $("input[name='id']").val(),
                novaSenha: $("#novaSenha").val(),
                novaSenhaOutraVez: $("#novaSenhaOutraVez").val(),
                senhaAntiga: $("#senhaAntiga").val()
            };
            $.post("/reversao/public/usuario/alterarSenha", usuario, function (data) {
            }).done(function (data) {
                console.log(data);
                $("#message-senha-sucesso>p").html("Senha alterada!");
                $('#message-senha-sucesso').show();
            }).fail(function (error) {
                console.log(error);
                $('#message-senha-sucesso').hide();
                var erro = error.responseJSON.message;
                $('#message-senha-erro>p').html(erro);
                $('#message-senha-erro').show();
            }).always(function () {
                $('#modal-senha').modal('toggle');
                limparCamposSenha();
            });
        });


        $('#formAlterarEmail').submit(function (event) {
            $('#message-email-erro').hide();
            $('#message-email-sucesso').hide();
            event.preventDefault();
            usuario = {
                id: $("input[name='id']").val(),
                novoEmail: $("#novoEmail").val(),
            };
            $.post("/reversao/public/usuario/alterarEmail", usuario, function () {
            }).done(function () {
                $("#message-email-sucesso>p").html("Email alterado!");
                $('#message-email-sucesso').show();
                $("#email").val($("#novoEmail").val());
            }).fail(function (error) {
                $('#message-senha-sucesso').hide();
                var erro = error.responseJSON.message;
                $('#message-email-erro>p').html(erro);
                $('#message-email-erro').show();
            }).always(function () {
                $('#modal-email').modal('toggle');
                limparCamposEmail();
            });
        });

    });

</script>
@endpush

