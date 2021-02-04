<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HopitalDecesSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $nouveau_deces;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nouveau_deces)
    {
        $this->nouveau_deces = $nouveau_deces;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Déclaration de décès ( E-soutra )')->view('emails.HopitalDécès');
    }
}
