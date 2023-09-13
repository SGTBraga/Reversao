@extends('layout.index')
@section('title', 'Analisar Processo')
@section('link', 'PROCESSO / ANALISAR')
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
                            <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="\{{ $processo->pessoa->getCPFComMascara() }}" readonly>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="NUP" class="col-sm-2 col-md-offset-2 control-label">NUP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="NUP" name="NUP" placeholder="Número do Protocolo SIGADAER" value="{{ $processo->NUP }}" readonly>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="NOME" class="col-sm-2 col-md-offset-2 control-label">NOME</label>
                        <div class="col-sm-5">
                            <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME" value="{{ $processo->pessoa->NOME }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">VALOR DA REVERSÃO</label>
                        <div class="col-sm-5">
                            <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="VLREVERSAO" value="{{ $processo->VL_REVERSAO }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="MESANOINICIO" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-INICIO</label>
                        <div class="col-sm-5">
                            <input type="text" name="MESANOINICIO" id="MESANOINICIO" class="form-control" placeholder="MESANOINICIO" value="{{ $processo->MES_ANO_INICIO }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-FINAL</label>
                        <div class="col-sm-5">
                            <input type="text" name="MESANOFIM" id="MESANOFIM" class="form-control" placeholder="MESANOFIM" value="{{ $processo->MES_ANO_FIM }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">BANCO</label>
                        <div class="col-sm-5">
                            <input type="text" name="BANCO" id="BANCO" class="form-control" placeholder="BANCO" value="{{ $processo->pessoa->banco->NOME }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="DT_ENVIO_BANCO" class="col-sm-2 col-md-offset-2 control-label">DATA ENVIO BANCO</label>
                        <div class="col-sm-5">
                        <input type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="DT_ENVIO_BANCO" id="DT_ENVIO_BANCO" class="form-control" placeholder="Data de Envio ao Banco"  value="{{ $processo->getDataFormatada() }}">
                        </div>
                    </div>

                    <label for="VL_REVERTIDO" class="col-sm-2 col-md-offset-2 control-label">VALOR REVERTIDO</label>
                    <div class="input-group col-md-5 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="VL_REVERTIDO" id="VL_REVERTIDO" class="form-control" placeholder="Valor Revertido" title="Valor Revertido" required>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <label for="DT_DOC_RESPOSTA" class="col-sm-2 col-md-offset-2 control-label">DATA DO DOC DE RESPOSTA</label>
                    <div class="input-group col-md-5 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="date" name="DT_DOC_RESPOSTA" id="DT_DOC_RESPOSTA" class="form-control" placeholder="DATA DO DOC DE RESPOSTA" title="DATA DO DOC DE RESPOSTA" value={{old('DT_DOC_RESPOSTA')}} required>
                    </div>
                    </br>
                    <label for="NUM_RA_SIAFI" class="col-sm-2 col-md-offset-2 control-label">NÚMERO DA RA/SIAFI</label>
                    <div class="input-group col-md-5 col-md-offset-2">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <input type="text" name="NUM_RA_SIAFI" id="NUM_RA_SIAFI" class="form-control" placeholder="NÚMERO DA RA/SIAFI" title="NÚMERO DA RA/SIAFI" value={{old('NUM_RA_SIAFI')}}>
                        <span class="input-group-addon obrigatorio">*</span>
                    </div>
                    </br>
                    <div class="form-group" id="divT_TIPO_REVERSAO_ID">
                        <div class="radio">
                            <label for="T_TIPO_REVERSAO_ID" class="col-sm-2 control-label col-md-offset-2"><b>Tipo de Reversão</b></label>
                            <label id="radioTipoReversao">
                                <input type="radio" name="T_TIPO_REVERSAO_ID" value="1" id="radio_total" required> TOTAL
                            </label>
                            <label>
                                <input type="radio" name="T_TIPO_REVERSAO_ID" value="2" id="radio_parcial" required> PARCIAL
                            </label>
                            <label>
                                <input type="radio" name="T_TIPO_REVERSAO_ID" value="3" id="radio_sem_saldo" required> SEM SALDO
                            </label>
                            <span class="obrigatorio">*</span>
                        </div>
                    </div>
                    </br>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Ofício</label>
                            <a class="btn btn-small" href="{{route('processoUpag.downloadOficio', $processo->ID)}}">
                                <i class="fa fa-download">
                                </i>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Processo</label>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <a class="btn btn-small" href="{{route('processoUpag.downloadProcesso', $processo->ID)}}">
                                    <i class="fa fa-download">
                                    </i>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Óbito</label>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <a class="btn btn-small" href="{{route('processoUpag.downloadObito', $processo->ID)}}">
                                        <i class="fa fa-download">
                                        </i>
                                    </a>
                                </div>
                            </div>
                            <br>
                    <div class="form-group">
                                <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Contracheque</label>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <a class="btn btn-small" href="{{route('processoUpag.downloadContracheque', $processo->ID)}}">
                                            <i class="fa fa-download">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                                    <label for="RESPOSTA_BANCO" class="col-sm-2 col-md-offset-2 control-label">Documento de Resposta do Banco <span class="obrigatorio_file">*</span></label>
                                    <input type="file" class="col-sm-5" name="RESPOSTA_BANCO" id="RESPOSTA_BANCO"  accept="application/pdf" onchange="validatePDF(this)">
                         <br>   
                         <br>    
                    </div>
                    <div class="form-group">
                        <label for="MENSAGEM" class="col-sm-2 col-md-offset-2 control-label">Providência da unidade</label>
                            <textarea type="text" class="col-sm-5 " name="TX_MENSAGEM_TEXTO" id="TX_MENSAGEM_TEXTO" class="form-control" title="Providência da unidade" required></textarea>
                    </div>
                    <br> 
                    <div class="row">
                        <div class="col-xs-10 col-sm-offset-1" >
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title">Log do Processo</h3>
                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                                <tr>
                                  <th>ID</th>
                                  <th>Mensagem de Retorno</th>
                                  <th>Data de Criação</th>
                                </tr>
                                @foreach ($processo->mensagem_texto as $log)
                                <tr>
                                    <td>{{$log->ID}}</td>
                                    <td>{{$log->TX_MENSAGEM}}</td>
                                    <td>{{$log->CREATED_AT}}</td>
                                </tr>
                                @endforeach
                              </table>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        <br>
                        <button id='botao_finalizar' title="O processo será enviado à UPAG para providências!" name='botao' value='finalizar' type="submit" onclick="removerRequired()" class="btn btn-lg btn-default">Devolver</button> {{-- se devolver, colocar status "devolvido" --}}
                        <button id='botao_concluir' title="Clique aqui para terminar o processo!" name='botao' value='concluir' type="submit" class="btn btn-lg btn-primary pull-right">Concluir</button> {{-- se aceitar, colocar status "Enviado ao banco" --}}
                    </div>  
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
    $(document).ready(function() {
        $('#formAutorizarProcesso').change(function() {
            selected_value = $("input[name='T_TIPO_REVERSAO_ID']:checked").val();
            //alert(selected_value);
            if (selected_value =='2' || selected_value =='3'){
                $('#botao_finalizar').prop('disabled', false);
                $('#botao_concluir').prop('disabled', true);
                $('#botao_concluir').prop('title', 'Processo não pode ser concluído com SALDO PENDENTE!');
            }if (selected_value =='1'){
                $('#botao_concluir').prop('disabled', false);
                $('#botao_finalizar').prop('disabled', true);
                $('#botao_concluir').prop('title', 'Clique aqui para terminar o processo!');
            }
        });
    });


    function removerRequired() {
        $('#VL_REVERTIDO').removeAttr('required');
        $('#DT_DOC_RESPOSTA').removeAttr('required');
        $('#NUM_RA_SIAFI').removeAttr('required');
        $('#radio_total').removeAttr('required');
        $('#radio_parcial').removeAttr('required');
        $('#radio_sem_saldo').removeAttr('required');
    }
    $('[data-mask]').inputmask();
    // $('#NUP').inputmask('99999.999999/9999-99');
    $('#CPF').inputmask('999.999.999-99');
    $("#VLREVERSAO").maskMoney({
        decimal: ",",
        thousands: "."
    });
    $("#VL_REVERTIDO").maskMoney({
        decimal: ",",
        thousands: "."
    });
    $('#MESANOINICIO').inputmask('99/9999');
    $('#MESANOFIM').inputmask('99/9999');
</script>
@endpush