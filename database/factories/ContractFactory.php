<?php

use Carbon\Carbon;
use App\Repositories\Contracts\Contract;

$allType   = Contract::ALL_TYPE;
$allStatus = Contract::ALL_STATUS;

$factory->define(Contract::class, function (Faker\Generator $faker) use ($allType, $allStatus ) {
	$year  = rand(2014, 2018);
	$month = rand(1, 12);
	$day   = rand(1, 28);
	$date  = Carbon::create($year,$month ,$day, 0, 0, 0);

	return [
		'title'           => 'Hợp đồng '.$faker->jobTitle,
		'type'            => $faker->randomElement($allType),
		'date_sign'       => $date->format('Y-m-d'),
		'date_effective'  => $date->format('Y-m-d'),
		'date_expiration' => $date->addMonths($month)->format('Y-m-d'),
		'link'            => 'https://drive.google.com/'.$faker->unique()->slug,
		'status'          => $faker->randomElement($allStatus),
	];
});
