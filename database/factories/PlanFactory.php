<?php

use Carbon\Carbon;
use App\Repositories\Plans\Plan;

$allStatus = Plan::ALL_STATUS;

$factory->define(Plan::class , function (Faker\Generator $faker) use ($allStatus) {
    $year = rand(2014, 2018);
    $month = rand(1, 12);
    $day   = rand(1, 28);
    $date  = Carbon::create($year,$month ,$day, 0, 0, 0);

    return [
        'title'      => 'Kế hoạch '.$faker->jobTitle,
        'date_start' => $date->format('Y-m-d'),
        'date_end'   => $date->addMonths(rand(1, 2))->format('Y-m-d'),
        'content'    => $faker->realText($maxNbChars = 200),
        'status'     => $faker->randomElement($allStatus)
    ];
});


