<?php

namespace App\Events;
use App\Repositories\Employees\Employee;

class StoreOrUpdateDepartmentEmployeeEvent extends Event
{
    public $employee;
    public $departments;
    /**
     * Create a new event instance.
     *
     * @return void
    */
    public function __construct(Employee $employee, $departments){
        $this->employee = $employee;
        $this->departments = $departments;
    }
}
