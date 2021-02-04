<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NaissancQrcode extends Mailable
{
    use Queueable, SerializesModels;

    public $qr_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qr_code)
    {
        $this->qr_code = $qr_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.naissanceqrcode');
    }
}
