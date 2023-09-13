<?php

namespace App;

use App\Mail\SendMailUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\GravarUsuario;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "T_USUARIO";
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->attributes['SENHA'];
    }

// Faz a referência da chave estrangeira dentro da clase User para a classe Unidade
    public function unidade() {
        return $this->belongsTo('App\Models\Unidade', 'T_UNIDADE_ID');
    }
    public function perfil() {
        return $this->belongsTo('App\Models\Perfil', 'T_PERFIL_ID');
    }
    public function rejeitados() {
        return $this->hasMany('App\Models\Rejeitado');
    }
    public function incluir(GravarUsuario $request) {
            $usuario = new User();

            $usuario->NOME = $request->NOME;
            $usuario->T_PERFIL_ID = $request->PERFIL;
            $usuario->CPF = $this->removeMascaraCPF($request->CPF);
            $usuario->NOME_GUERRA = $request->NOME_GUERRA;
            $usuario->EMAIL = $request->EMAIL;
            $usuario->SENHA = Hash::make($senha = str_random(8));
            $usuario->ST_EXCLUIDO = "N";
            $usuario->T_UNIDADE_ID = $request->UNIDADE;
            Mail::to($usuario->EMAIL)->send(new SendMailUser($usuario, $senha));
            return $usuario->save();
        
    }
    public function excluir($id) {
        $usuario = User::find($id);
        $usuario->ST_EXCLUIDO = 'S';
        return $usuario->save();
    }

    private function removeMascaraCPF($CPF) {
        return str_replace("-", "", str_replace(".", "", $CPF));
    }

    public function existsByCPF($request) {
        $CPF = $this->removeMascaraCPF($request->CPF);
        return User::where('CPF', '=', $CPF)->where('ST_EXCLUIDO', 'N')->first();
    }

    public function getCPFComMascara() {
        return substr($this->CPF, 0, 3) . '.' . substr($this->CPF, 3, 3) . '.' . substr($this->CPF, 6, 3) . '-' . substr($this->CPF, 9);
    }
}
