<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
Use App\Models\Pessoa;
Use App\Models\Posto;
Use App\Models\Unidade;
Use App\Models\Tipo;
Use App\Models\Prioridade;
Use App\Models\Processo;
Use App\Models\Arquivo;
Use App\Models\Estatus;
Use App\Models\Rejeitado;
Use App\Models\Logs\LogPessoa;
Use App\Models\Logs\LogProcesso;
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
use App\Models\Mensagem;
use App\Models\Mensagem_Texto;
use App\Models\Perfil;
use Illuminate\Http\Request;



class ProcessoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        //$this->middleware('UpagMiddleware');
    }

    public function listarIniciadosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '1')
                            ->where('ST_PROCESSO_EXCLUIDO', '=', 'N')->get();
        }
        return view('sdpp.listarAutorizados', compact('listaProcessos'));
    }

    public function listarProcessos() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('ST_PROCESSO_EXCLUIDO', '=', 'N')->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('ST_PROCESSO_EXCLUIDO', '=', 'N')->get();
        }
        return view('todos.processo.listar', compact('listaProcessos'));
    }

    public function listarExcluidos() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('ST_PROCESSO_EXCLUIDO', '=', 'S')->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('ST_PROCESSO_EXCLUIDO', '=', 'S')->get();
        }
        return view('sdpp.listarExcluidos', compact('listaProcessos'));
    }

    public function listarAtrasadosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '2')
                            ->where('DT_ENVIO_BANCO', '<', DB::raw('SUBDATE(CURRENT_DATE(), 20)'))->get();
        }
        return view('sdpp.atrasados', compact('listaProcessos'));
    }

    public function listarConcluidosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('T_STATUS_ID', '=', '4')->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '4')->get();
        }
        return view('todos.processo.listar', compact('listaProcessos'));
    }

    public function listarDevolvidosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('T_STATUS_ID', '=', '5')->get();
            return view('upag.processo.listarDevolvidos', compact('listaProcessos'));
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '5')->get();
        }
        return view('sdpp.listarDevolvidos', compact('listaProcessos'));
    }

    public function listarFinalizadoSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('T_STATUS_ID', '=', '7')->get();
            return view('upag.processo.listarFinalizadosSdpp', compact('listaProcessos'));
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '7')->get();
        }
        return view('upag.processo.listarFinalizadosSdpp', compact('listaProcessos'));
    }

    public function listarFinalizadoUpag() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)
                            ->where('T_STATUS_ID', '=', '9')->get();
            return view('upag.processo.listarFinalizadoUpag', compact('listaProcessos'));
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '9')->get();
        }
        return view('upag.processo.listarFinalizadosUpag', compact('listaProcessos'));
    }

    public function listarEnviadosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '2')->get();
        }
        return view('sdpp.listarEnviados', compact('listaProcessos'));
    }

    public function listarReiteradosSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '6')->get();
        }
        return view('sdpp.listarReiterados', compact('listaProcessos'));
    }

    public function dashboardSdpp() {

        if (Auth::user()->T_PERFIL_ID == 2 || Auth::user()->T_PERFIL_ID == 3) { //<!-- PERFIL UNIDADE PAGADORA E CONSULTA-->
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_UNIDADE_ID', '=', Auth::user()->unidade->ID)->get();
        } else { // PERFIL ADMIN E SDPP
            $listaProcessos = Processo::orderBy('ID', 'desc')
                            ->where('T_STATUS_ID', '=', '2')->get();
        }
        return view('sdpp.dashboardSdpp', compact('listaProcessos'));
    }

    public function create() {
        $bancos = Banco::all();
        $tipo_pessoas = Tipo_Pessoa::all();
        $motivo_reversoes = Motivo_Reversao::all();
        return view('upag.processo.criar', compact('bancos', 'tipo_pessoas', 'motivo_reversoes'));
    }

    public function solicitarReversaoASDPP(ValidarInclusao $request, Processo $modelProcesso, Arquivo $modelArquivo, Mensagem_Texto $mensagem_Texto) {
        $modelProcesso->incluirProcesso($request, $modelArquivo, $mensagem_Texto);
        return redirect()
                        ->route('usuario.listarProcessos')
                        ->with('success', "Reversão solicitada com sucesso. Processo será analisado pela SDPP.");
    }

    public function downloadProcesso($id) {
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'REQUERIMENTO')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        }else{
            return response('Não há arquivo para download', 200);
        }
    }

    public function downloadResposta($id) {
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'RESPOSTA_BANCO')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        }else{
            return response('Não há arquivo para download', 200);
        }
    }

    public function downloadOficio($id) {
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'OFICIO')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        } else {
            return response('Não há arquivo para download', 200);
            // return 'Não há arquivo disponível!';
        }
    }

    public function downloadOficioReiteracao($id) {
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'OFICIO_REITERACAO')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        } else {
            return response('Não há arquivo para download', 200);
            // return 'Não há arquivo disponível!';
        }
    }

    public function downloadContracheque($id) {
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'CONTRACHEQUE')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        } else {
            return response('Não há arquivo para download', 200);
            // return 'Não há arquivo disponível!';
        }
    }

    public function downloadObito($id) {
        // echo ('chegou');
        // die;
        $arquivo = Arquivo::where('T_PROCESSO_ID', $id)
                        ->where('TIPO_ARQUIVO', 'OBITO')
                        ->where('ST_EXCLUIDO', 'N')->first();
        if (isset($arquivo)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($arquivo->PATH);
            return response()->download($path);
        } else {
            return response('Não há arquivo para download', 200);
            // return 'Não há arquivo disponível!';
        }
    }

    public function autorizarProcesso(Request $request, $id, Processo $modelProcesso, Arquivo $modelArquivo) { //MOSTRAR UM PROCESSO
            $processo = Processo::find($id);
            $listaArquivos = DB::table('T_ARQUIVO')
                    ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                    ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                    ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                    ->where('ST_EXCLUIDO', 'N')
                    ->get();
            $usuario = User::find($id);
            $banco = Banco::find($processo->T_BANCO_ID);
            return view('sdpp.autorizar', compact('processo', 'listaArquivos', 'usuario', 'banco'));
    }

    public function solicitarReversaoAoBanco(Request $request, Processo $modelProcesso, Arquivo $modelArquivo, $id, Mensagem_Texto $mensagem_Texto) {
        if ($request->botao == 'devolver') {
            $modelProcesso->devolverProcessoAntesDeEnviarAoBanco($request, $id, $mensagem_Texto);
            return redirect()
                            ->route('processoSdpp.enviadosSdpp')
                            ->with('success', "Reversão devolvida à UPAG.");
        } else {
        $modelProcesso->atualizarProcesso($request, $modelArquivo, $id, $mensagem_Texto);

        return redirect()
                        ->route('processoSdpp.iniciadosSdpp')
                        ->with('success', "Reversão solicitada com sucesso. Processo será analisado pelo Banco.");
        }
    }

    public function reiteraProcesso(Request $request, Processo $modelProcesso, Arquivo $modelArquivo, $id) {

        $modelProcesso->reiterarProcesso($request, $modelArquivo, $id);

        return $this->listarIniciadosSdpp();
    }

    public function mostraProcessoParaAnalise($id) { //MOSTRAR UM PROCESSO
        $processo = Processo::find($id);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'N')
                ->get();
        //$mensagem_texto = Mensagem_Texto::where('ST_EXCLUIDO', 'N')->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('sdpp.analisar', compact('processo', 'listaArquivos', 'usuario', 'banco'));
    }

    public function devolverProcesso(Request $request, Processo $modelProcesso, $id, Mensagem_Texto $mensagem_Texto) { //DEVOLVER UM PROCESSO
        $modelProcesso->devolverProcesso($request, $id, $mensagem_Texto);

        return $this->listarDevolvidosSdpp();
    }

    public function excluirProcesso(Processo $modelProcesso, $id, Request $request) {
        if ($request->botao == 'excluir') {
        $modelProcesso->excluirProcesso($id);
        return redirect()
                        ->route('usuario.listarProcessos')
                        ->with('success', "Reversão excluida com sucesso.");
        }
    }

    public function mostrarProcesso($id) { //RETORNAR UM PROCESSO
        $processo = Processo::find($id);
        $log = Mensagem_Texto::find($id);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'N')
                ->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('sdpp.retornar', compact('processo', 'listaArquivos', 'usuario', 'banco', 'log'));
    }

    public function mostrarProcessoFinalizado($id) { //RETORNAR UM PROCESSO
        $processo = Processo::find($id);
        $log = Mensagem_Texto::find($id);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'N')
                ->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('upag.processo.atualizar', compact('processo', 'listaArquivos', 'usuario', 'banco', 'log'));
    }

    public function retornarProcesso(Request $request, Processo $modelProcesso, $id, Mensagem_Texto $mensagem_Texto) { //RETORNAR UM PROCESSO
        $modelProcesso->retornaProcessoSdpp($request, $id, $mensagem_Texto);

        return redirect()
                        ->route('processoUpag.listarDevolvidos')
                        ->with('success', "Reversão devolvida com sucesso. Processo será analisado novamente pela SDPP.");

        return $this->listarDevolvidosSdpp();
    }

    public function detalharProcesso($id) { //DETALHAR UM PROCESSO
        $processo = Processo::find($id);
        //dd($processo->mensagem_texto);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'N')
                ->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('todos.processo.detalhar', compact('processo', 'listaArquivos', 'usuario', 'banco'));
    }

    public function detalharProcessoExcluido($id) { //DETALHAR UM PROCESSO
        $processo = Processo::find($id);
        //dd($processo->mensagem_texto);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'S')
                ->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('sdpp.detalharExcluido', compact('processo', 'listaArquivos', 'usuario', 'banco'));
    }

    public function analisarProcesso(Request $request, Processo $modelProcesso, Arquivo $modelArquivo, $id, Mensagem_Texto $mensagem_Texto) {
        if ($request->botao == 'finalizar') {
            $modelProcesso->devolverProcesso($request, $id, $mensagem_Texto);
            return redirect()
                            ->route('processoSdpp.enviadosSdpp')
                            ->with('success', "Reversão devolvida à UPAG.");
        } else {
            $modelProcesso->concluirProcesso($request, $modelArquivo, $id, $mensagem_Texto);
            return redirect()
                            ->route('processoSdpp.iniciadosSdpp')
                            ->with('success', "Reversão concluída com sucesso.");
        }
    }

    public function atualizarProcessoFinalizado(Request $request, Processo $modelProcesso, $id, Mensagem_Texto $mensagem_Texto) {
        if ($request->botao == 'atualizar') {
            $modelProcesso->atualizarProcessoFinalizado($request, $id, $mensagem_Texto);
            return redirect()
                            ->route('processoUpag.finalizadoSdpp')
                            ->with('success', "Processo Atualizado com Sucesso!.");
        }else {
            $modelProcesso->concluirProcessoUpag($request, $id, $mensagem_Texto);
            return redirect()
                            ->route('processoSdpp.iniciadosSdpp')
                            ->with('success', "Reversão concluída pela UPAG com sucesso.");
        }
    }

    public function reiterarProcesso($id) { //REITERAR UM PROCESSO
        $processo = Processo::find($id);
        $listaArquivos = DB::table('T_ARQUIVO')
                ->select('T_ARQUIVO.ID_ARQUIVO AS ID')
                ->join('T_PROCESSO', 'T_ARQUIVO.T_PROCESSO_ID', '=', 'T_PROCESSO.ID')
                ->where('T_ARQUIVO.T_PROCESSO_ID', $id)
                ->where('ST_EXCLUIDO', 'N')
                ->get();
        $usuario = User::find($id);
        $banco = Banco::find($processo->T_BANCO_ID);
        return view('upag.processo.reiterar', compact('processo', 'listaArquivos', 'usuario', 'banco'));
    }

}
