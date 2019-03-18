<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Pozivnice;

class SlanjePozivnica extends Mailable
{
    use Queueable, SerializesModels;

    public $pozivnica;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pozivnice $pozivnica)
    {
        $this->pozivnica = $pozivnica;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pozivnice');
    }
}
