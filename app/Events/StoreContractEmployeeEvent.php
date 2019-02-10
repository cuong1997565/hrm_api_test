<?php

namespace App\Events;
use App\Repositories\Employees\Employee;

class StoreContractEmployeeEvent extends Event
{
    public $employee;
    public $contracts;
    /**
     * Create a new event instance.
     *
     * @return void
    */
    public function __construct(Employee $employee, $contracts){
        $this->employee = $employee;
        $this->contracts = $contracts;
    }

}
