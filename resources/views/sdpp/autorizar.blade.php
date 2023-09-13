@extends('layout.index')
@section('title', 'Autorizar Processo')
@section('link', 'PROCESSO / AUTORIZAR')
@section('conteudo')
@include('layout.includes.mensagens')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Autorização de Processo</h3>
                  </div>
                <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" id="formAutorizarProcesso">
                    @csrf
                <div class="form-group">
                    <label for="CPF" class="col-sm-2 col-md-offset-2 control-label">CPF</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="{{ $processo->pessoa->getCPFComMascara() }}"readonly>
                    </div>
                </div>
                {{-- </br>
                </br>
                <div class="form-group">
                    <label for="NUP" class="col-sm-2 col-md-offset-2 control-label">NUP</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control" id="NUP" name="NUP" placeholder="Número do Protocolo SIGADAER" value="{{ $processo->NUP }}"readonly>
                    </div>
                </div> --}}

                <div class="form-group">
                    <label for="NOME" class="col-sm-2 col-md-offset-2 control-label">NOME</label>
                    <div class="col-sm-5">
                        <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME" value="{{ $processo->pessoa->NOME }}" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">VALOR DA REVERSÃO</label>
                    <div class="col-sm-5">
                        <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="VLREVERSAO" value="{{ $processo->VL_REVERSAO }}" readonly >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="MESANOINICIO" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-INICIO</label>
                    <div class="col-sm-5">
                        <input type="text" name="MESANOINICIO" id="MESANOINICIO" class="form-control" placeholder="MESANOINICIO" value="{{ $processo->MES_ANO_INICIO }}" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-FINAL</label>
                    <div class="col-sm-5">
                        <input type="text" name="MESANOFIM" id="MESANOFIM" class="form-control" placeholder="MESANOFIM" value="{{ $processo->MES_ANO_FIM }}" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">BANCO</label>
                    <div class="col-sm-5">
                        <input type="text" name="BANCO" id="BANCO" class="form-control" placeholder="BANCO" value="{{ $processo->pessoa->banco->NOME }}" readonly >
                    </div> 
                </div>      

                <div class="form-group">
                    <label for="AGENCIA" class="col-sm-2 col-md-offset-2 control-label">AGÊNCIA</label>
                    <div class="col-sm-5">
                        <input type="text" name="AGENCIA" id="AGENCIA" class="form-control" placeholder="AGENCIA" value="{{ $processo->pessoa->AGENCIA }}" readonly >
                    </div> 
                </div> 

                <div class="form-group">
                    <label for="CONTA" class="col-sm-2 col-md-offset-2 control-label">CONTA</label>
                    <div class="col-sm-5">
                        <input type="text" name="CONTA" id="CONTA" class="form-control" placeholder="CONTA" value="{{ $processo->pessoa->CONTA }}" readonly >
                    </div> 
                </div>

                <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">DATA DE ENVIO AO BANCO</label>
                <div class="input-group col-md-5 col-md-offset-2">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="DT_ENVIO_BANCO" id="DT_ENVIO_BANCO" class="form-control" placeholder="Data de Envio ao Banco"  value="{{ $processo->getDataFormatada() }}">
                    <span class="input-group-addon obrigatorio">*</span>
                </div>
                </br>
                </br>
                
                <br>
                     <div class="form-group">
                        <label for="OFICIO" class="col-sm-2 control-label col-md-offset-2">Upload Ofício <span class="obrigatorio_file">*</span></label>
                        <input type="file" name="OFICIO" id="OFICIO" accept="application/pdf" onchange="validatePDF(this)">
                    </div>
                <br>
                <br>
                <div class="form-group">
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Processo</label>
                    <a class="btn btn-small" href="{{route('processoUpag.downloadProcesso', $processo->ID)}}">
                        <i class="fa fa-download">
                        </i>
                    </a>       
                <br>
                </div>
                <div class="form-group">
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Providência da unidade</label>
                        <textarea type="text" class="col-sm-5 " name="TX_MENSAGEM_TEXTO" id="TX_MENSAGEM_TEXTO" class="form-control" title="Providência da unidade" required></textarea>
                        {{-- <SELECT class="form-control" name='TX_MENSAGEM'>
                                    @foreach($mensagens as $mensagem)
                                    <option value="{{$mensagem->ID}}">{{$mensagem->TX_MENSAGEM}}</option>
                                    @endforeach
                        </SELECT> --}}
                </div> 
                <div class="box-footer">
                    <button title="Clique aqui para devolver o processo!" name='botao' value='devolver' type="submit" onclick="removerRequired()" class="btn btn-lg btn-default">Devolver</button> {{-- se devolver, colocar status "devolvido" --}}
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