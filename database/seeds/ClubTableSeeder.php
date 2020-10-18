<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ClubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            'clubName' => "daynight",
            'username' => "daynight",
            'phone' => "01521415263",
            'email' => "daynight@gmail.com",
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'totalBalance' => 0.00,
            'totalProfit' => 0.00,
            'totalWithdrawAmount' => 0.00,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('clubs')->insert([
            'clubName' => "sunmoon",
            'username' => "sunmoon",
            'phone' => "01566666667",
            'email' => "sunmoon@gmail.com",
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'totalBalance' => 0.00,
            'totalProfit' => 0.00,
            'totalWithdrawAmount' => 0.00,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('clubs')->insert([
            'clubName' => "nightclub",
            'username' => "nightclub",
            'phone' => "01715414785",
            'email' => "nightclub@gmail.com",
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'totalBalance' => 0.00,
            'totalProfit' => 0.00,
            'totalWithdrawAmount' => 0.00,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('clubs')->insert([
            'clubName' => "golden",
            'username' => "golden",
            'phone' => "01641526312",
            'email' => "golden@gmail.com",
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'totalBalance' => 0.00,
            'totalProfit' => 0.00,
            'totalWithdrawAmount' => 0.00,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('clubs')->insert([
            'clubName' => "blackboy",
            'username' => "blackboy",
            'phone' => "01414526369",
            'email' => "blackboy@gmail.com",
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pcMac' => "2C-41-38-8F-98-C8",
            'userInfo' => "Device:Computer - Operation System:Windows 10.0 - Browser:Google Chrome - IP:103.54.43.193 - Containent:Asia - Country: Bangladesh - City:Dhaka - Latitude:23.726 - Longitude:90.4251 - Timezone:Asia/Dhaka",
            'totalBalance' => 0.00,
            'totalProfit' => 0.00,
            'totalWithdrawAmount' => 0.00,
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
