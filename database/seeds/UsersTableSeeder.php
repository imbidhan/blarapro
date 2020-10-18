<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'club_id' => 1,
            'name' => 'Demo User',
            'username' => 'demo',
            'email' => 'demo@gmail.com',
            'password' => bcrypt('12345678'),
            'sponsorName' => "",
            'phone' => "01829600478",
            'country' => "Bangladesh",
            'totalBalance' => 0.0,
            'totalRegularDepositAmount' => 0.0,
            'totalSpecialDepositAmount' => 0.0,
            'totalCoinReceiveAmount' => 0.0,
            'totalSponsorAmount' => 0.0,
            'totalProfitAmount' => 0.0,
            'totalCoinTransferAmount' => 0.0,
            'totalLossAmount' => 0.0,
            'totalWithdrawAmount' => 0.0,
            //'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
