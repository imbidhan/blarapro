<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDepositTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masterdeposits')->insert([
            'totalBalance' => 0.00,
            'totalSiteDeposit' => 100000.00,
            'totalUserRegularDeposit' => 0.00,
            'totalUserSpecialDeposit' => 0.00,
            'totalLossToClub' => 0.00,
            'totalLossToSponsor' => 0.00,
            'totalLossToUser' => 0.00,
            'totalProfitFromUser' => 0.00,
            'totalPartialFromUser' => 0.00,
            'totalWithdrawFromUser' => 0.00,
            'totalWithdrawFromClub' => 0.00,
            'totalWithdrawFromSite' => 0.00,
        ]);
    }
}
