<?php

namespace App\Models;

use App\Http\Requests\ValidarInclusao;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arquivo;
use App\Models\Mensagem_Texto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Processo extends Model {

    protected $table = "T_PROCESSO";
    protected $primaryKey = 'ID';

    public function getDataFormatada($request) { //RETORNA A DATA NO FORMATO dd/mm/YYYY
        return Carbon::parse($this->$request)->format('d/m/Y');
        //echo date('d/m/Y', $request);
        //echo $request;
    }

    public function getDataCriacaoFormatada() { //RETORNA A DATA NO FORMATO dd/mm/YYYY
        return Carbon::parse($this->CREATED_AT)->format('d/m/Y');
    }

    public function arquivo() {
        return $this->hasMany('App\Models\Arquivo', 'T_ARQUIVO_ID');
    }

    public function banco() {
        return $this->belongsTo('App\Models\Banco', 'T_BANCO_ID');
    }

    public function unidade() {
        return $this->belongsTo('App\Models\Unidade', 'T_UNIDADE_ID');
    }

    public function rejeitado() {
        return $this->hasMany('App\Models\Rejeitado', 'T_REJEITADO_ID');
    }

    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa', 'T_PESSOA_ID');
    }

    public function log_processo() {
        return $this->hasMany('App\Models\Log_Processo', 'T_LOG_PROCESSO_ID');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status', 'T_STATUS_ID');
    }

    public function tipo_reversao() {
        return $this->belongsTo('App\Models\Tipo_Reversao', 'T_TIPO_REVERSAO_ID');
    }

    public function motivo_reversao() {
        return $this->belongsTo('App\Models\Motivo_Reversao', 'T_MOTIVO_REVERSAO_ID');
    }

    public function mensagem_texto() {
        return $this->hasMany('App\Models\Mensagem_Texto', 'ID_PROCESSO');
    }

    public function formatarValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public function obterValorFormatado() {
        $valor = str_replace(".", ",", $this->VL_REVERSAO);
        return $valor;
    }

    public function obterValorFormatadoParaRelatorio($request) {
        $valor = number_format($this->$request, 2, ',', '.');
        return $valor;
    }

    public function obterValoTotalFormatadoParaRelatorio($processo) {
        // $valor = str_replace(".", ",", $this->VL_REVERSAO);
         $soma = $processo::sum($this->VL_REVERSAO);
         $valor = number_format($this->$soma, 2, ',', '.');
         return $valor;
     }

    public function incluirProcesso(ValidarInclusao $request, Arquivo $modelArquivo, Mensagem_Texto $mensagem_Texto) {
        //$pessoa = Pessoa::firstOrNew(['CPF'=>$request->CPF]);
        $pessoa = new Pessoa();
        $pessoa->CPF = $pessoa->removeMascaraCPF($request->CPF);
        $pessoa->NOME = $request->NOME;
        $pessoa->T_TIPO_PESSOA_ID = $request->TIPO_PESSOA;
        $pessoa->T_BANCO_ID = $request->BANCO;
        $pessoa->AGENCIA = $request->AGENCIA;
        $pessoa->CONTA = $request->CONTA;
        $pessoa->DT_FALECIMENTO = Carbon::createFromFormat('d/m/Y', $request->DT_FALECIMENTO)->toDateString();
        $pessoa->save();

        $processo = new Processo();
        $processo->VL_REVERSAO = $this->formatarValor($request->VLREVERSAO);
        $processo->MES_ANO_INICIO = $request->MESANOINICIO;
        $processo->MES_ANO_FIM = $request->MESANOFIM;
        $processo->T_STATUS_ID = '1';
        $processo->T_MOTIVO_REVERSAO_ID = $request->MOTIVO_REVERSAO;
        $processo->T_UNIDADE_ID = $request->UNIDADE;
        $processo->T_PESSOA_ID = $pessoa->ID;
        $processo->ST_PROCESSO_EXCLUIDO = 'N';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
            $modelArquivo->upload("REQUERIMENTO", $request, $processo);
            $modelArquivo->upload("CONTRACHEQUE", $request, $processo);
            $modelArquivo->upload("OBITO", $request, $processo);
        }
    }

    public function atualizarProcesso(Request $request, Arquivo $modelArquivo, $id, Mensagem_Texto $mensagem_Texto) {
        $processo = Processo::find($id);
        $processo->DT_ENVIO_BANCO = Carbon::createFromFormat('d/m/Y', $request->DT_ENVIO_BANCO)->toDateString();
        $processo->T_STATUS_ID = '2';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
            $modelArquivo->upload('OFICIO', $request, $processo);
        }
    }

    public function atualizarProcessoFinalizado(Request $request, $id, Mensagem_Texto $mensagem_Texto) {
        $processo = Processo::find($id);
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
        }
    }

    public function reiterarProcesso(Request $request, Arquivo $modelArquivo, $id) {
        $processo = Processo::find($id);
        $processo->T_STATUS_ID = '6';
        if ($processo->save()) {
            $modelArquivo->upload('OFICIO_REITERACAO', $request, $processo);
        }
    }
    
    public function excluirProcesso($id) {
        $processo = Processo::find($id);
        $processo->ST_PROCESSO_EXCLUIDO = 'S';
        $processo->T_STATUS_ID = '8';
        $processo->save();
    }

    public function concluirProcesso(Request $request, Arquivo $modelArquivo, $id, Mensagem_Texto $mensagem_Texto) {
        $processo = Processo::find($id);
        $processo->VL_REVERTIDO = $this->formatarValor($request->VL_REVERTIDO);
        $processo->NUM_RA_SIAFI = $request->NUM_RA_SIAFI;
        $processo->DT_DOC_RESPOSTA = $request->DT_DOC_RESPOSTA;
        $processo->T_TIPO_REVERSAO_ID = $request->T_TIPO_REVERSAO_ID;
        $processo->T_STATUS_ID = '4';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
            $modelArquivo->upload('RESPOSTA_BANCO', $request, $processo);
        }
    }

    public function devolverProcesso(Request $request, $id, Mensagem_Texto $mensagem_Texto) {
        $processo = Processo::find($id);
        $processo->VL_REVERTIDO = $this->formatarValor($request->VL_REVERTIDO);
        $processo->NUM_RA_SIAFI = $request->NUM_RA_SIAFI;
        $processo->DT_DOC_RESPOSTA = $request->DT_DOC_RESPOSTA;
        $processo->T_TIPO_REVERSAO_ID = $request->T_TIPO_REVERSAO_ID;
        $processo->T_STATUS_ID = '7';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
        }
        // $processo->TX_MENSAGEM_TEXTO = $request->TX_MENSAGEM_TEXTO;
        // $processo->TX_MENSAGEM = $request->TX_MENSAGEM;
        //$mensagem_texto = Mensagem_Texto::find($request->TX_MENSAGEM_TEXTO);
        // $mensagens = Mensagem::find($request->TX_MENSAGEM);
        // $processo->mensagens()->save($mensagens);
    }

    public function concluirProcessoUpag(Request $request, $id, Mensagem_Texto $mensagem_Texto) {
        $processo = Processo::find($id);
        $processo->VL_REVERTIDO = $this->formatarValor($request->VL_REVERTIDO);
        $processo->NUM_RA_SIAFI = $request->NUM_RA_SIAFI;
        $processo->DT_DOC_RESPOSTA = $request->DT_DOC_RESPOSTA;
        $processo->T_TIPO_REVERSAO_ID = $request->T_TIPO_REVERSAO_ID;
        $processo->T_STATUS_ID = '9';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
        }
        // $processo->TX_MENSAGEM_TEXTO = $request->TX_MENSAGEM_TEXTO;
        // $processo->TX_MENSAGEM = $request->TX_MENSAGEM;
        //$mensagem_texto = Mensagem_Texto::find($request->TX_MENSAGEM_TEXTO);
        // $mensagens = Mensagem::find($request->TX_MENSAGEM);
        // $processo->mensagens()->save($mensagens);
    }

    public function devolverProcessoAntesDeEnviarAoBanco(Request $request, $id, Mensagem_Texto $mensagem_Texto) {
        $mensagem_Texto = New Mensagem_Texto();
        $processo = Processo::find($id);
        $processo->T_STATUS_ID = '5';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
        }
        // $processo->TX_MENSAGEM_TEXTO = $request->TX_MENSAGEM_TEXTO;
        // $processo->TX_MENSAGEM = $request->TX_MENSAGEM;
        //$mensagem_texto = Mensagem_Texto::find($request->TX_MENSAGEM_TEXTO);
        // $mensagens = Mensagem::find($request->TX_MENSAGEM);
        // $processo->mensagens()->save($mensagens);
    }


    public function retornaProcessoSdpp(Request $request, $id, Mensagem_Texto $mensagem_Texto) {
        $modelPessoa = new Pessoa();
        $mensagem_Texto = New Mensagem_Texto();
        $processo = Processo::find($id);
        $processo->pessoa->CPF = $modelPessoa->removeMascaraCPF($request->CPF);
        $processo->pessoa->NOME = $request->NOME;
        $processo->pessoa->save();
        $processo->VL_REVERSAO = $this->formatarValor($request->VLREVERSAO);
        $processo->MES_ANO_INICIO = $this->formatarValor($request->MESANOINICIO);
        $processo->MES_ANO_FIM = $this->formatarValor($request->MESANOFIM);
        $processo->DT_ENVIO_BANCO = $request->DT_ENVIO_BANCO;
        $processo->T_STATUS_ID = '6';
        if ($processo->save()) {
            $mensagem_Texto->gravarMensagem($request, $processo);
        }
    }

}
