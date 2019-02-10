<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
      {
         $faker = Faker\Factory::create();

        $departmentId = \App\Repositories\Departments\Department::all()->pluck('id')->toArray();
        $positionId = \App\Repositories\Positions\Position::all()->pluck('id')->toArray();
        factory(\App\Repositories\Employees\Employee::class, 50)->create()->each(function ($employee) use ($faker, $departmentId, $positionId) {
            $employee->departments()->sync([
                $faker->randomElement($departmentId) =>[
                   'position_id' => $faker->randomElement($positionId)
                ]
            ]);
             for($i = 0; $i <= rand(1, 2); $i++) {
                $employee->contracts()->save(factory(App\Repositories\Contracts\Contract::class)->make());
            }
      });
    }
}
