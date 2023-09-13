<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = "T_PERFIL";
    protected $primaryKey = 'ID';

    public function usuario() {
        return $this->hasMany('App\User', 'T_USUARIO_ID');
    }
}
