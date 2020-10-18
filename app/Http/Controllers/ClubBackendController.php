<?php

namespace App\Http\Controllers;

use App\Models\Config\Config;
use App\Models\Match\Match;
use App\Models\Match\Sport;
use App\Models\Slide\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubBackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:club');
    }

    public function index() {
        #all slider for frontend
        $slides = Slide::where("status",1)->get();

        #Config data send to frontend.
        $config = Config::first();
        //return count($slides);

        /*Upcoming match*/
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->get();

        return view("club.home", compact('slides',"config","upcomingMatches"));
    }


}
