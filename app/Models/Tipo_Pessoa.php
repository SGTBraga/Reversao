<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_Pessoa extends Model
{
    protected $table = "T_TIPO_PESSOA";
    protected $primaryKey = 'ID';

    public function processo() {
        return $this->hasMany('App\User', 'T_TIPO_PESSOA_ID');
    }
}
