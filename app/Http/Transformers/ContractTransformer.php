<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Contracts\Contract;

class ContractTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'employee'
    ];

    public function transform(Contract $contract = null)
    {
        if (is_null($contract)) {
            return [];
        }

        return [
            'id'                     => $contract->id,
            'code'                   => $contract->name,
            'title'                  => $contract->title,
            'link'                   => $contract->link,
            'type'                   => $contract->type,
            'type_txt'               => $contract->getType(),
            'status'                 => $contract->status,
            'status_txt'             => $contract->getStatus(),
            'date_sign'              => $contract->date_sign,
            'date_sign_format'       => $contract->date_sign ? $contract->getFormatDateSign() : '',
            'date_effective'         => $contract->date_effective,
            'date_effective_format'  => $contract->date_effective ? $contract->getFormatDateEffective() : '',
            'date_expiration'        => $contract->date_expiration,
            'date_expiration_format' => $contract->date_expiration ? $contract->getFormatDateExpiration() : '',
            'employee_id'            => $contract->employee_id,
            'employee_name'          => $contract->employee ? $contract->employee->name : '',
            'employee_phone'         => $contract->employee ? $contract->employee->phone : '',
            'created_at'             => $contract->created_at,
            'updated_at'             => $contract->updated_at,
        ];
    }

    public function includeEmployee(Contract $contract = null)
    {
        if (is_null($contract)) {
            return $this->null();
        }

        return $this->item($contract->employee, new EmployeeTransformer);
    }
}
