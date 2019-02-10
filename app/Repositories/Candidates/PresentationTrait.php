<?php

namespace App\Repositories\Candidates;

trait PresentationTrait
{
	/**
	 * [getStatus description]
	 * @return [type] [description]
	 */
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::CREATED];
    }

    /**
     * [getType description]
     * @return [type] [description]
     */
    public function getType()
    {
        return self::DISPLAY_TYPE[$this->status ?? self::TRAINING];
    }

    public function getFormatDateApply()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_apply)->format('d-m-Y');
    }    

    public function getFormatTimeInterview()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->time_interview)->format('d-m-Y H:i');
    }
}
