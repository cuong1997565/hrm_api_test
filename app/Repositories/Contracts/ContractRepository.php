<?php

namespace App\Repositories\Contracts;

use App\Repositories\BaseRepository;

class ContractRepository extends BaseRepository
{
    /**
     * Contract model.
     * @var Model
     */
    protected $model;

    /**
     * ContractRepository constructor.
     * @param Contract $contract
     */
    public function __construct(Contract $contract)
    {
        $this->model = $contract;
    }

    /**
     * Lấy tất cả giá trị hợp lệ của trạng thái
     * @return string
     */
    public function getAllStatus()
    {
        return implode(',', Contract::ALL_STATUS);
    }

    /**
     * Lấy tất cả giá trị hợp lệ của loại hợp đồng
     * @return string
     */
    public function getAllType()
    {
        return implode(',', Contract::ALL_TYPE);
    }
}
