<?php
namespace App\Repositories\Employees;
use App\Repositories\BaseRepository;
use App\Repositories\Users\UserRepository;
use App\Events\StoreContractEmployeeEvent;
use App\Events\UpdateContractEmployeeEvent;
use App\Events\StoreOrUpdateDepartmentEmployeeEvent;
use App\Events\StoreAccountForEmployeeEvent;
use App\Repositories\UploadTrait;

class EmployeeRepository extends BaseRepository
{
    use UploadTrait;
    protected $model;
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    /**
     * Lấy tất cả giá trị hợp lệ của giới tính
     * @return string
    */
    public function getAllGender(){
        return implode(',', Employee::ALL_GENDER);
    }

    /**
     * Lấy tất cả giá trị hợp lệ của trạng thái
     * @return string
     */
    public function getAllStatus()
    {
        return implode(',', Employee::ALL_STATUS);
    }

     /**
     * Lưu thông tin 1 nhân viên mói
     * Có thể thêm kèm 1 (hoặc nhiều) phòng ban (chức danh) cho nhân viên này
     * Có thể thêm kèm 1 hợp đồng cho nhân viên này
     * Có thể tạo 1 tài khoản đăng nhập cho nhân viên này
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function store($data){
        //add employee
        $employee = parent::store($data);
        //add department
        $departments = array_get($data, 'departments', []);
        if (count($departments)) {
            event(new StoreOrUpdateDepartmentEmployeeEvent($employee, $departments));
        }
        // //add contracts
        $contracts = array_get($data, 'contracts', []);
        $contractTitle = array_get($contracts, 'title', []);
        if(count($contracts) && $contractTitle){
            event(new StoreContractEmployeeEvent($employee, $contracts));
        }

        $password = array_get($data, 'password', '');
        if($password){
            event(new StoreAccountForEmployeeEvent($employee, $password));
        }
        return $employee;
    }

     /**
     * Cập nhật thông tin 1 nhân viên
     * Có thể cập nhật lại chức danh phòng ban (chức danh) cho nhân viên này
     * @param  [type] $id      [description]
     * @param  [type] $data    [description]
     * @return [type]          [description]
     */
    public function update($id, $data, $excepts = [], $only = []){
        $record = parent::update($id, $data);
        $departments = array_get($data, 'departments', []);
        if(count($departments)){
            event(new StoreOrUpdateDepartmentEmployeeEvent($record, $departments));
        }
        return $record;
    }
}