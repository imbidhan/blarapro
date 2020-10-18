<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        //$this->call(ModulesTableSeeder::class);
        $this->call(SportsTableSeeder::class);
        //$this->call(TeamsTableSeeder::class);
        //$this->call(TournamentsTableSeeder::class);
        //$this->call(MatchesTableSeeder::class);
        //$this->call(BetoptionsTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
        //$this->call(BkashTableSeeder::class);
        //$this->call(ClubTableSeeder::class);
        $this->call(MasterDepositTableSeeder::class);
        $this->call(MasterDepositDetailTableSeeder::class);
        //$this->call(ScoreTableSeeder::class);
    }
}
