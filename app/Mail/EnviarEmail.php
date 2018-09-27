<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $nome)
    {
        $this->email = $email;
        $this->nome = $nome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $nome = ['nome' => $this->nome];
        $envio = Mail::send('emails.email', $nome, function($message){
            $message->to($this->email);
            $message->subject($this->mensagem.' '.$this->nome);
            $message->from('smtp@kbrtec.com.br');
        });
        $erros = Mail::failures();
        return $erros;
    }
}
