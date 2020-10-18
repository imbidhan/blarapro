<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            'slideTitle' => "This is slider Title",
            'sliderContent' => 'For joining this website demo text.For joining this website demo text.For joining this website demo text.For joining this website demo text.',
            'slideBtnText' => 'Join',
            'slideBtnLink' => "user/registration",
            'slideImage' => "backend/uploads/slides/default.jpg",
            //'created_by' => 2,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
