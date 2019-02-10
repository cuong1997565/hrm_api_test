<?php

namespace App\Events;
use App\Repositories\Plans\Plan;

class StoreOrUpdatePlanDetailEvent extends Event
{
    public $plan;
    public $details;
    /**
     * Create a new event instance.
     *
     * @return void
    */
    public function __construct(Plan $plan, $details)
    {
        $this->plan = $plan;
        $this->details = $details;
    }
}
