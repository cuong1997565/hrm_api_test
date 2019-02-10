<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Employees\Employee;

class EmployeeTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'departments', 'positions', 'contracts', 'candidates'
    ];

    public function transform(Employee $employee = null)
    {
        if (is_null($employee)) {
            return [];
        }

        return [
            'id'                   => $employee->id,
            'code'                 => $employee->code,
            'has_account'          => $employee->hasAccount($employee->id) ? true : false,
            'name'                 => $employee->name,
            'qualification'        => $employee->qualification,
            'address'              => $employee->address,
            'email'                => $employee->email,
            'phone'                => $employee->phone,
            'date_of_birth'        => $employee->date_of_birth,
            'date_of_birth_format' => $employee->date_of_birth ? $employee->getFormatDateOfBirth() : '',
            'avatar'               => $employee->avatar,
            'avatar_path'          => $employee->getAvatar(),
            'gender'               => $employee->gender,
            'gender_txt'           => $employee->getGender(),
            'status'               => $employee->status,
            'status_txt'           => $employee->getStatus(),
        ];
    }
    public function includeDepartments(Employee $employee = null)
    {
        if (is_null($employee)) {
            return $this->null();
        }
        return $this->collection($employee->departments, new DepartmentTransformer);
    }

    public function includePositions(Employee $employee = null){
        if(is_null($employee)){
            return $this->null();
        }
        return $this->collection($employee->positions, new PositionTransformer);
    }

    public function includeContracts(Employee $employee = null){
        if(is_null($employee)){
            return $this->null();
        }
        return $this->collection($employee->contracts, new ContractTransformer);
    }

    public function includeCandidates(Employee $employee = null){
        if(is_null($employee)){
             return $this->null();
        }
        return $this->collection($employee->candidates, new CandidateTransformer);
    }
}
