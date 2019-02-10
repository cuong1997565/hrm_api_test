<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Contract extends Entity
{
    use FilterTrait, PresentationTrait;

    const STANDARD      = 0;
    const TERMINATE     = 1;
    const RENEW         = 2;

    const ALL_STATUS = [
        self::STANDARD,
        self::TERMINATE,
        self::RENEW
    ];

    const DISPLAY_STATUS = [
        self::STANDARD      => 'Tiêu chuẩn',
        self::TERMINATE     => 'Chấm dứt',
        self::RENEW         => 'Gia hạn'
    ];

    const TRAINING              = 0;
    const COLLABORATOR          = 1;
    const PROBATION             = 2;
    const FORMAL_TERM           = 3;
    const FORMAL_WITHOUT_TERM   = 4;
    const OTHER                 = 5;

    const ALL_TYPE = [
        self::TRAINING,
        self::COLLABORATOR,
        self::PROBATION,
        self::FORMAL_TERM,
        self::FORMAL_WITHOUT_TERM,
        self::OTHER
    ];
    const DISPLAY_TYPE = [
        self::TRAINING              => 'Học việc',
        self::COLLABORATOR          => 'Cộng tác viên',
        self::PROBATION             => 'Thử việc',
        self::FORMAL_TERM           => 'Có thời hạn',
        self::FORMAL_WITHOUT_TERM   => 'Không thời hạn',
        self::OTHER                 => 'Khác'
    ];

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'link',
        'date_sign',
        'date_effective',
        'date_expiration',
        'employee_id',
        'status'
    ];

    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->code = hashid_encode($model->id);
            $model->save();
        });
    }

    /**
     * Relationship with Employee
     */
    public function employee()
    {
        return $this->belongsTo(\App\Repositories\Employees\Employee::class);
    }
}
