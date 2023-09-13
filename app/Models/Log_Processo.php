<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_Processo extends Model
{
    protected $table = "T_LOG_PROCESSO";
    protected $primaryKey = 'ID';

    
    public function processo() {
        return $this->belongsTo('App\Models\Processo', 'T_PROCESSO_ID');
    }

    public function usuario() {
        return $this->belongsTo('App\Users', 'T_USUARIO_ID');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status', 'T_STATUS_ID');
    }
}
