<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCall extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $call;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $call)
    {
        $this->call = $call;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@galileo.com')
            ->view('emails.call');
    }
}
