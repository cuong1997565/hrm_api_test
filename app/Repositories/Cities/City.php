<?php

namespace App\Repositories\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use FilterTrait;
    /**
     * Disable timestamps
     * @var boolean
     */

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = ['name', 'slug', 'zipcode', 'order', 'status'];


    /**
     * Relationship with district
     * @return [type] [description]
     */
    public function districts()
    {
        return $this->hasMany(\App\Repositories\Districts\District::class);
    }

    /**
     * Relationship with Branch
     */
    public function branches()
    {
        return $this->hasMany(\App\Repositories\Branches\Branch::class);
    }

    /**
     * Relationship with user
     * @return [type] [description]
     */
    // public function users()
    // {
    //     return $this->hasMany(\App\User::class);
    // }
}
