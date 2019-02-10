<?php

namespace App\Repositories\Plans;

// use Faker\Provider\DateTime;

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

    public function getFormatDateStart()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_start)->format('d-m-Y');
    }

    public function getFormatDateEnd()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_end)->format('m-d-Y');
    }
}
