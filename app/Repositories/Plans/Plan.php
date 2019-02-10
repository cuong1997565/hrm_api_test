<?php

namespace App\Repositories\Plans;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Plan extends Entity
{
    use FilterTrait, PresentationTrait;

    const CREATED      = 0;
    const WAIT_APPROVE = 1;
    const APPROVED     = 2;
    const NOT_APPROVE  = 3;
    const DONE         = 4;
    const DELETED      = 5;

    const ALL_STATUS = [
        self::CREATED,
        self::WAIT_APPROVE,
        self::APPROVED,
        self::NOT_APPROVE,
        self::DONE,
        self::DELETED
    ];
    const DISPLAY_STATUS = [
        self::CREATED      => 'Mới',
        self::WAIT_APPROVE => 'Chờ duyệt',
        self::APPROVED     => 'Duyệt',
        self::NOT_APPROVE  => 'Không duyệt',
        self::DONE         => 'Hoàn thành',
        self::DELETED      => 'Hủy'
    ];
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'title',
        'date_start',
        'date_end',
        'content',
        'status'
    ];

    /**
     * Relationship with PlanDetail
     */
    public function details()
    {
        return $this->hasMany(\App\Repositories\PlanDetails\PlanDetail::class);
    }

    /**
     * Relationship with Candidate
     */
    public function candidates()
    {
        return $this->hasMany(\App\Repositories\Candidates\Candidate::class);
    }
}
