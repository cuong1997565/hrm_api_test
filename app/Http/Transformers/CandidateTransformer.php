<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Candidates\Candidate;

class CandidateTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'employees', 'plan'
    ];

    public function transform(Candidate $candidate = null)
    {
        if (is_null($candidate)) {
            return [];
        }

        return [
            'id'                    => $candidate->id,
            'name'                  => $candidate->name,
            'email'                 => $candidate->email,
            'phone'                 => $candidate->phone,
            'source'                => $candidate->source,
            'date_apply'            => $candidate->date_apply,
            'date_apply_format'     => $candidate->date_apply? $candidate->getFormatDateApply() : '',
            'time_interview'        => $candidate->time_interview,
            'time_interview_format' => $candidate->time_interview ? $candidate->getFormatTimeInterview() : '',
            'plan_id'               => $candidate->plan_id,
            'plan_txt'              => $candidate->plan ? $candidate->plan->title : '',
            'position_id'           => $candidate->position_id,
            'position_txt'          => $candidate->position ? $candidate->position->name : '',
            'status'                => $candidate->status,
            'status_txt'            => $candidate->getStatus(),
            'created_at'            => $candidate->created_at,
            'updated_at'            => $candidate->updated_at,
        ];
    }

    public function includeEmployees(Candidate $candidate = null)
    {
        if (is_null($candidate)) {
            return $this->null();
        }

        return $this->collection($candidate->employees, new EmployeeTransformer);
    }

    public function includePlan(Candidate $candidate = null)
    {
        if (is_null($candidate)) {
            return $this->null();
        }

        return $this->item($candidate->plan, new PlanTransformer);
    }
}
