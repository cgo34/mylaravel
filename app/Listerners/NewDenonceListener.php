<?php

namespace App\Listerners;

use App\Events\NewDenonceEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewDenonceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewDenonceEvent  $event
     * @return void
     */
    public function handle(NewDenonceEvent $event)
    {
        //
    }
}
