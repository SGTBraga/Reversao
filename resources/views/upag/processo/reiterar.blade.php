@extends('layout.index')
@section('title', 'Reiterar Processo')
@section('link', 'PROCESSO / REITERAR')
@section('conteudo')
@include('layout.includes.mensagens')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Reiteração de Processo</h3>
                </div>
                <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" id="formAutorizarProcesso">
                    @csrf
                    <div class="form-group">
                        <label for="CPF" class="col-sm-2 col-md-offset-2 control-label">CPF</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="{{ $processo->pessoa->getCPFComMascara() }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    {{-- <div class="form-group">
                        <label for="NUP" class="col-sm-2 col-md-offset-2 control-label">NUP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="NUP" name="NUP" placeholder="Número do Protocolo SIGADAER" value="{{ $processo->NUP }}" readonly>
                        </div>
                    </div> --}}
                    </br>
                    </br>
                    <div class="form-group">
                        <label for="NOME" class="col-sm-2 col-md-offset-2 control-label">NOME</label>
                        <div class="col-sm-5">
                            <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME" value="{{ $processo->pessoa->NOME }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="form-group">
                        <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">VALOR DA REVERSÃO</label>
                        <div class="col-sm-5">
                            <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="VLREVERSAO" value="{{ $processo->VL_REVERSAO }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="form-group">
                        <label for="MESANOINICIO" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-INICIO</label>
                        <div class="col-sm-5">
                            <input type="text" name="MESANOINICIO" id="MESANOINICIO" class="form-control" placeholder="MESANOINICIO" value="{{ $processo->MES_ANO_INICIO }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="form-group">
                        <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-FINAL</label>
                        <div class="col-sm-5">
                            <input type="text" name="MESANOFIM" id="MESANOFIM" class="form-control" placeholder="MESANOFIM" value="{{ $processo->MES_ANO_FIM }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">BANCO</label>
                        <div class="col-sm-5">
                            <input type="text" name="BANCO" id="BANCO" class="form-control" placeholder="BANCO" value="{{ $processo->pessoa->banco->NOME }}" readonly>
                        </div>
                    </div>
                    </br>
                    </br>
                    <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">DATA DE NOVO ENVIO AO BANCO</label>
                    <div class="input-group col-md-5 col-md-offset-2">

                        <input type="text" name="DT_ENVIO_BANCO" id="DT_ENVIO_BANCO" class="form-control" placeholder="DATA DE ENVIO AO BANCO" title="DATA DE ENVIO AO BANCO" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value={{old('DT_ENVIO_BANCO')}} required>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    </br>

                    <br>
                    <div class="form-group">
                        <label for="OFICIO_REITERACAO" class="col-sm-2 control-label col-md-offset-2">Upload Novo Ofício <span class="obrigatorio_file">*</span></label>
                        <input type="file" name="OFICIO_REITERACAO" id="OFICIO_REITERACAO" accept="application/pdf" onchange="validatePDF(this)">
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Processo</label>
                        <a class="btn btn-small" href="{{route('processoUpag.downloadProcesso', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                    </div>
                    <br>
                    <div class="box-footer">
                        <button type="reset" class="btn btn-lg btn-default">Limpar</button> {{-- se rejeitar, colocar status "Rejeitado" --}}
                        <button title="Clique aqui quando for enviar o processo ao banco!" type="submit" class="btn btn-lg btn-primary pull-right">Atualizar</button> {{-- se aceitar, colocar status "Enviado ao banco" --}}
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
    // $('#NUP').inputmask('99999.999999/9999-99');
    $('#CPF').inputmask('999.999.999-99');
    $("#VL_REVERTIDO").maskMoney({
        decimal: ",",
        thousands: "."
    });
    $('#MESANOINICIO').inputmask('99/9999');
    $('#MESANOFIM').inputmask('99/9999');
</script>
@endpush