<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = "T_PESSOA";
    protected $primaryKey = 'ID';

    public function processo() {
        return $this->hasMany('App\Models\Processo', 'T_PROCESSO_ID');
    }

    public function banco() {
        return $this->belongsTo('App\Models\Banco', 'T_BANCO_ID');
    }

    public function removeMascaraCPF($CPF) {
        return str_replace("-", "", str_replace(".", "", $CPF));
    }

    public function getCPFComMascara() {
        return substr($this->CPF, 0, 3) . '.' . substr($this->CPF, 3, 3) . '.' . substr($this->CPF, 6, 3) . '-' . substr($this->CPF, 9);
    }

}
