<?php

namespace App\Repositories\Candidates;

trait FilterTrait
{
    /**
    * Tìm kiếm theo tên, email, số điện thoại
    * @param  [type] $query [description]
    * @param  string $q     name, email, phone
    * @return Collection Candidate  Model
    */
    public function scopeQ($query, $q){
    	if($q){
    		return $query->where('name', 'like', "%${q}%")
    		->orWhere('email', 'like', "%${q}%")
    		->orWhere('phone', 'like', "%${q}%");
    	}
    	return $query;
    }

    /**
    * Tìm kiếm theo kế hoạch tuyển dụng
    * @param  [type] $query [description]
    * @param  number $planId plan_id
    * @return Collection Candidate Model
    */
    public function scopePlanId($query, $planId){
    	if (is_numeric($planId)) {
    		return $query->where('plan_id', $planId);
    	}
    	return $query;
    }

    /**
    * Tìm kiếm theo trạng thái
    * @param  [type] $query [description]
    * @param  string $status  status
    * @return Collection Candidate Model
    */
    public function scopeStatus($query, $status){
    	if(is_numeric($status)){
    		return $query->where('status', $status);
    	}
    	return $query;
    }

    /**
    * Tìm kiếm theo chức danh
    * @param  [type] $query [description]
    * @param  string $positionId   positionId
    * @return Collection Candidate Model
    */
    public function scopePositionId($query, $positionId){
    	if(is_numeric($positionId)){
    		return $query->where('position_id', $positionId);
    	}
    	return $query;
    }

    /**
    * Tìm kiếm theo ngày nộp đơn
    * @param  [type] $query [description]
    * @param  string $date_apply   date_apply
    * @return Collection Candidate Model
    */
    public function scopeDateApply($query, $dateApply){
    	if($dateApply){
    		return $query->where('date_apply', $dateApply);
    	}
    	return $query;
    }

    /**
    * Tìm kiếm theo ngày phỏng vấn
    * @param  [type] $query [description]
    * @param  string $time_interview   time_interview
    * @return Collection Candidate Model
    */
   	public function scopeTimeInterview($query, $timeInterview){
   		if($timeInterview){
   			return $query->where('time_interview', $timeInterview);
   		}
   		return $query;
   	}
}
