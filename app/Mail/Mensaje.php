<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Partners;

class Mensaje extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //
    }
}
