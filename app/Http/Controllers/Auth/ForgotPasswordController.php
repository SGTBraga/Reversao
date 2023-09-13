<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showFormResetSenha() {
        return view('auth.resetSenha');
    }

    public function resetSenha(Request $request, User $modelUsuario) {
        if ($usuario = $modelUsuario->existsByCPF($request)) {
            if (isset($usuario)) {
                $senha = str_random(8);
                $hashSenha = Hash::make($senha);
                $usuario->SENHA = $hashSenha;
                if ($usuario->save()) {
                    Mail::to($usuario->EMAIL)->send(new SendMailUser($usuario, $senha));
                    return redirect()
                                    ->route('login')
                                    ->with('success', "Procedimentos de redefinição de senha foram enviados para o email $usuario->EMAIL.");
                }
            }
        } else {
            return redirect()
                            ->route('login.resetSenha')
                            ->with('error', "CPF não encontrado.");
        }
    }
}
