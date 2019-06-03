<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LotUnBooked extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $lotUnBooked;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $lotUnBooked)
    {
        $this->lotUnBooked = $lotUnBooked;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@galileo.com')
            ->view('emails.lotUnBooked');
    }
}
