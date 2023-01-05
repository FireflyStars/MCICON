<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $name;
    private $email;
    private $msg;

    public function __construct($name, $email, $msg)
    {
        $this->name =  $name;
        $this->email =  $email;
        $this->msg =  $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact')
                    ->with([
                        'name'=>$this->name,
                        'email'=>$this->email,
                        'msg'=>$this->msg,
                        ]);
    }
}
