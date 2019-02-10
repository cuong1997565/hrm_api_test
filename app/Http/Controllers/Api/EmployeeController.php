<?php

namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use App\Repositories\Employees\EmployeeRepository;
use App\Repositories\Contracts\ContractRepository;
use App\Http\Transformers\EmployeeTransformer;
use App\Rules\DateExpirationRule;

class EmployeeController extends ApiController
{
       protected $validationRules = [
        'name'                        => 'required',
        'email'                       => 'required|email|unique:employees,email',
        'phone'                       => 'required|digits_between:10,12|unique:employees,phone',
        'date_of_birth'               => 'nullable|date',
        'gender'                      => 'in:',
        'status'                      => 'in:',

        'departments'                 => 'array',
        'departments.*.department_id' => 'required|exists:departments,id',
        'departments.*.position_id'   => 'required|exists:positions,id',
        'departments.*.status'        => 'in:',

        'contracts.type'              => 'in:',
        'contracts.date_sign'         => 'required|date',
        'contracts.date_effective'    => 'required|date',
        'contracts.status'            => 'in:',

        'password'                    => 'min:6|confirmed',
    ];
    protected $validationMessages = [
        'name.required'                        => 'Tên không được để trông',
        'email.required'                       => 'Email không được để trông',
        'email.email'                          => 'Email không đúng ij định dạng',
        'email.unique'                         => 'Email đã tồn tại trên hệ thống',
        'phone.required'                       => 'Số điện thoại không được để trống',
        'phone.digits_between'                 => 'Số điện thoại không hợp lệ',
        'phone.unique'                         => 'Số điện thoại đã tồn tại trên hệ thống',
        'date_of_birth.date'                   => 'Ngày sinh không hợp lệ',
        'gender.in'                            => 'Giới tính không hợp lệ',
        'status.in'                            => 'Trạng thái không hợp lệ',

        'departments.array'                    => 'Phòng ban không hợp lệ',
        'departments.*.department_id.required' => 'Phòng ban không được để trông',
        'departments.*.department_id.exists'   => 'Phòng ban không tồn tại trên hệ thống',
        'departments.*.position_id.required'   => 'Chức danh không được để trông',
        'departments.*.position_id.exists'     => 'Chức danh không tồn tại trên hệ thống',
        'departments.*.status.in'              => 'Trạng thái không hợp lệ',

        'contracts.type.in'                    => 'Loại hợp đồng không hợp lệ',
        'contracts.date_sign.required'         => 'Ngày ký không được để trống',
        'contracts.date_sign.date'             => 'Ngày ký không hợp lệ',
        'contracts.date_effective.required'    => 'Ngày có hiệu lực không được để trống',
        'contracts.date_effective.date'        => 'Ngày có hiệu lực không hợp lệ',
        'contracts.status.in'                  => 'Trạng thái không hợp lệ',

        'password.min'                         => 'Mật khẩu phải có ít nhât :min ký tự',
        'password.confirmed'                   => 'Nhập lại mật khẩu không đúng',
    ];

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(EmployeeRepository $employee)
    {
        $this->employee = $employee;
        $this->setTransformer(new EmployeeTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $this->authorize('employee.view');
       $pageSize = $request->get('limit', 25);
       return $this->successResponse($this->employee->getByQuery($request->all(), $pageSize));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $this->authorize('employee.view');
            return $this->successResponse($this->employee->getById($id));
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return $this->notFoundResponse();
        }
        catch (Exception $e) {
            throw $e;
        }
        catch (\Throwable $t){
            throw $t;
        }
    }

    public function store(Request $request)
    {
        $this->validationRules['email'] .= '|unique:users,email';
        $this->validationRules['gender'] .= $this->employee->getAllGender();
        $this->validationRules['status'] .= $this->employee->getAllStatus();
        $this->validationRules['departments.*.status'] = $this->employee->getAllStatus();
        $this->validationRules['contracts.type'] .= app()->make(ContractRepository::class)->getAllType();
        $this->validationRules['contracts.status'] .= app()->make(ContractRepository::class)->getAllStatus();
        DB::beginTransaction();
        try {
            $this->authorize('employee.create');
            $this->validate($request, [
                'contracts.date_expiration' => new DateExpirationRule($request->contracts['date_sign'], $request->contracts['date_effective'])
            ]);
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->employee->store($request->all());
            DB::commit();
            return $this->successResponse($data);
        }
        catch (\Illuminate\Validation\ValidationException $validationException){
            DB::rollback();
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        catch (\Throwable $t){
            DB::rollback();
            throw $t;
        }

    }

    public function update(Request $request, $id)
    {
        $this->validationRules['email'] .= ',' . $id;
        $this->validationRules['phone'] .= ',' . $id;
        $this->validationRules['gender'] .= $this->employee->getAllGender();
        $this->validationRules['status'] .= $this->employee->getAllStatus();
        $this->validationRules['departments.*.status'] .= $this->employee->getAllStatus();
        unset($this->validationRules['contracts.type']);
        unset($this->validationRules['contracts.date_sign']);
        unset($this->validationRules['contracts.date_effective']);
        unset($this->validationRules['contracts.status']);
        unset($this->validationRules['password']);
        DB::beginTransaction();
        try {
            $this->authorize('employee.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->employee->update($id, $request->all());
            DB::commit();
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $t){
            DB::rollback();
            throw $t;
        }

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->authorize('employee.delete');
            $this->employee->delete($id);
            DB::commit();
            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return $this->notFoundResponse();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $t){
            DB::rollback();
            throw $t;
        }
    }

    public function upload(Request $request)
    {
        try {
            $this->validate($request, [
                'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'file'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ], [
                'files.*.image' => 'File upload không đúng định dạng',
                'files.*.mimes' => 'File upload phải là 1 trong các định dạng: :values',
                'files.*.max'   => 'File upload không thể vượt quá :max KB',
                'file.image'    => 'File upload không đúng định dạng',
                'file.mimes'    => 'File upload phải là 1 trong các định dạng: :values',
                'file.max'      => 'File upload không thể vượt quá :max KB'
            ]);
            $image = $request->file('file');
            if ($request->input('resize')) {
                return $this->employee->upload($image);
            }
            $upload = $this->employee->upload($image, false);
            return $upload;
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return response(['data' => [
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]]);
        }
    }
}
