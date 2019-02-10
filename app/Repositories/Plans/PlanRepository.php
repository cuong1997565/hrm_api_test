<?php

namespace App\Repositories\Plans;

use App\Repositories\BaseRepository;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Events\StoreOrUpdatePlanDetailEvent;

class PlanRepository extends BaseRepository
{
    /**
     * Plan model.
     * @var Model
     */
    protected $model;

    /**
     * PlanRepository constructor.
     * @param Plan $plan
     */
    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }

    /**
     * Lấy tất cả giá trị hợp lệ của trạng thái
     * @return string
     */
    public function getAllStatus()
    {
        return implode(',', Plan::ALL_STATUS);
    }

    public function store($data){
        $end    = array_except($data, ['status']);
        $plan    = parent::store($data);
        $details = array_get($data, 'details' , []);
        if(count($details)){
            event(new StoreOrUpdatePlanDetailEvent($plan, $details));
        }
        return $plan;
    }

    public function update($id, $data, $excepts = [], $only = []){
        $record = parent::update($id, $data);
        $details = array_get($data, 'details', []);
        if (count($details)) {
            event(new StoreOrUpdatePlanDetailEvent($record, $details));
        }
        return $record;
    }

    /**
     * Cập nhật trạng thái từ "Mới" thành "Chờ duyệt"
     * Gửi email thông báo có kế hoạch cần duyệt cho cấp trên
     * @param  int   $id  id
     * @return [type]     [description]
     */
    public function changeStatusWait($id, $data)
    {
        $plan = parent::getById($id);
        $emails = array_get($data, 'emails', []);
        if ($plan->status == Plan::CREATED && count($emails)) {
        // event(new SendEmailNotificationNewPlanEvent($plan, $emails));
            return parent::update($id, ['status' => Plan::WAIT_APPROVE]);
        } else {
            return $plan;
        }
    }

    /**
     * Cập nhật trạng thái:
     * "Chờ duyệt" -> "Duyệt"
     * "Chờ duyệt" -> "Không duyệt"
     * "Duyệt" -> "Hoàn thành"
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function changeStatus($id, $status)
    {
        $plan = parent::getById($id);
        switch ($status) {
            case Plan::APPROVED:
                $plan->status != Plan::WAIT_APPROVE ?: $plan->status = $status;
            break;
            case Plan::NOT_APPROVE:
                $plan->status != Plan::WAIT_APPROVE ?: $plan->status = $status;
            break;
            case Plan::DONE:
                $plan->status != Plan::APPROVED ?: $plan->status = $status;
            break;
        }
        $plan->save();
        return $plan;
    }
}
