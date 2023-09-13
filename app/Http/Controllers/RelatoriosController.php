<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Pessoa;
use App\Models\Posto;
use App\Models\Unidade;
use App\Models\Tipo;
use App\Models\Prioridade;
use App\Models\Processo;
use App\Models\Arquivo;
use App\Models\Estatus;
use App\Models\Rejeitado;
use App\Models\Logs\LogPessoa;
use App\Models\Logs\LogProcesso;
use App\Http\Requests\ValidacaoProcesso;
use App\Http\Requests\ValidacaoUpagConcordancia;
use App\Http\Requests\ValidacaoUpagSentenca;
use App\Http\Requests\ValidarInclusao;
use App\Models\Tipo_Pessoa;
use App\Models\Motivo_Reversao;
use App\Models\Banco;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Requests\GravarUsuario;
use App\Models\Perfil;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{

    public function opcoesSDPP()
    { //LISTAR RELATÓRIOS ANALÍTICOS
        return view('relatorios.opcoesSDPP');
    }

    public function opcoesUpag()
    { //LISTAR RELATÓRIOS ANALÍTICOS
        return view('relatorios.opcoesUpag');
    }

    public function listarRelatoriosSdppPorUnidade(Request $request)
    { //LISTAR RELATÓRIOS ANALÍTICOS por unidade
        $mes = substr($request->input('mesAno'), 0, 2);
        $ano = substr($request->input('mesAno'), 3, 4);
        $mesAno =  $ano."-".$mes;
        $listaDeProcessos = 
        Processo::where('T_PROCESSO.CREATED_AT', 'like', $mesAno.'%')
        ->where('T_PROCESSO.ST_PROCESSO_EXCLUIDO', '=', 'N')
        ->join('T_PESSOA', 'T_PESSOA.ID', 'T_PROCESSO.T_PESSOA_ID')
        ->join('T_UNIDADE', 'T_UNIDADE.ID', 'T_PROCESSO.T_UNIDADE_ID')
        ->join('T_BANCO', 'T_BANCO.ID', 'T_PESSOA.T_BANCO_ID')
        ->orderBy('T_UNIDADE.SIGLA')
        ->orderBy('T_BANCO.SIGLA')
        ->get();
        return view('relatorios.analiticoUnidade', compact('listaDeProcessos','mes', 'ano'));
    }

    public function listarRelatoriosSdppPorBanco(Request $request)
    { //LISTAR RELATÓRIOS ANALÍTICOS POR BANCO
        $mes = substr($request->input('mesAno'), 0, 2);
        $ano = substr($request->input('mesAno'), 3, 4);
        $mesAno =  $ano."-".$mes;
        $listaDeProcessos = 
        Processo::where('T_PROCESSO.CREATED_AT', 'like', $mesAno.'%')
        ->where('T_PROCESSO.ST_PROCESSO_EXCLUIDO', '=', 'N')
        ->join('T_PESSOA', 'T_PESSOA.ID', 'T_PROCESSO.T_PESSOA_ID')
        ->join('T_UNIDADE', 'T_UNIDADE.ID', 'T_PROCESSO.T_UNIDADE_ID')
        ->join('T_BANCO', 'T_BANCO.ID', 'T_PESSOA.T_BANCO_ID')
        ->orderBy('T_BANCO.SIGLA')
        ->orderBy('T_UNIDADE.SIGLA')
        ->get();
        return view('relatorios.analiticoUnidade', compact('listaDeProcessos','mes', 'ano'));
    }

    public function listarAnaliticoUnidade(Request $request)
    { //LISTAR RELATÓRIOS ANALÍTICOS
        $mes = substr($request->input('mesAno'), 0, 2);
        $ano = substr($request->input('mesAno'), 3, 4);
        $mesAno =  $ano."-".$mes;
        $unidadeUsuario = Auth::user()->unidade->SIGLA;
        $listaDeProcessos = 
        Processo::where('T_PROCESSO.CREATED_AT', 'like', $mesAno.'%')
        ->where('T_UNIDADE_ID','=',Auth::user()->unidade->ID)
        ->where('T_PROCESSO.ST_PROCESSO_EXCLUIDO', '=', 'N')
        ->join('T_PESSOA', 'T_PESSOA.ID', 'T_PROCESSO.T_PESSOA_ID')
        ->join('T_UNIDADE', 'T_UNIDADE.ID', 'T_PROCESSO.T_UNIDADE_ID')
        ->join('T_BANCO', 'T_BANCO.ID', 'T_PESSOA.T_BANCO_ID')
        ->orderBy('T_UNIDADE.SIGLA')
        ->orderBy('T_BANCO.SIGLA')
        ->get();
        return view('relatorios.analiticoUnidade', compact('listaDeProcessos','mes', 'ano'));
    }
}
