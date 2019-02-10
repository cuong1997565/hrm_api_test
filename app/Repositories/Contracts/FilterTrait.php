<?php

namespace App\Repositories\Contracts;

use DB;

trait FilterTrait
{
	/**
	 * Tìm kiếm theo tiêu đề hợp đồng, mã hợp đồng, link chứa hợp đồng
	 * @param  [type] $query [description]
	 * @param  string $q     name, code, link
	 * @return Collection Contract Model
	 */
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('title', 'like', "%${q}%")
			->orWhere('code', 'like', "%${q}%")
			->orWhere('link', 'like', "%${q}%");
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo tên nhân viên
	 * @param  [type] $query  		[description]
	 * @param  int    $employeeId 	employee_id
	 * @return Collection Contract Model
	 */
	public function scopeEmployeeId($query, $employeeId)
	{
		if ($employeeId) {
			return $query->where('employee_id', $employeeId);
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo loại hợp đồng
	 * @param  [type] $query [description]
	 * @param  int    $type  type
	 * @return Collection Contract Model
	 */
	public function scopeType($query, $type)
	{
		if (is_numeric($type)) {
			return $query->where('type', $type);
		}
		return $query;
	}

	/**
	 * Tìm kiếm trong khoảng [ngày ký - ngày hết hạn]
	 * @param  [type] $query    [description]
	 * @param  date   $dateSign date_sign
	 * @return [type]           [description]
	 */
	public function scopeDateSign($query, $dateSign)
	{
		if ($dateSign) {
			return $query->where('date_sign', '>=', $dateSign);
		}
		return $query;
	}
	
	/**
	 * Tìm kiếm trong khoảng [ngày ký - ngày hết hạn]
	 * @param  [type] $query       		[description]
	 * @param  date   $dateExpiration   date_expiration
	 * @return Collection Contract Model
	 */
	public function scopeDateExpiration($query, $dateExpiration)
	{
		if ($dateExpiration) {
			return $query->where('date_expiration', '<=', $dateExpiration);
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo trạng thái
	 * @param  [type] $query  [description]
	 * @param  int    $status status
	 * @return Collection Contract Model
	 */
	public function scopeStatus($query, $status)
	{
		if (is_numeric($status)) {
			return $query->where('status', $status);
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo ngày có hiệu lực của hợp đồng đầu tiên
	 * @param  [type] $query               [description]
	 * @param  [type] $dateOfFirstContract [description]
	 * @return [type]                      [description]
	 */
	public function scopeDateOfFirstContract($query, $dateOfFirstContract)
	{
		if ($dateOfFirstContract) {
			return $query->select(DB::raw('MIN(date_effective) as min, employee_id'))
			->groupBy('employee_id')
			->havingRaw('MIN(date_effective) = ?', [$dateOfFirstContract]);	
		}
		return $query;
	}
}
