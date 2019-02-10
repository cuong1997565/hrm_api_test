<?php

namespace App\Repositories\Contracts;

trait PresentationTrait
{
	/**
	 * [getStatus description]
	 * @return [type] [description]
	 */
	public function getStatus()
	{
		return self::DISPLAY_STATUS[$this->status ?? self::STANDARD];
	}

	/**
	 * [getType description]
	 * @return [type] [description]
	 */
	public function getType()
	{
		return self::DISPLAY_TYPE[$this->type ?? self::TRAINING];
	}

	public function getFormatDateSign()
	{
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_sign)->format('d-m-Y');
	}

	public function getFormatDateEffective()
	{
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_effective)->format('d-m-Y');
	}

	public function getFormatDateExpiration()
	{
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_expiration)->format('d-m-Y');
	}
}
