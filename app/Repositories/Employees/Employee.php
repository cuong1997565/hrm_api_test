<?php

namespace App\Repositories\Employees;

use App\Repositories\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Entity {
	use SoftDeletes, FilterTrait, PresentationTrait;

	const FEMALE 	= 0;
	const MALE 		= 1;
	const OTHER 	= 2;

	const ALL_GENDER = [
		self::FEMALE,
		self::MALE,
		self::OTHER
	];
	const DISPLAY_GENDER = [
		self::FEMALE 	=> 'Nữ',
		self::MALE 		=> 'Nam',
		self::OTHER 	=> 'Khác'
	];

	const DISABLE 	= 0;
	const ENABLE	= 1;

	const ALL_STATUS = [
		self::DISABLE,
		self::ENABLE
	];
	const DISPLAY_STATUS = [
		self::DISABLE 	=> 'Không kích hoạt',
		self::ENABLE 	=> 'Kích hoạt'
	];

	protected $date = ['deleted_at'];

	/**
     * Full path of images.
    */
	public $imgPath = 'storage/images/employees';

	/**
     * Physical path of upload folder.
    */
	public $uploadPath = 'app/public/images/employees';

    public $imgWidth = 1024;
    public $imgHeight = 500;

	protected $fillable = [
		'name',
		'qualification',
		'address',
		'phone',
		'gender',
		'date_of_birth',
		'email',
		'avatar',
		'status'
	];
	//tự động render 10 ký tự code
	public static function boot(){
		parent::boot();
		self::created(function ($model) {
			$model->code = hashid_encode($model->id);
			$model->save();
		});
	}

	/**
	 * Kiểm tra xem nhân viên đã có tài khoản đăng nhập chưa
	 * @param  int  $id id
	 * @return boolean     [description]
	*/
	public function hasAccount(int $id)
	{
		$employee = app()->make(EmployeeRepository::class)->getById($id)->email;
		return \App\User::where('email', $employee)->first();
	}


	/**
	 * Relationship with Department
	*/

	public function departments(){
		return $this->belongsToMany(\App\Repositories\Departments\Department::class, 'department_employee')
		->withPivot(['position_id', 'status']);
	}

	/**
	 * Relationship with Positions
	*/
	public function positions(){
		return $this->belongsToMany(\App\Repositories\Positions\Position::class, 'department_employee')
		->withPivot(['department_id', 'status']);
	}

	/**
	 * Relationship with Contract
	*/
	public function contracts(){
		return $this->hasMany(\App\Repositories\Contracts\Contract::class);
	}

	/**
	 *  Relationship with Candidate
	*/
	public function candidates(){
		return $this->belongsToMany(\App\Repositories\Candidates\Candidate::class, 'interview', 'interview_by', 'candidate_id');
	}

}
