<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BetoptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('betoptions')->insert([
            'betOptionName' => 'To win the toss',
            'sport_id' => 1,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('betoptions')->insert([
            'betOptionName' => 'To win the match',
            'sport_id' => 1,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('betoptions')->insert([
            'betOptionName' => '1st ball of first innings',
            'sport_id' => 1,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('betoptions')->insert([
            'betOptionName' => 'Half time result',
            'sport_id' => 2,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('betoptions')->insert([
            'betOptionName' => 'Full time result',
            'sport_id' => 2,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('betoptions')->insert([
            'betOptionName' => '1st goal of this match',
            'sport_id' => 2,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('betoptions')->insert([
            'betOptionName' => '1st red card of this match',
            'sport_id' => 2,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
