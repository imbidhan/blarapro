<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
            'score_id' => 1,
            'sport_id' => 1,
            'tournament_id' => 1,
            'teamOne_id' => 1,
            'teamTwo_id' => 2,
            'matchTitle' => "1st t20 world cup match",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
