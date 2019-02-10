<?php

namespace App\Events;

use App\Repositories\Candidates\Candidate;

class StoreOrUpdateInterviewEvent extends Event
{
    public $candidate;
    public $interviewBy;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate, $interviewBy)
    {
        $this->candidate = $candidate;
        $this->interviewBy = $interviewBy;
    }
}
