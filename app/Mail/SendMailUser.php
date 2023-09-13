<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $senha)
    {
        $this->user = $user;
        $this->senha = $senha;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply.dirad@fab.mil.br')->view('usuario.email.novoUsuario')->with([
                        'user' => $this->user,'senha'=> $this->senha
                    ])->subject('Acesso ao Sistema de Reversão');
    }
}
