<?php

namespace App\Events;
use App\Repositories\Employees\Employee;

class StoreAccountForEmployeeEvent extends Event
{
    public $employee;
    public $password;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Employee $employee, $password)
    {
        $this->employee = $employee;
        $this->password = $password;
    }
}
