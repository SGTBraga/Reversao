@extends('layout.index')
@section('title', 'Processos Filtrados')
@section('link', 'PROCESSO / LISTAR PROCESSOS REITERADOS')
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
    

</style>
            <table class="rTable" id="processAll">
                <thead>
                    <tr>   
                        <td>ID</td>
                        <td>CPF</td>
                        <td>NOME</td>
                        {{-- <td>PROCESSO</td> --}}
                        <td>DATA RESPOSTA</td>
                        <td>VALOR REVERSÃO</td>
                        <td>BANCO</td>
                        <td>UNIDADE</td>
                        <td>PROCESSO</td>
                        <td>OFÍCIO</td>
                        <td>ÓBITO</td>
                        <td>CC</td>
                        <td>STATUS</td>
                        <td>ANALISAR</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listaProcessos as $processo)
                    <tr>
                        <th>{{ $processo->ID }}</th>
                        <th>{{ $processo->pessoa->getCPFComMascara() }}</th>
                        <th>{{ $processo->pessoa->NOME }}</th>
                        {{-- <th>{{ $processo->NUP }}</th> --}}
                        <th>{{ $processo->DT_DOC_RESPOSTA }}</th>
                        <th>{{ $processo->VL_REVERSAO }}</th>
                        <th>{{ $processo->pessoa->banco->SIGLA }}</th>
                        <th>{{ $processo->unidade->SIGLA}}</th>
                        <th><a class="btn btn-small" href="{{route('processoUpag.downloadProcesso', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                        </th>
                        <th>
                        <a class="btn btn-small" href="{{route('processoUpag.downloadOficio', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                        </th>
                        <th>
                        <a class="btn btn-small" href="{{route('processoUpag.downloadObito', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                        </th>
                        <th>
                        <a class="btn btn-small" href="{{route('processoUpag.downloadContracheque', $processo->ID)}}">
                            <i class="fa fa-download">
                            </i>
                        </a>
                        </th>
                        <th>{{ $processo->status->SIGLA}}</th>
                        <th>
                            <a class="btn btn-small" href="{{route('processoSdpp.mostraProcessoParaAnalise', $processo->ID)}}">
                                <i class="fa fa-check-circle-o">
                                </i>
                            </a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
<div class="modal fade" id="step_progress_bar">
    <div class="modal-diadata">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="progressbar" id="progressbar">
                </ul>
                <br><br><br><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div> 
@endSection
@push('custom-scripts')
<link rel="stylesheet" href="{{ asset('bower_components/export_jquery/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/export_jquery/css/jquery.dataTables.min.css') }}">

<script src="{{ asset('bower_components/export_jquery/jquery-3.3.1.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/jquery.dataTables.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/dataTables.buttons.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.flash.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/jszip.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/pdfmake.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/vfs_fonts.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.html5.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.print.min.js') }}"  type="text/javascript"></script>
<script src="{{ url('js/customizados/step_progress_bar.js') }}"></script>
<script>
                        $(document).ready(function () {

                        $('#processAll').DataTable({
                        "language": {
                        "url": "/reversao/public/bower_components/datatables.net/Portuguese-Brasil.json"
                        },
                                dom: 'Bfrtip',
                                buttons: [
                                        'copy', 'csv', 'excel', 'print'
                                ]
                        });
                        });
</script>
@endpush
