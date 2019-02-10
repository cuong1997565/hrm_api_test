<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\PlanDetails\PlanDetail;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Http\Transformers\PlanDetailTransformer;

class PlanDetailController extends ApiController
{
    protected $validationRules = [
        // 'plan_id'           => 'exists:plans,id',
        'department_id'     => 'exists:departments,id',
        'position_id'       => 'exists:positions,id',
    ];
    protected $validationMessages = [
        // 'plan_id.exists'         => 'Kế hoạch không tồn tại trên hệ thống',
        'department_id.exists'   => 'Phòng ban không tồn tại trên hệ thống',
        'position_id.exists'     => 'Chức danh không tồn tại trên hệ thống',
    ];

    /**
     * PlanDetailController constructor.
     * @param PlanDetailRepository $planDetail
     */
    public function __construct(PlanDetailRepository $planDetail)
    {
        $this->planDetail = $planDetail;
        $this->setTransformer(new PlanDetailTransformer);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
       // $this->authorize('plan.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->planDetail->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
           // $this->authorize('plan.view');
            return $this->successResponse($this->planDetail->getById($id));
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
        try {
           // $this->authorize('plan.create');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->planDetail->store($request->all());

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
        // $this->validationRules['title'] .= ',' . $id;
        try {
           // $this->authorize('plan.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->planDetail->update($id, $request->all());

            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this    ->errorResponse([
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
            //$this->authorize('plan.delete');
            $this->planDetail->delete($id);

            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
