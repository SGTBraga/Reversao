<?php

namespace App\Models;

use App\Http\Requests\ValidarInclusao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Processo;
use Illuminate\Support\Collection;

class Arquivo extends Model {

    protected $table = "T_ARQUIVO";
    protected $primaryKey = 'ID';

    public function processo() {
        return $this->belongsTo('App\Models\Processo', 'T_PROCESSO_ID');
    }

    public function incluir($processo, $caminhoAbsoluto, $tipo_arquivo) {
        $arquivo = new Arquivo();
        $arquivo->PATH = $caminhoAbsoluto;
        $arquivo->ST_EXCLUIDO = 'N';
        $arquivo->T_PROCESSO_ID = $processo->ID;
        $arquivo->TIPO_ARQUIVO = $tipo_arquivo;
        return $arquivo->save();
    }

    public function upload($input_name, Request $request, Processo $processo) {
        if ($request->has($input_name)) {
            $nomeArquivo = $request->CPF . '_'.$input_name . '.pdf';
            $caminhoAbsoluto = 'processo/' . $nomeArquivo;
            if ($this->incluir($processo, $caminhoAbsoluto, $input_name)) {
                return $request->$input_name->storeAs("processo", $nomeArquivo, "public");
            }else{
                return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
            }
        } 
}
}