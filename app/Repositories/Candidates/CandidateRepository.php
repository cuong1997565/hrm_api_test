<?php

namespace App\Repositories\Candidates;

use App\Repositories\BaseRepository;
use App\Events\StoreOrUpdateInterviewEvent;
use App\Repositories\ExcelTrait;
use App\Events\ReadCandidateImportEvent;

class CandidateRepository extends BaseRepository
{
    // use ExcelTrait;
    /**
     * Candidate model.
     * @var Model
     */
    protected $model;

    /**
     * CandidateRepository constructor.
     * @param Candidate $candidate
     */
    public function __construct(Candidate $candidate)
    {
        $this->model = $candidate;
    }

    /**
     * Lấy tất cả giá trị hợp lệ của trạng thái
     * @return string
     */
    public function getAllStatus()
    {
        return implode(',', Candidate::ALL_STATUS);
    }

    /**
     * Lưu thông tin 1 ứng viên
     * Có thẵ đặt lịch phỏng vấn cho ứng viên này
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function store($data)
    {
        $candidate = parent::store($data);
        $interviewBy = array_get($data, 'interview_by', []);
        if (count($interviewBy)) {
            event(new StoreOrUpdateInterviewEvent($candidate, $interviewBy));
        }
        return $candidate;
    }

    /**
     * Cập nhật thông tin ứng viên
     * Có thể cập nhật lại lịch phỏng vấn cho ứng viên này
     * @param  [type] $id      [description]
     * @return [type]          [description]
     */
    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = parent::update($id, $data);
        $interviewBy = array_get($data, 'interview_by', []);
        if (count($interviewBy)) {
            event(new StoreOrUpdateInterviewEvent($record, $interviewBy));
        }
        return $record;
    }

    public function import($path)
    {
        $pathFile = $this->storeFile($path);
        event(new ReadCandidateImportEvent($pathFile));
    }
}
