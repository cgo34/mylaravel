<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailOptionRequestsPending extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $optionRequestsPending;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $optionRequestsPending)
    {
        $this->optionRequestsPending = $optionRequestsPending;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('capdevillegeoffroy@gmail.com')
            ->view('emails.optionRequestsPending');
    }
}
