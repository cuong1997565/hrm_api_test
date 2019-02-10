<?php

use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $userId = \App\User::all()->pluck('id')->toArray();
        $maxUserId = max(array_values($userId));
        factory(\App\Repositories\Candidates\Candidate::class, 50)->create()->each(function($candidate) use ($maxUserId) {
            for($i = 0; $i <= rand(1, 3); $i++) {
                $candidate->employees()->sync(rand(2, $maxUserId));
            }
        });

    }
}
