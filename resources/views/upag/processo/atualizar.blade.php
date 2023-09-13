@extends('layout.index')
@section('title', 'Detalhar Processo')
@section('link', 'PROCESSO / DETALHAR')
@section('conteudo')
@include('layout.includes.mensagens')
  
<style>
    .progressbar li.active:before{
        background-color: #55b776;
        color: white;
    }
    .progressbar li.disabled:before{
        background-color: red;
        color: white;
    }
    .modal-diadata {
        width: 50%;
    }
    .modal-content {
        height: auto;
        min-height: 50%;
        border-radius: 0;
    }
    table.rTable{
        table-layout: fixed;
        border-collapse: collapse;
        border: 1px solid black;  
    }
    td{
        word-wrap:normal;
        font-size: 80%;
    }
    th{
        word-wrap:break-word;
        font-size: 80%;
    }
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
    .left{
        text-align: left;
    }
    

</style>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhamento do Processo</h3>
                  </div>
                <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" id="formAutorizarProcesso">
                    @csrf
                <div class="form-group">
                    <label for="CPF" class="col-sm-2 col-md-offset-2 control-label">CPF</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="{{ $processo->pessoa->getCPFComMascara() }}"readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="NOME" class="col-sm-2 col-md-offset-2 control-label">NOME</label>
                    <div class="col-sm-5">
                        <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME" value="{{ $processo->pessoa->NOME }}" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">VALOR DA REVERSÃO</label>
                    <div class="col-sm-5">
                        <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="VLREVERSAO" value="{{ $processo->obterValorFormatado() }}" readonly >
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
                <div class="form-group">
                    <label for="DT_ENVIO_BANCO" class="col-sm-2 col-md-offset-2 control-label">DATA ENVIO BANCO</label>
                    <div class="col-sm-5">
                        <input type="text" name="DT_ENVIO_BANCO" id="DT_ENVIO_BANCO" class="form-control" placeholder="Data de envio ao banco" value="{{ $processo->getDataFormatada() }}" readonly >
                    </div>
                </div>

                <label for="VL_REVERTIDO" class="col-sm-2 col-md-offset-2 control-label">VALOR REVERTIDO</label>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="text" name="VL_REVERTIDO" id="VL_REVERTIDO" class="form-control" placeholder="Valor Revertido" value="{{ $processo->VL_REVERTIDO }}" readonly >
                    </div>
                </div>

                <label for="DT_DOC_RESPOSTA" class="col-sm-2 col-md-offset-2 control-label">DATA DO DOC DE RESPOSTA</label>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="text" name="DT_DOC_RESPOSTA" id="DT_DOC_RESPOSTA" class="form-control" placeholder="Data do Documento de Resposta" value="{{ $processo->DT_DOC_RESPOSTA }}" readonly >
                    </div>
                </div>

                <label for="NUM_RA_SIAFI" class="col-sm-2 col-md-offset-2 control-label">NÚMERO DA RA/SIAFI</label>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="text" name="NUM_RA_SIAFI" id="NUM_RA_SIAFI" class="form-control" placeholder="Número da RA/SIAFI" value="{{ $processo->NUM_RA_SIAFI }}" readonly >
                    </div>
                </div>

                <label for="TIPO_REVERSAO" class="col-sm-2 col-md-offset-2 control-label">Tipo de Reversão</label>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="text" name="TIPO_REVERSAO" id="TIPO_REVERSAO" class="form-control" placeholder="Tipo de Reversão" value="{{ isset($processo->TIPO_REVERSAO->SIGLA)?$processo->TIPO_REVERSAO->SIGLA:"" }}" readonly >
                    </div>
                </div>
                <br>
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
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label" >Download Processo</label>
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
                    <br>
                    </div>       
                </div>
                </div>
                <div class="form-group">
                    <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download da Resposta do Banco</label>
                    <div class="form-group">
                        <div class="col-sm-5">
                        <a class="btn btn-small" href="{{route('processoUpag.downloadResposta', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                    <br>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="MENSAGEM" class="col-sm-2 col-md-offset-2 control-label">Providência da unidade</label>
                        <textarea type="text" class="col-sm-5 " name="TX_MENSAGEM_TEXTO" id="TX_MENSAGEM_TEXTO" class="form-control" title="Providência da unidade" required></textarea>
                </div>
                <br> 
                <div class="row">
                    <div class="col-xs-10 col-md-offset-1" >
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

                    
                        <button id='botao_finalizar_upag' title="O processo será finalizado permanentemente!" name='botao' value='finalizar_upag' onclick="return confirm('Você deseja finalizar permanentemente o processo?')" type="submit" class="btn btn-lg btn-danger">Finalizar</button> 
                    
                        <button id='botao_atualizar' title="Clique aqui para atualizar o processo!" name='botao' value='atualizar' onclick="return confirm('Você deseja atualizar o processo?')" type="submit" class="btn btn-lg btn-success pull-right" >Atualizar</button> 
                    
                      <!-- /.box -->
                    </div>
                  </div>                  
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
    $("#VLREVERSAO").maskMoney({
                                    decimal: ",",
                                    thousands: "."
                                });
    $('#MESANOINICIO').inputmask('99/9999');
    $('#MESANOFIM').inputmask('99/9999');
</script> 
@endpush