<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rejeitado extends Model
{
    protected $table = "T_REJEITADO";
    protected $primaryKey = 'ID';


    public function usuario() {
        return $this->belongsTo('App\User', 'T_USUARIO_ID');
    }

    public function unidade() {
        return $this->belongsTo('App\Models\Unidade', 'T_UNIDADE_ID');
    }
}
