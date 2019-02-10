<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\PlanDetails\PlanDetail;

class PlanDetailTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'plan', 'department'
    ];

    public function transform(PlanDetail $planDetail = null)
    {
        if (is_null($planDetail)) {
            return [];
        }

        return [
            'id'             => $planDetail->id,
            'plan_id'        => $planDetail->plan_id,
            'plan_txt'       => $planDetail->plan ? $planDetail->plan->title : '',
            'department_id'  => $planDetail->department_id,
            'department_txt' => $planDetail->department ? $planDetail->department->name : '',
            'position_id'    => $planDetail->position_id,
            'position_txt'   => $planDetail->position ? $planDetail->position->name : '',
            'quantity'       => $planDetail->quantity,
        ];
    }

    public function includePlan(PlanDetail $planDetail = null)
    {
        if (is_null($planDetail)) {
            return $this->null();
        }

        return $this->item($planDetail->plan, new PlanTransformer);
    }

    public function includeDepartment(PlanDetail $planDetail = null)
    {
        if (is_null($planDetail)) {
            return $this->null();
        }

        return $this->item($planDetail->department, new DepartmentTransformer);
    }
}
