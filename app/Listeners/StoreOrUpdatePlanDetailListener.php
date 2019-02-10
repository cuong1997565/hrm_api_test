<?php

namespace App\Listeners;

use App\Events\StoreOrUpdatePlanDetailEvent;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Jobs\StorePlanDetailJob;
use App\Jobs\UpdatePlanDetailJob;
class StoreOrUpdatePlanDetailListener
{
    /**
     * Create the event listener.
     *
     * @return void
    */
    public function __construct(PlanDetailRepository $planDetailRepo)
    {
        $this->planDetail = $planDetailRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StoreOrUpdatePlanDetailEvent $event)
    {
        $dataStore  = [];
        $dataUpdate = [];
        foreach ($event->details as $key => $value) {
            $planDetailId = array_get($event->details, $key.'.id', 0);
             if($planDetailId > 0){
                $dataUpdate[] = $value;
                $idDelete[] = $value['id'];
            } else {
                $dataStore[] = $value;
            }
        }
        if(count($dataUpdate)){
             $ids = $event->plan->details->whereNotIn('id', $idDelete)->pluck('id', 'id');
             foreach ($ids as $id => $value) {
                 $this->planDetail->destroy($id);
             }
        }
        dispatch(new StorePlanDetailJob($event->plan->id, $dataStore));
        dispatch(new UpdatePlanDetailJob($event->plan->id, $dataUpdate));
    }
}
