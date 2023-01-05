<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;

    public function __construct($token)
    {
        $this->token =  $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.pwdreset')
                    ->with([
                        'token'=>$this->token,
                        ]);
    }
}
