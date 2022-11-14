<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ScoreBoardUser;

class ScoreBoardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ScoreBoardUser::factory()->count(5)->create();
    }
}
