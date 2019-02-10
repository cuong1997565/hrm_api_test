<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng Nhân Sự', 'branch_id' => 1]);
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng IT', 'branch_id' => 1]);
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng Kế toán', 'branch_id' => 1]);
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng Nhân Sự', 'branch_id' => 2]);
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng IT', 'branch_id' => 2]);
        factory(\App\Repositories\Departments\Department::class)->create(['name' => 'Phòng Kế toán', 'branch_id' => 2]);
        factory(\App\Repositories\Departments\Department::class, 50)->create();
    }
}
