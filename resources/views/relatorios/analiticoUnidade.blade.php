{{-- {{ csrf_field()}}
<style>
    #table1 {
        border-collapse: separate;
        border-spacing: 15px 0px;
    }
    .myDiv {
        text-align: center;
    }
</style>

    <table id="table1">
        <tr>
            <td colspan="8" align="center">
                <img src='{{asset('images/dom_sefa.png')}}' width="65px" align="left">

                <img src='{{asset('images/simboloFab.png')}}' width='90px'>

                <img src='{{asset('images/dom_DIRAD.png')}}' width='70px' align="right">
            </td>
        </tr>
        <tr>
            <td colspan="8">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>COMANDO DA AERONÁUTICA</b></td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>SECRETARIA DE ECONOMIA, FINANÇAS E ADMINISTRAÇÃO DA AERONÁUTICA</b></td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>DIRETORIA DE ADMINISTRAÇÃO DA AERONÁUTICA</b></td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>SUBDIRETORIA DE PAGAMENTO DE PESSOAL</b></td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>RELAÇÃO DO EFETIVO PAGO</b></td>
        </tr>
        <tr>
            <td colspan="8" align=center><b>PAGAMENTO DE {{$mes}} DE {{$ano}}</b></td>
        </tr>
        <tr>
            <td colspan="8">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="8">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td align="center"><b>CPF</b></td>
            <td align="center"><b>Nome</b></td>
            <td align="center"><b>Unidade</b></td>
            <td align="center"><b>Banco</b></td>
            <td align="center"><b>Data de Criação</b></td>
            <td align="center"><b>Data de Envio ao Banco</b></td>
            <td align="center"><b>Valor Da Reversão</b></td>
            <td align="center"><b>Valor Revertido</b></td>
            <td align="center"><b>Número RA SIAFI</b></td>
        </tr>
        <tr>
        @foreach($listaDeProcessos as $processo)
            <td>{{$processo->pessoa->getCPFComMascara()}}</td>
            <td>{{$processo->pessoa->NOME}}</td>
            <td>{{$processo->unidade->SIGLA}}</td>
            <td align="center">{{$processo->pessoa->banco->NOME}}</td>
            <td align="center">{{$processo->getDataCriacaoFormatada('CREATED_AT')}}</td>
            <td align="center">{{$processo->getDataFormatada('DT_ENVIO_BANCO')}}</td>
            <td>R$ {{$processo->obterValorFormatadoParaRelatorio('VL_REVERSAO')}}</td>
            <td>R$ {{$processo->obterValorFormatadoParaRelatorio('VL_REVERTIDO')}}</td>
            <td align="center">{{$processo->NUM_RA_SIAFI}}</td>
        <br>
        </tr>
        @endforeach
    </table>

    {{-- <div class="myDiv" colspan="8">
        $soma = {{$processo::sum('VL_REVERSAO')}}
        <tr><h3>Valor Total de Reversão: R$ {{ $this->$soma }}</h3></tr>
    </div> --}}
    <form method="POST">
        {{ csrf_field() }}
        <style>
            #table1 {
                border-collapse: separate;
                border-spacing: 15px 0px;
            }
    
            .myDiv {
                text-align: center;
            }
        </style>
    
        <table id="table1">
            <tr>
                <td colspan="8" align="center">
                    <img src="{{ asset('images/dom_sefa.png') }}" width="65px" align="left">
    
                    <img src="{{ asset('images/simboloFab.png') }}" width="90px">
    
                    <img src="{{ asset('images/dom_DIRAD.png') }}" width="70px" align="right">
                </td>
            </tr>
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>COMANDO DA AERONÁUTICA</b></td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>SECRETARIA DE ECONOMIA, FINANÇAS E ADMINISTRAÇÃO DA AERONÁUTICA</b></td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>DIRETORIA DE ADMINISTRAÇÃO DA AERONÁUTICA</b></td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>SUBDIRETORIA DE PAGAMENTO DE PESSOAL</b></td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>RELAÇÃO DO EFETIVO PAGO</b></td>
            </tr>
            <tr>
                <td colspan="8" align=center><b>PAGAMENTO DE {{$mes}} DE {{$ano}}</b></td>
            </tr>
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
                <td align="center\"><b>CPF</b></td>
                <td align="center\"><b>Nome</b></td>
                <td align="center\"><b>Unidade</b></td>
                <td align="center\"><b>Banco</b></td>
                <td align="center\"><b>Data de Criação</b></td>
                <td align="center\"><b>Data de Envio ao Banco</b></td>
                <td align="center\"><b>Valor Da Reversão</b></td>
                <td align="center\"><b>Valor Revertido</b></td>
                <td align="center\"><b>Número RA SIAFI</b></td>
            </tr>
            @foreach($listaDeProcessos as $processo)
                <tr>
                    <td>{{$processo->pessoa->getCPFComMascara()}}</td>
                    <td>{{$processo->pessoa->NOME}}</td>
                    <td>{{$processo->unidade->SIGLA}}</td>
                    <td align="center">{{$processo->pessoa->banco->NOME}}</td>
                    <td align="center">{{$processo->getDataCriacaoFormatada('CREATED_AT')}}</td>
                    <td align="center">{{$processo->getDataFormatada('DT_ENVIO_BANCO')}}</td>
                    <td>R$ {{$processo->obterValorFormatadoParaRelatorio('VL_REVERSAO')}}</td>
                    <td>R$ {{$processo->obterValorFormatadoParaRelatorio('VL_REVERTIDO')}}</td>
                    <td align="center">{{$processo->NUM_RA_SIAFI}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" class="myDiv">
                    <h3>Valor Total de Reversão: R$ {{ $listaDeProcessos->sum('VL_REVERSAO') }}</h3>
                </td>
            </tr>
        </table>
    </form>