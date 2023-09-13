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
use App\Models\Perfil;



class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        //$this->middleware('UpagMiddleware');
    }
    
    public function alimentaDashboard() { //DETALHAR UM PROCESSO
        //FEITO
        $ValorTotalrevertido = 
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('sum(T_PROCESSO.VL_REVERTIDO) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->get();
        //FEITO
        $TotalProcessosPorBanco = 
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('count(T_PROCESSO.VL_REVERTIDO) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->get();
        //FEITO 
        $ReversaoSaldoPendente =  
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('count(T_PROCESSO.VL_REVERTIDO) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->whereColumn('VL_REVERTIDO', '<', 'VL_REVERSAO')
                ->get();
                //dd($ReversaoSaldoPendente);
        //FEITO              
        $ReversaoSemSaldo =  
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('count(T_PROCESSO.ID) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->whereColumn('T_PROCESSO.VL_REVERTIDO', '=', 'T_PROCESSO.VL_REVERSAO')
                ->get();
              // dd($ReversaoSemSaldo);
        $DocumentoSemResposta =  
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('count(T_PROCESSO.VL_REVERTIDO) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->get();
        //FEITO
        $ReversaoFinalizada =  
                DB::table('T_PESSOA')
                ->join('T_PROCESSO', 'T_PROCESSO.T_PESSOA_ID', '=', 'T_PESSOA.ID')
                ->join('T_BANCO', 'T_BANCO.ID', '=', 'T_PESSOA.T_BANCO_ID')
                ->select('T_BANCO.SIGLA', DB::raw('count(T_PROCESSO.VL_REVERTIDO) as total'))
                ->groupBy('T_BANCO.SIGLA')
                ->where('T_STATUS_ID', '=', '4')
                ->get();
        return view('sdpp.dashboardSdpp', compact('ValorTotalrevertido','TotalProcessosPorBanco', 'ReversaoSemSaldo', 'ReversaoSaldoPendente', 'DocumentoSemResposta','ReversaoFinalizada'));
    }
    
}