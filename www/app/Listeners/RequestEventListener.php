<?php

namespace App\Listeners;

use App\Events\RequestEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestEventListener
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
     * @param  RequestEvent  $event
     * @return void
     */
    public function handle(RequestEvent $event)
    {
        //
    }
}
