<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NaissanceRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $information;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($information)
    {
        $this->information = $information;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Enregistrement Effectuer avec success (E-soutra) ')->markdown('emails.naissanceregister');
    }
}
