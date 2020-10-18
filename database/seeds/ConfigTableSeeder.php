<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'siteNotice' => "Dear users minimum deposit 200, maximum 25000 & Minimum withdraw 300 maximum 25000.Bet cash limit 20 to 6000 .Happy Betting.",
            'depositMsg' => "User deposit Time at 9:00 AM To 8:00 PM",
            'betMinimum' => 20,
            'betMaximum' => 6000,
            'depositMinimum' => 200,
            'depositMaximum' => 25000,
            'coinTransferMinimum' => 20,
            'coinTransferMaximum' => 4000,
            'userWithdrawMinimum' => 300,
            'userWithdrawMaximum' => 2500,
            'clubRate' => 3.00,
            'sponsorRate' => 1.50,
            'partialOne' => 5.00,
            'partialTwo' => 3.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
