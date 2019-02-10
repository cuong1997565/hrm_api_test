<?php

namespace App\Repositories\Employees;

use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Positions\PositionRepository;
use App\Repositories\Contracts\ContractRepository;
trait FilterTrait
{
     /**
    * Tìm kiếm theo tên, email, mã nhân viên, số điện thoại
    * @param  [type] $query [description]
    * @param  string $q     name, email, code, phone
    * @return Collection Employee Model
    */
    public function scopeQ($query, $q){
        if($q){
           return $query->where('name', 'like', "%${q}%")
            ->orWhere('email', 'like', "%${q}%")
            ->orWhere('code', 'like', "%${q}%")
            ->orWhere('phone', 'like', "%${q}%");
        }
        return $q;
    }

    public function scopeDepartmentID ($query, $departmentId) {
        if(is_numeric($departmentId)){
            $department = app()->make(DepartmentRepository::class)
                              ->getByQuery(['id' => $departmentId],-1)->pluck('id');
            return $query->whereHas('departments' , function($query) use ($department){
                $query->whereIn('id', $department);
            });
        }
        //select * from  project_hrm_test.department_employee where department_id = 29
        return $query;
    }


    public function scopePositionID ($query, $positionId){
        if(is_numeric($positionId)){
            $position = app()->make(PositionRepository::class)
                             ->getByQuery(['id' => $positionId],-1)->pluck('id');
            return $query->whereHas('positions' , function($query) use ($position){
                $query->whereIn('id', $position);
            });
        }

        return $query;
    }
//     SELECT
//     *
// FROM
//     employees
// WHERE
//     id IN (SELECT
//             employee_id
//         FROM
//             project_hrm_test.department_employee
//         WHERE
//             position_id = 4)
}
