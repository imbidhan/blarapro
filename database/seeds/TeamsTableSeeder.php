<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Bangladesh",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "India",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Sri-lanka",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Pakistan",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Australia",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "South africa",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "England",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "New zealand",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Afghanistan",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "West indies",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Zimbabwe",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Ireland",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Royal Challengers Bangalore",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Chennai Super Kings",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Delhi Capitals",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Kings XI Punjab",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Kolkata Knight Riders",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Mumbai Indians",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Rajasthan Royals",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 1,
            'teamName' => "Sunrisers Hyderabad",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Brazil",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Argentina",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Spain",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Belgium",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "France",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Netherlands",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Italy",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Sweden",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Portugal",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Colombia",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Germany",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Paris Saint-Germain",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Manchester City",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Valencia",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Liverpool",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Bayern Munich",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Juventus",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Barcelona",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Chelsea",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Real Madrid",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('teams')->insert([
            'sport_id' => 2,
            'teamName' => "Borussia Dortmund",
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


    }
}
