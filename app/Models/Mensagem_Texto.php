<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Processo;

class Mensagem_Texto extends Model
{
    protected $table = "T_MENSAGEM_TEXTO";
    protected $primaryKey = 'ID';

    public function gravarMensagem (Request $request, Processo $processo) {
        $mensagem = new Mensagem_Texto();
        $mensagem->ST_EXCLUIDO = 'N';
        $mensagem->TX_MENSAGEM = $request->TX_MENSAGEM_TEXTO;
        $mensagem->ID_PROCESSO = $processo->ID;
        return $mensagem->save();
    }
}
