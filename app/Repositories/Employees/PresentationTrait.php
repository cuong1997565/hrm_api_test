<?php

namespace App\Repositories\Employees;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Storage;

trait PresentationTrait
{
    /**
     * [getGender description]
     * @return [type] [description]
    */
    public function getGender(){
        return self::DISPLAY_GENDER[$this->gender ?? self::FEMALE];
    }

    /**
     * [getStatus description]
     * @return [type] [description]
    */
    public function getStatus(){
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
    }

    public function getAvatar(){
        $avatar = new Avatar(config('avatar'));
        $issetImg =  Storage::disk('local')->exists($this->avatar);
        return ($this->avatar && $issetImg) ?
        app('url')->asset($this->imgPath . '/' . $this->avatar) :
        $avatar->create($this->name)->toBase64()->encoded;
    }

     /**
     * [date description]
     * @return [type] [description]
    */
     public function getFormatDateOfBirth(){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->format('d-m-Y');
     }



}
