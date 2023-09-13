@extends('layout.index')
@section('title', 'Retornar Processo')
@section('link', 'PROCESSO / RETORNAR')
@section('conteudo')
@include('layout.includes.mensagens')

<style>
    
    table.rTable{
        table-layout: auto;
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
    
</style>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Retorno de Processo à SDPP</h3>
                </div>
                <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" id="formAutorizarProcesso">
                    @csrf
                    <div class="form-group">
                        <label for="CPF" class="col-sm-2 col-md-offset-2 control-label">CPF</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" value="{{ $processo->pessoa->getCPFComMascara() }}" >
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
                            <input type="text" name="NOME" id="NOME" class="form-control" placeholder="NOME" value="{{ $processo->pessoa->NOME }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="VLREVERSAO" class="col-sm-2 col-md-offset-2 control-label">VALOR DA REVERSÃO</label>
                        <div class="col-sm-5">
                            <input type="text" name="VLREVERSAO" id="VLREVERSAO" class="form-control" placeholder="VLREVERSAO" value="{{ $processo->obterValorFormatado() }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="MESANOINICIO" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-INICIO</label>
                        <div class="col-sm-5">
                            <input type="text" id="MESANOINICIO" name="MESANOINICIO" class="form-control" placeholder="MESANOINICIO" value="{{ $processo->MES_ANO_INICIO }}">
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="MESANOFIM" class="col-sm-2 col-md-offset-2 control-label">MES/ANO-FINAL</label>
                        <div class="col-sm-5">
                            <input type="text" id="MESANOFIM" name="MESANOFIM" class="form-control" placeholder="MESANOFIM" value="{{ $processo->MES_ANO_FIM }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">BANCO</label>
                        <div class="col-sm-5">
                            <input type="text" name="BANCO" id="BANCO" class="form-control" placeholder="BANCO" value="{{ $processo->pessoa->banco->NOME }}" readonly>
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
                            <input type="text" name="DT_ENVIO_BANCO" id="DT_ENVIO_BANCO" class="form-control" placeholder="Data de Envio" value="{{ $processo->getDataFormatada() }}" readonly>
                        </div>
                    </div>
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
                                <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Download Ofício</label>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <a class="btn btn-small" href="{{route('processoUpag.downloadOficio', $processo->ID)}}">
                                            <i class="fa fa-download">
                                            </i>
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BANCO" class="col-sm-2 col-md-offset-2 control-label">Providência da unidade</label>
                                    <textarea type="text" class="col-sm-5 " name="TX_MENSAGEM_TEXTO" id="TX_MENSAGEM_TEXTO" class="form-control" title="Providência da unidade" required></textarea>
                            </div> 
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-xs-10 col-md-offset-1" >
                                  <div class="box">
                                    <div class="box-header">
                                      <h3 class="box-title"></h3>
                        
                                      <div class="box-tools">
                                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                          <input type="text" name="table_search" class="form-control pull-center" placeholder="Search">
                        
                                          <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                          </div>
                                        </div>
                                      </div>
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
                                </div>
                            </div>
                            <br>
                        <div class="box-footer">
                            <button title="Clique aqui para retornar o processo!" type="submit" class="btn btn-lg btn-primary pull-right">Retornar</button> {{-- se aceitar, colocar status "Enviado ao banco" --}}
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