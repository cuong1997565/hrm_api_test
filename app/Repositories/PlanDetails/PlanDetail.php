<?php

namespace App\Repositories\PlanDetails;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class PlanDetail  extends Entity
{
    //use FilterTrait, PresentationTrait;
    public $timestamps = false;
    /**
     * Fillable definition
     * @var array
    */

    protected $fillable = [
        'plan_id',
        'department_id',
        'position_id',
        'quantity'
    ];

    /**
     * Relationship with Plan
    */
    public function plan(){
        return $this->belongsTo(\App\Repositories\Plans\Plan::class);
    }

    /**
     * Relationship with Departments
    */
    public function department(){
        return $this->belongsTo(\App\Repositories\Departments\Department::class);
    }

    /**
     * Relationship with Positions
    */
   public function position(){
        return $this->belongsTo(\App\Repositories\Positions\Position::class);
   }



}