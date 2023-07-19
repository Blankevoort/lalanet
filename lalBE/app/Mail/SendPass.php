<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPass extends Mailable
{
    use Queueable, SerializesModels;

    public $pass;

    public function __construct($pass)
    {
        $this->pass = $pass;
    }

    public function build()
    {
        return $this->view('PassView');
        with:
        [
            'pass' => $this->pass,
        ];
    }
}
