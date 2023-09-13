<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = "T_UNIDADE";
    protected $primaryKey = 'ID';
    protected $casts = ['ID' => 'string'];

    public function usuario() {
        return $this->hasMany('App\User', 'T_USUARIO_ID');
    }

    public function processo() {
        return $this->hasMany('App\User', 'T_PROCESSO_ID');
    }

}
