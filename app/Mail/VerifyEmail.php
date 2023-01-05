<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $lastname;
    private $token;

    public function __construct($lastname, $token)
    {
        $this->lastname =  $lastname;
        $this->token =  $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verify')
                    ->with([
                        'lastname'=>$this->lastname,
                        'token'=>$this->token,
                        ]);
    }
}
