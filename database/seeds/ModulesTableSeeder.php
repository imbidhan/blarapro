<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'module_name' => 'Settings',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Vat Tax',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Slider',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Api Slider',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Shipping',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Admin Shipping',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Brand',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Subscribe',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Product',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'module_name' => 'Product Api',
            'module_prefix' => 'admin/settings/access-level',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
