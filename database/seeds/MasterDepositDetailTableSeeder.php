<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MasterDepositDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masterdepositdetails')->insert([
            'depositAmount' => 100000.00,
            'pcMac' => "00-FF-70-AC-D1-0C",
            'created_by' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
