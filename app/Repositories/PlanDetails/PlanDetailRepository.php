<?php

namespace App\Repositories\PlanDetails;

use App\Repositories\BaseRepository;

class PlanDetailRepository extends BaseRepository
{
       /**
     * PlanDetail model.
     * @var Model
     */
    protected $model;

    /**
     * PlanDetailRepository constructor.
     * @param PlanDetail $planDetail
     */
    public function __construct(PlanDetail $planDetail){
        $this->model = $planDetail;
    }
}