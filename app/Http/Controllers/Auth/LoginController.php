<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return 'CPF';
    }

    private function removeMascaraCPF($CPF) {
        return str_replace("-", "", str_replace(".", "", $CPF));
    }

    protected function credentials(Request $request) {
        $cpf = $this->removeMascaraCPF($request->CPF);
        return ['CPF' => $cpf, 'password' => $request->password, 'ST_EXCLUIDO' => 'N'];
    }

    protected function authenticated() {
        $nivel = Auth::user()->perfil->ID;
        switch ($nivel) {
            case 1:
                return redirect()->route('admin');
                break;
        }
    }
}
