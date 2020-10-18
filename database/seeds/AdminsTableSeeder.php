<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'role_id' => 1,
            'name' => 'VK',
            'username' => 'vk',
            'email' => 'g8vk@onbet365.com',
            'phone' => "01341526242",
            'type' => "0",
            //'pcMac' => '2C-41-38-8F-98-C8',
            'password' => bcrypt('12345678'),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
