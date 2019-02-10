<?php

namespace App\Repositories\Branches;

use App\Repositories\BaseRepository;
use App\Repositories\UploadTrait;

class BranchRepository extends BaseRepository
{
    use UploadTrait;
    /**
     * Branch model.
     * @var Model
     */
    protected $model;

    /**
     * BranchRepository constructor.
     * @param Branch $branch
     */
    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }

    /**
     * Lấy tất cả giá trị hợp lệ của trạng thái
     * @return string
     */
    public function getAllStatus()
    {
        return implode(',', Branch::ALL_STATUS);
    }

    /**
     * Cập nhật chi nhánh chính (cũ) thành chi nhánh phụ
     * @return [type] [description]
     */
    public function updateBranchMainOld()
    {
        $branchMain = $this->model->where('type', Branch::MAIN)->first();
        if ($branchMain) {
            parent::update($branchMain->id, ['type' => Branch::NOT_MAIN]);
        }
    }

    /**
     * Lưu thông tin 1 chi nhánh mới
     * Nếu đây là chi nhánh chính thì cập nhật chi nhánh chính (cũ)
     * thành chi nhánh phụ bằng cách gọi function updateBranchMainOld()
     * @param  array $data
     * @return Eloquent
     */
    public function store($data)
    {
        if ($data['type'] == Branch::MAIN) {
            $this->updateBranchMainOld();
        }
        return parent::store($data);
    }

    /**
     * Cập nhật thông tin 1 chi nhánh
     * Nếu đây là chi nhánh chính thì cập nhật chi nhánh chính (cũ)
     * thành chi nhánh phụ bằng cách($id, ['status'  gọi function updateBranchMainOld()
     * @param  integer $id  ID chi nhánh
     * @return bool
     */
    public function update($id, $data, $excepts = [], $only = [])
    {
        if ($data['type'] == Branch::MAIN) {
            $this->updateBranchMainOld();
        }
        return parent::update($id, $data);
    }

    /**
     * Thay đổi trạng thái
     * @param  integer $id ID
     * @return [type]      [description]
     */
    public function changeStatus($id)
    {
        $branch = parent::getById($id);
        if ($branch->status == Branch::ENABLE) {
            return parent::update($id, ['status' => Branch::DISABLE]);
        } else {
            return parent::update($id, ['status' => Branch::ENABLE]);
        }
    }

    /**
     * Thay đổi loại chi nhánh
     * @param  integer $id id
     * @return [type]     [description]
     */
    public function changeBranchMain($id)
    {
        $branch = parent::getById($id);

        if ($branch->type == Branch::NOT_MAIN) {
            $this->updateBranchMainOld();
            return parent::update($id, ['type' => Branch::MAIN]);
        } else {
            return $branch;
        }
    }

    public function upload($file, $resize = true)
    {
        //getClientOriginalExtension :lấy ra đuôi file png hoặc jpg
        $image_name = date('Y_m_d') ."_". md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $this->getUploadImagePath($image_name);
        $upload = Image::make($file->getRealPath())->save($this->getUploadImagePath($image_name));

        return $this->uploadSuccess($image_name);
    }

    protected function getImagePath($img)
    {
        return app('url')->asset($this->model->imgPath . '/' . $img);
    }

    protected function getUploadImagePath($img)
    {
        storage_path($this->model->uploadPath . '/' . $img);
    }

    protected function uploadSuccess($name)
    {
        return [
            'code'    => 1,
            'message' => 'success',
            'data'    => [
                'name' => $name,
                'path' => $this->getImagePath($name)
            ]
        ];
    }
}
