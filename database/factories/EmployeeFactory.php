<?php

/*
|--------------------------------------------------------------------------
| User Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\Repositories\Employees\Employee;

$allGender = Employee::ALL_GENDER;
$allStatus = Employee::ALL_STATUS;

$factory->define(Employee::class, function (Faker\Generator $faker) use ($allGender, $allStatus) {
    return [
            'name'              => $faker->name,
            'email'             => $faker->unique()->freeEmail,
            'qualification'  => $faker->randomElement(['Đại học', 'Cao đẳng', 'Trung cấp']),
            'phone'          => '0'.$faker->numberBetween($min = 100000000, $max = 999999999),
            'address'        => $faker->address,
            'date_of_birth'  => $faker->date($format = 'Y-m-d', $max = '-18 years'),
            'gender'         => $faker->randomElement($allGender),
            'status'         => $faker->randomElement($allStatus)
    ];
});
