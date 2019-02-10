<?php

use Carbon\Carbon;
use App\Repositories\Candidates\Candidate;

$arrayStatus = Candidate::ALL_STATUS;

$factory->define(Candidate::class, function (Faker\Generator $faker) use ($arrayStatus) {
    $allPlanId     = \App\Repositories\Plans\Plan::all()->pluck('id')->toArray();
    $allPositionId = \App\Repositories\Positions\Position::all()->pluck('id')->toArray();
    $year  = rand(2014, 2018);
    $month = rand(1, 12);
    $day   = rand(1, 28);
    $hour  = rand(7, 17);
    $minute = $faker->randomElement([00, 15, 30, 45]);
    $date   = Carbon::create($year, $month, $day, $hour, $minute, 0);

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->freeEmail,
        'phone'          => '0'.$faker->randomNumber($nbDigits = 9),
        'source'         => 'https://drive.google.com/'.$faker->slug,
        'date_apply'     => $date->format('Y-m-d'),
        'time_interview' => $date->addDays(rand(1, 14))->format('Y-m-d H:i:s'),
        'plan_id'        => $faker->randomElement($allPlanId),
        'position_id'    => $faker->randomElement($allPositionId),
        'status'         => $faker->randomElement($arrayStatus)
    ];
});
