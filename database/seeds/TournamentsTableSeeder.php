<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournaments')->insert([
            'sport_id' => 1,
            'tournamentName' => "T20 cricket world cup, 2020",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('tournaments')->insert([
            'sport_id' => 1,
            'tournamentName' => "Indian premier league,2020",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('tournaments')->insert([
            'sport_id' => 2,
            'tournamentName' => "Fifa world cup ,2020",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('tournaments')->insert([
            'sport_id' => 2,
            'tournamentName' => "Uefa champions league ,2020",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
