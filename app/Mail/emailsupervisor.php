<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class emailsupervisor extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mail')
                ->with('name', 'Diego')
                ->from('dintriago07@gmail.com', 'Styde')
                ->subject('correo enviado con la libreria mailtrap');
                
    }
}
