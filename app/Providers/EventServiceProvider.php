<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        \App\Events\StoreAccountForEmployeeEvent::class => [
            \App\Listeners\StoreAccountForEmployeeListener::class
        ],
        \App\Events\StoreOrUpdateDepartmentEmployeeEvent::class => [
            \App\Listeners\StoreOrUpdateDepartmentEmployeeListener::class
        ],
        \App\Events\StoreContractEmployeeEvent::class => [
            \App\Listeners\StoreContractEmployeeListener::class
        ],
        \App\Events\StoreOrUpdatePlanDetailEvent::class => [
            \App\Listeners\StoreOrUpdatePlanDetailListener::class
        ]
    ];
}
