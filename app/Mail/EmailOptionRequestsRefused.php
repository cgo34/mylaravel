<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailOptionRequestsRefused extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $optionRequestsRefused;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $optionRequestsRefused)
    {
        $this->optionRequestsRefused = $optionRequestsRefused;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('capdevillegeoffroy@gmail.com')
            ->view('emails.optionRequestsRefused');
    }
}
