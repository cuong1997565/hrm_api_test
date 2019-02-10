<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Candidates\Candidate;
use App\Repositories\Candidates\CandidateRepository;
use App\Http\Transformers\CandidateTransformer;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class CandidateController extends ApiController
{
    protected $validationRules = [
        'name'              => 'required',
        'email'             => 'required|email',
        'phone'             => 'nullable|digits_between:10,12',
        'source'            => 'nullable|url',
        'date_apply'        => 'required|date',
        'plan_id'           => 'required|exists:plans,id',
        'position_id'       => 'required|exists:positions,id',
        // 'time_interview' => 'datetime',
        'interview_by'      => 'array|exists:employees,id',
        'status'            => 'in:',
    ];
    protected $validationMessages = [
        'name.required'             => 'Tên ứng viên không được để trống',
        'email.required'            => 'Email không được để trống',
        'email.email'               => 'Email không đúng định dạng',
        'phone.digits_between'      => 'Số điện thoại không hợp lệ',
        'source.url'                => 'Source không hợp lệ',
        'date_apply.required'       => 'Ngày nộp hồ sơ không được để trống',
        'date_apply.date'           => 'Ngày nộp hồ sơ không hợp lệ',
        'plan_id.required'          => 'Kế hoạch không được để trống',
        'plan_id.exists'            => 'Kế hoạch không tồn tại trên hệ thống',
        'position_id.required'      => 'Chức danh không được để trống',
        'position_id.exists'        => 'Chức danh không tồn tại trên hệ thống',
        //'time_interview.datetime' => 'Thời gian phỏng vấn không hợp lệ',
        'interview_by.array'        => 'Người phỏng vấn không hợp lệ',
        'interview_by.exists'       => 'Người phỏng vấn không tồn tại trên hệ thống',
        'status.in'                 => 'Trạng thái không hợp lệ',
    ];

    /**
     * PlanController constructor.
     * @param PlanRepository $plan
     */
    public function __construct(CandidateRepository $candidate)
    {
        $this->candidate = $candidate;
        $this->setTransformer(new CandidateTransformer);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $this->authorize('candidate.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->candidate->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('candidate.view');
            return $this->successResponse($this->candidate->getById($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
             throw $e;
        } catch (\Throwable $t) {
             throw $t;
        }
    }

    public function store(Request $request)
    {
        $this->validationRules['status'] .= $this->candidate->getAllStatus();
        try {
            $this->authorize('candidate.create');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->candidate->store($request->all());

            return $this->successResponse($data);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function update($id, Request $request)
    {
        $this->validationRules['status'] .= $this->candidate->getAllStatus();
        try {
            $this->authorize('candidate.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->candidate->update($id, $request->all());

            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function destroy($id)
    {
        try{
            $this->authorize('candidate.delete');
            $this->candidate->delete($id);

            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
    public function import(Request $request)
    {

    }

    public function export($type)
    {
    }

    public function download($type)
    {

    }
}
