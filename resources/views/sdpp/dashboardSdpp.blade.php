@extends('layout.index')
@section('title', 'Dashboard Sintético')
@section('link', 'PROCESSO / DASHBOARD PROCESSOS')
@section('conteudo')
@include('layout.includes.mensagens')
<style>
  .progressbar li.active:before {
    background-color: #55b776;
    color: white;
  }

  .progressbar li.disabled:before {
    background-color: red;
    color: white;
  }

  .modal-diadata {
    width: 100%;
  }

  .modal-content {
    height: auto;
    min-height: 50%;
    border-radius: 0;
  }

  table.rTable {
    table-layout: auto;
    border-collapse: separate;
    border: 1px solid black;
  }

  td {
    word-wrap: break-word;
    font-size: 100%;
  }

  th {
    word-wrap: break-word;
    font-size: 100%;
  }
</style>
<div class="col-md-6">


  <div class="card-header">
    <h3 class="card-title">Valor Total Revertido</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

  <div class="card-header">
    <h3 class="card-title">Total de Processos Por Banco</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart2" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

  <div class="card-header">
    <h3 class="card-title">Reversão Com Saldo Pendente</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart3" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

</div>
<div class="col-md-6">

  <div class="card-header">
    <h3 class="card-title">Reversão Sem Saldo</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart4" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

  <div class="card-header">
    <h3 class="card-title">Documentos sem Resposta</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart5" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

  <div class="card-header">
    <h3 class="card-title">Reversões Finalizadas</h3>
  </div>
  <div class="card-body">
    <canvas id="donutChart6" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
  </div>

</div>
<!-- /.card -->
@endSection
@push('custom-scripts')
<link rel="stylesheet" href="{{ asset('bower_components/export_jquery/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/export_jquery/css/jquery.dataTables.min.css') }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{ asset('bower_components/export_jquery/jquery-3.3.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.flash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/jszip.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('bower_components/export_jquery/pdfmake.min.js') }}" type="text/javascript"></script> -->
<script src="{{ asset('bower_components/export_jquery/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/export_jquery/buttons.print.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ url('js/customizados/step_progress_bar.js') }}"></script> -->
<script>
  $(document).ready(function() {

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
<script>
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var ValorTotalrevertido = <?= $ValorTotalrevertido ?>;
  var bancos = [];
  var valores = [];
  $.each(ValorTotalrevertido, function(key, value) {
    //console.log(value.SIGLA + ": " + value.total);
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }

  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
  var TotalProcessosPorBanco = <?= $TotalProcessosPorBanco ?>;
  var bancos = [];
  var valores = [];
  $.each(TotalProcessosPorBanco, function(key, value) {
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  var donutChartCanvas = $('#donutChart3').get(0).getContext('2d')
  var ReversaoSaldoPendente = <?= $ReversaoSaldoPendente ?>;
  var bancos = [];
  var valores = [];
  $.each(ReversaoSaldoPendente, function(key, value) {
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  var donutChartCanvas = $('#donutChart4').get(0).getContext('2d')
  var ReversaoSemSaldo = <?= $ReversaoSemSaldo ?>;
  var bancos = [];
  var valores = [];
  $.each(ReversaoSemSaldo, function(key, value) {
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  var donutChartCanvas = $('#donutChart5').get(0).getContext('2d')
  var DocumentoSemResposta = <?= $DocumentoSemResposta ?>;
  var bancos = [];
  var valores = [];
  $.each(DocumentoSemResposta, function(key, value) {
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
<script>
  var donutChartCanvas = $('#donutChart6').get(0).getContext('2d')
  var ReversaoFinalizada = <?= $ReversaoFinalizada ?>;
  var bancos = [];
  var valores = [];
  $.each(ReversaoFinalizada, function(key, value) {
    bancos.push(value.SIGLA);
    valores.push(value.total);
  });
  var donutData = {
    labels: bancos,
    datasets: [{
      data: valores,
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }

  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
@endpush