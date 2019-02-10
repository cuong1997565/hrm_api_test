<?php

namespace App\Listeners;

use App\Repositories\Users\UserRepository;
use App\Events\StoreAccountForEmployeeEvent;

class StoreAccountForEmployeeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->use = $userRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StoreAccountForEmployeeEvent $event)
    {
        $this->use->store([
            'name'      => $event->employee->name,
            'email'     => $event->employee->email,
            'phone'     => $event->employee->phone,
            'password' => $event->password
        ]);
    }
}
