<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "T_STATUS";
    protected $primaryKey = 'ID';

    public function processo() {
        return $this->hasMany('App\Models\Processo', 'T_PROCESSO_ID');
    }
    
    public function logprocesso() {
        return $this->hasMany('App\Models\Log_Processo', 'T_LOG_PROCESSO_ID');
    }
}
