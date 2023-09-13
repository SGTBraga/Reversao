<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_Reversao extends Model
{
    protected $table = "T_TIPO_REVERSAO";
    protected $primaryKey = 'ID';

    public function processo() {
        return $this->hasMany('App\Models\Processo', 'T_PROCESSO_ID');
    }
}
