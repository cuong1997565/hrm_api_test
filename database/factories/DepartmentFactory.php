<?php

$factory->define(App\Repositories\Departments\Department::class, function (Faker\Generator $faker) {
	$allBranchId = \App\Repositories\Branches\Branch::all()->pluck('id')->toArray();
	return [
		'name'      => 'Phòng '.$faker->name,
		'branch_id' => $faker->randomElement($allBranchId)
	];
});
