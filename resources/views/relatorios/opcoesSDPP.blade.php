@extends('layout.index')
@section('title', 'Relatório Analítico')
@section('link', 'PROCESSO / Relatório Analítico')
@section('conteudo')
@include('layout.includes.mensagens')
@push('style')
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">

@endpush
<form class="form-horizontal" role="form" action="" method="post" id="relatorioForm">
    {{ csrf_field()}}
    <div class="form-group">
        <div class='col-md-offset-3 col-md-6'>
            <label>Informe o mês e o ano:</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="mesAno" name="mesAno" class="form-control" data-inputmask="'alias': 'mm/yyyy'" data-mask="" onkeypress="doNothing()">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Relatórios</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#" onclick="showReport('analiticoUnidade')"><i class="fa fa-users text-light-blue"></i> ANALITICO POR UNIDADE</a></li>
                    </ul>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#" onclick="showReport('analiticoBanco')"><i class="fa fa-users text-light-blue"></i> ANALITICO POR BANCO</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
  </form>
@endSection

@push('custom-scripts')
<script>

    function showReport(relatorio) {
                            var mesAno = $("#mesAno").val();
                            if (mesAno == "") {
                                alert("O mês/ano é de preenchimento obrigatório!");
                                return;
                            }
                            switch (relatorio) {
                                case "analiticoUnidade":
                                    var url = '{{ route("relatorios.analiticoSdppPorUnidade",":mesAno")}}';
                                    break;
                            }
                            switch (relatorio) {
                                case "analiticoBanco":
                                    var url = '{{ route("relatorios.analiticoSdppPorBanco",":mesAno")}}';
                                    break;
                            }
                            url = url.replace(':mesAno', 'mesAno=' + mesAno);
                            window.open(url, '_blank');
                        }

    function doNothing() {  
        var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            if( keyCode == 13 ) {


            if(!e) var e = window.event;

            e.cancelBubble = true;
            e.returnValue = false;

            if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
            }
        } 
    }

</script>
@endpush