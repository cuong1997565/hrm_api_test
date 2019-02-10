<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(App\Repositories\Branches\Branch::class)->create([
            'name' => 'Chi nhánh Láng Hạ',
            'address' => 'Số 102 Thái Thinh, P.Láng Hạ, Q.Đống Đa, TP.Hà Nội',
            'type' => 1,
            'city_id' => 2,
            'district_id' => 4
        ]);

        factory(App\Repositories\Branches\Branch::class)->create([
            'name' => 'Chi nhánh Cát Linh',
            'address' => 'Số 120 Thái Hà, P.Láng Hạ, Q.Đống Đa, TP.Hà Nội',
            'type' => 0,
            'city_id' => 2,
            'district_id' => 4
        ]);

        factory(App\Repositories\Branches\Branch::class, 50)->create();
    }
}
