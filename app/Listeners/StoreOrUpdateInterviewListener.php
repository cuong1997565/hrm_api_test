<?php

namespace App\Listeners;

use App\Events\StoreOrUpdateInterviewEvent;

class StoreOrUpdateInterviewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StoreOrUpdateInterviewEvent $event)
    {
        $event->candidate->employees()->sync($event->interviewBy);
    }
}
