<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailParrainage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $parrainage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $parrainage)
    {
        $this->parrainage = $parrainage;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@galileo.com')
            ->view('emails.parrainage');
    }
}
