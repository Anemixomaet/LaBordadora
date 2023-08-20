<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Persona;

class PagoCorreo extends Mailable
{
    use Queueable, SerializesModels;
    public $persona;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Persona $persona)
    {
        $this->persona = $persona;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pago');
    }
}
