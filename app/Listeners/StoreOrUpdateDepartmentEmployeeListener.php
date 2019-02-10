<?php

namespace App\Listeners;

use App\Events\StoreOrUpdateDepartmentEmployeeEvent;

class StoreOrUpdateDepartmentEmployeeListener
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
    public function handle(StoreOrUpdateDepartmentEmployeeEvent $event)
    {
        $insertData = [];
        foreach ($event->departments as $key => $value) {
            $insertData[$value['department_id']] = [
                'position_id' => $value['position_id'],
                'status' => array_get($event->departments, $key.'status', 0)
            ];
        }
        $event->employee->departments()->sync($insertData);
    }
}
