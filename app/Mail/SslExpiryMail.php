<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SslExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $site;

    public function __construct($site)
    {
        $this->site = $site;
    }

    public function build()
    {
        return $this->subject('SSL Certificate Expiry Alert')
                    ->markdown('emails.expiry')
                    ->with(['site' => $this->site]);
    }
}
