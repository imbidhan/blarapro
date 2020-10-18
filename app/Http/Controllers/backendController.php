<?php

namespace App\Http\Controllers;

use App\Models\Betplace\Betplace;
use App\Models\Club\Club;
use App\Models\Match\Match;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Match\Betdetail;
use App\Models\Match\Matchbetoption;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Deposit\Userdeposit;
use Illuminate\Support\Facades\DB;
class backendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $onlineUserCount    = DB::table("users")->where("status",1)->get()->count();
        $todayNewUser       = DB::table("users")->whereDate('created_at', Carbon::today())->get()->count();
        $todayBetUserCount  = DB::table("betplaces")->whereDate('created_at', Carbon::today())->get()->unique("user_id");
        $todayMatchCount    = DB::table("matches")->whereDate('matchDateTime', Carbon::today())->get()->count();
        $tomorrowMatchCount = DB::table("matches")->whereDate('matchDateTime', Carbon::tomorrow())->get()->count();
        $todayDeposit       = DB::table("userdeposits")->where("depositType","getmoney")->whereDate('updated_at', Carbon::today())->get()->sum("depositAmount");
        $todayCoinToCoin    = DB::table("userdeposits")->where("depositType","cointocoin")->whereDate('updated_at', Carbon::today())->get()->sum("depositAmount");
        $todayUnpaid        = DB::table("userdeposits")->where("depositType","unpaid")->whereDate('updated_at', Carbon::today())->get()->sum("depositAmount");

        $criLives = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereIn('matches.status',[2,3])
            ->where("matches.sport_id",1)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $footballLives = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereIn('matches.status',[2,3])
            ->where("matches.sport_id",2)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $basketLives = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereIn('matches.status',[2,3])
            ->where("matches.sport_id",3)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $volleyLives = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereIn('matches.status',[2,3])
            ->where("matches.sport_id",4)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $tennisLives = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereIn('matches.status',[2,3])
            ->where("matches.sport_id",5)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $upcomingMatches = DB::table('matches')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->where('matches.status',1)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        return view('backend.pages.home.home',compact('onlineUserCount','todayNewUser','todayBetUserCount','todayMatchCount','tomorrowMatchCount','todayDeposit','todayCoinToCoin','todayUnpaid','criLives',"footballLives","basketLives","volleyLives","tennisLives","upcomingMatches"));
    }
}
