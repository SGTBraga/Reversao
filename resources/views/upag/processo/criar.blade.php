@extends('layout.index')
@section('title', 'Criar Processo')
@section('link', 'PROCESSO / CRIAR')
@section('conteudo')
<style>
    .none {
        display:none;
    }
    .obrigatorio {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
        color: red;
    }
    .obrigatorio_file{
        color:red;
        font-weight: normal;
    }
</style>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!--<h3 class="box-title">Novo</h3>-->

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('layout.includes.mensagens')
                <div class="callout callout-danger none" id='error'>
                    <h4><i class="fa fa-close"></i> Erro</h4>
                    <p></p>
                </div>
                <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" id="formInserirProcesso">
                    @csrf
                    <input type='hidden' name='UNIDADE' id='UNIDADE' value='{{Auth::user()->unidade->ID}}'>
                    {{-- <label for="NUP" class="col-sm-2 col-md-offset-2 control-label">Protocolo SIGADAER</label>
                    <div class="input-group col-md-6 col-md-offset-3">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="NUP" id="NUP" class="form-control" placeholder="Número do Protocolo SIGADAER" title="Número do Protocolo SIGADAER" value={{old('NUP')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div> --}}
                    </br>
                    <label for="CPF" class="col-sm-2 col-md-offset-2 control-label">CPF do Servidor</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="CPF" id="CPF" class="form-control" placeholder="CPF do Servidor" title="CPF do Servidor" value={{old('CPF')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="NOME" class="col-sm-2 col-md-offset-2 control-label">Nome do Servidor</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME do Servidor" title="NOME do Servidor" value={{old('NOME')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">Valor Reversão</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="Valor Reversão" title="Valor Reversão" value={{old('VLREVERSAO')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="MESANOINICIO" class="col-sm-2 col-md-offset-2 control-label">Mês Ano Inicio</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="MESANOINICIO" name="MESANOINICIO" class="form-control" >
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>    
                    </br> 
                    <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">Mês Ano Final</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="MESANOFIM" name="MESANOFIM" class="form-control" >
                        <span class="input-group-addon obrigatorio">*</span>
                    </div> 
                    <br>  
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Banco</label>
                    <div class="input-group col-md-6 col-md-offset-3">
                        <select class="form-control" name="BANCO" id="BANCO"  >
                            <option value="">SELECIONE UM BANCO</option>
                            @foreach ($bancos as $banco)
                            <option value="{{$banco->ID}}">{{$banco->NOME}}</option>
                            @endforeach
                        </select>
                    </div> 
                    </br>
                    <label for="AGENCIA" class="col-sm-2 col-md-offset-2 control-label">Agência</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="AGENCIA" id="AGENCIA" class="form-control" placeholder="Agência" title="Agência" value={{old('AGENCIA')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="CONTA" class="col-sm-2 col-md-offset-2 control-label">Conta</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="CONTA" id="CONTA" class="form-control" placeholder="Conta" title="Conta" value={{old('CONTA')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="DT_FALECIMENTO" class="col-sm-2 col-md-offset-2 control-label">Data do Motivo</label>
                    <div class="input-group col-md-6 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="DT_FALECIMENTO" id="DT_FALECIMENTO" class="form-control" placeholder="Data de Falecimento ou Fato Gerador" title="Data de Falecimento" value={{old('DT_FALECIMENTO')}}>

                    </div>
                    <br>
                    <label for="TIPO_PESSOA" class="col-sm-2 col-md-offset-2 control-label">Tipo de Solicitante</label>
                    <div class="input-group col-md-6 col-md-offset-3">
                        <select class="form-control" name="TIPO_PESSOA" id="TIPO_PESSOA"  >
                            <option value="">SELECIONE O TIPO DE SOLICITANTE</option>
                            @foreach ($tipo_pessoas as $tipo_pessoa)
                            <option value="{{$tipo_pessoa->ID}}">{{$tipo_pessoa->TIPO_PESSOA}}</option>
                            @endforeach
                        </select>
                    </div>         
                    <br>  
                    <label for="MOTIVO_REVERSAO" class="col-sm-2 col-md-offset-2 control-label">Motivo de Reversão</label>
                    <div class="input-group col-md-6 col-md-offset-3">
                        <select class="form-control" name="MOTIVO_REVERSAO" id="MOTIVO_REVERSAO"  >
                            <option value="">SELECIONE O TIPO DE REVERSÃO</option>
                            @foreach ($motivo_reversoes as $motivo_reversao)
                            <option value="{{$motivo_reversao->ID}}">{{$motivo_reversao->MOTIVO_REVERSAO}}</option>
                            @endforeach
                        </select>
                    </div>               
                    <br>    

                    <br>
                    <div class="form-group">
                        <label for="REQUERIMENTO" class="col-sm-2 control-label col-md-offset-2">Documento da Reversão</span></label>
                        <input type="file" name="REQUERIMENTO" id="REQUERIMENTO"  accept="application/pdf" onchange="validatePDF(this)">
                    </div>
                    <div class="form-group">
                        <label for="CONTRACHEQUE" class="col-sm-2 control-label col-md-offset-2">Upload de Contracheque <span class="obrigatorio_file">*</span></label>
                        <input type="file" name="CONTRACHEQUE" id="CONTRACHEQUE"  accept="application/pdf" onchange="validatePDF(this)">
                    </div>
                    <div class="form-group">
                        <label for="OBITO" class="col-sm-2 control-label col-md-offset-2">Upload do documento de Óbito/Judicial <span class="obrigatorio_file">*</span></label>
                        <input type="file" name="OBITO" id="OBITO"  accept="application/pdf" onchange="validatePDF(this)">
                    </div>
                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Detalhamento da Memória de Cálculo por Mês:<span class="obrigatorio_file">*</label> 
                            <textarea type="text" class="col-sm-5" rows="5" name="TX_MENSAGEM_TEXTO" id="TX_MENSAGEM_TEXTO" class="form-control" title="Detalhamento de Memoria"  placeholder="Valor da Reversão por Mês:&#10;R$: XXX,XX (JAN/2022); R$: XXX,XX (FEV/2022)&#10;..." required></textarea>
                    </div>
                    <br>
                    <div class="box-footer">
                        <button type="reset" class="btn btn-lg btn-default">Limpar</button>
                        <button type="submit" class="btn btn-lg btn-primary pull-right">Enviar</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    $('[data-mask]').inputmask();
    $('#NUP').inputmask('99999.999999/9999-99');
    $('#CPF').inputmask('999.999.999-99');
    $("#VLREVERSAO").maskMoney({
        decimal: ",",
        thousands: "."
    });
    $('#MESANOINICIO').inputmask('mm/yyyy');
    $('#MESANOFIM').inputmask('mm/yyyy');
    $('#DT_FALECIMENTO').inputmask('dd/mm/yyyy', {placeholder: "dd/mm/aaaa"});
</script> 
@endpush