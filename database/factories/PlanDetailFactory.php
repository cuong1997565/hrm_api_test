<?php

use Carbon\Carbon;

$factory->define(\App\Repositories\PlanDetails\PlanDetail::class , function (Faker\Generator $faker){
    $allDepartmentId = \App\Repositories\Departments\Department::all()->pluck('id')->toArray();
    $allPositionId = \App\Repositories\Positions\Position::all()->pluck('id')->toArray();
    return [
        'department_id' => $faker->randomElement($allDepartmentId),
        'position_id'   => $faker->randomElement($allPositionId),
        'quantity'      => rand(1, 10)
    ];
});