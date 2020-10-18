<?php

namespace App\Http\Controllers;

use App\Models\Betplace\Betplace;
use App\Models\Club\Club;
use App\Models\Config\Config;
use App\Models\Deposit\Masterdeposit;
use App\Models\Match\Match;
use App\Models\Match\Sport;
use App\Models\Withdraw\Clubwithdraw;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
class ClubDashboardController extends Controller
{
    #Club Inplay
    public function clubInplay() {
        #Config data send to frontend.
        /*$config = Config::first();
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->get();
        return view("club.clubinplay",compact("config","upcomingMatches"));*/
    }
    #Club Advance
    public function clubAdvance() {
        $sports = Sport::where("status",1)->get();

        #Config data send to frontend.
        $config = Config::first();

        if(count($sports) > 0){

            foreach($sports as $sport){

                $betCriOptions = DB::table('betoptions')->where('sport_id',$sport->id)
                    ->pluck('betOptionName','id');

                $array = [];
                $matches[] = DB::table('matches')
                    ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
                    ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
                    ->select("matches.id","matches.matchTitle","matches.matchDateTime","matches.status","sports.sportName","tournaments.tournamentName")
                    ->where("matches.sport_id",$sport->id)
                    ->where("matches.status",1)
                    ->orderBy("matches.matchDateTime","ASC")
                    ->get()->map(function($query) use ($betCriOptions,$array){
                        //dd($query);
                        $array['matchTitle'] = $query->matchTitle;
                        $array['matchDateTime'] = $query->matchDateTime;
                        $array['status'] = $query->status;
                        $array['tournamentName'] = $query->tournamentName;
                        $array['sportName'] = $query->sportName;
                        foreach($betCriOptions as $betKey=>$betOption) {
                            //return $betKey;
                            $betdetails = DB::table('betdetails')
                                ->where(['match_id'=>$query->id,'betoption_id'=>$betKey])
                                ->whereIn("status",[0,1])
                                ->get()
                                ->toArray();
                            if(!empty($betdetails)){
                                $array['matchOption'][$betKey]['matchOption'] = $betOption;
                                $array['matchOption'][$betKey]['betDetails'] = $betdetails;
                            }
                        }
                        return $array;
                    })->toArray();
            }

        }
        return view("club.clubadvance",compact("config","matches"));
    }

    #Club profile
    public function clubProfile () {
        $club = Club::where("username",Auth::guard('club')->user()->username)->where("status",1)->first();
        if(empty($club)){
            return redirect("/club/home");
        }
        return view("club.viewprofile",compact("club"));
    }

    #Club follower
    public function clubFollower () {
        $followers = User::where("club_id",Auth::guard('club')->user()->id)->where("status",1)->orderBy("created_at","DESC")->paginate(10);
        if(empty($followers)){
            return redirect("/club/home");
        }
        return view("club.clubfollower",compact("followers"));
    }

    #Club change password
    public function clubChangePassword () {
        return view("club.clubchangepassword");
    }

    #Club update password
    public function clubUpdatePassword (Request $request) {
        $this->validate($request, [
            'oldPassword'           => 'required',
            'password'              => 'required|confirmed|string|min:8',
            'password_confirmation' => 'required',
        ],[
            "oldPassword.required" => "Old password is required",
            "password.required" => "Password is required",
            "password_confirmation.required" => "Confirm password required",
            "password_confirmation.confirmed" => "New and confirm password not match",
        ]);
        try {

            $club = Club::where("username",Auth::guard("club")->user()->username)->where("status",1)->first();

            if(Hash::check(trim(strip_tags($request->oldPassword)), $club->password)) {
                $club->password = bcrypt($request->password);
                $club->update();
                return redirect()->back()->with("success","Password changed Successfully");
            }else{
                return redirect()->back()->with('warning', "Sorry! Your old password not match!");
            }

        }catch(Exception $e){
            return redirect()->back()->with("warning","Something went wrong!");
        }
    }

    #Club holder add new user
    public function addNewUser () {
        return view("club.addnewuser");
    }

    #Club withdraw
    public function clubWithdraw () {
        return view("club.clubwithdraw");
    }

    #Club withdraw store
    public function clubWithdrawStore (Request $request) {

        $this->validate($request,[
            "withdrawAmount" => "required",
            "password" => "required"
        ],[
            "withdrawAmount.required" => "Withdraw amount is required",
            "password.required" => "Password is required",
        ]);

        try{

            #check old and requested new password.
            $club = Club::find(Auth::guard("club")->user()->id);
            if(!Hash::check(trim(strip_tags($request->password)), $club->password)) {
                return redirect()->back()->with('warning', "Sorry! Your password not match!");
            }

            /*Withdraw transfer permission*/
            $config = Config::first();
            if($config->clubWithdrawStatus == 0){
                return redirect()->back()->with('warning', "Sorry! Withdraw not available right now!");
            }

            /*user balance check*/
            if($club->totalBalance < trim(strip_tags($request->withdrawAmount))){
                return redirect()->back()->with('warning', "Sorry! Your balance not enough");
            }

            /*Club withdraw here*/
            $clubWithdraw = new Clubwithdraw();
            $clubWithdraw->club_id = $club->id;
            $clubWithdraw->withdrawAmount      = trim(strip_tags($request->withdrawAmount));
            /*$clubWithdraw->withdrawUserPcMac   = strtok(exec('getmac'), ' ');*/
            $clubWithdraw->save();

            #withdraw club table update
            $club->totalWithdrawAmount = ($club->totalWithdrawAmount + $clubWithdraw->withdrawAmount);
            $club->update();

            #withdraw user table update
            $club->totalBalance = ($club->totalProfit - $club->totalWithdrawAmount);
            $club->update();

            return redirect()->back()->with('success', "Withdraw request successfully.");
        }catch (Exception $e){
            return redirect()->back()->with('warning', "Something went wrong!");
        }
    }

    #Club change password
    public function clubWithdrawHistory () {
        $clubWithdrawHistories = Clubwithdraw::with("club")->where("club_id",Auth::guard("club")->user()->id)->whereIn("status",[0,1])->orderBy("created_at","desc")->paginate(10);
        return view("club.clubwithdrawhistory",compact("clubWithdrawHistories"));
    }

    #Club withdraw cancel
    public function clubWithdrawCancel($id) {
        $clubWithdrawHistory = Clubwithdraw::where("id",$id)->where("status",0)->first();
        $clubWithdrawHistory->withdrawReturnDateTime = Carbon::now();
        $clubWithdrawHistory->status = 2;
        $clubWithdrawHistory->update();

        #withdraw user table update
        $club = Club::where("id",$clubWithdrawHistory->club_id)->where("status",1)->first();

        $club->totalWithdrawAmount = ($club->totalWithdrawAmount - $clubWithdrawHistory->withdrawAmount);
        $club->update();

        #withdraw user table update
        $club->totalBalance = ($club->totalProfit - $club->totalWithdrawAmount);
        $club->update();

        return redirect()->back()->with('success', "Withdraw cancel successfully.");
    }

    #Club income
    public function clubIncomeHistory () {
        $clubIncomes = Betplace::with("user")->where("club_id",Auth::guard("club")->user()->id)->where("status",'!=',5)->orderBy("created_at","DESC")->paginate(10);
        return view("club.clubincomehistory",compact("clubIncomes"));
    }

    #Club new withdraw view
    public function clubNewWithdrawView () {
        $clubWithdrawHistories = Clubwithdraw::with("club")->where("status",0)->get();
        return view("withdraw::Clubwithdraw.request",compact("clubWithdrawHistories"));
    }

    #club withdraw cancel
    public function clubCancelWithdrawView () {
        $clubWithdrawHistories = Clubwithdraw::with("club")->where("status",2)->get();
        return view("withdraw::Clubwithdraw.requestCancel",compact("clubWithdrawHistories"));
    }

    #club withdraw accept
    public function clubNewWithdrawAccept(Request $request, $id) {

        if(empty(trim(strip_tags($request->withdrawType)))){
            Toastr::error("Please Select Withdraw Type","Error!");
            return redirect()->back();
        }

        /*Accept club withdraw*/
        $clubWithdrawHistory = Clubwithdraw::where("id",$id)->where("status",0)->first();
        $clubWithdrawHistory->withdrawType = trim(strip_tags($request->withdrawType));
        $clubWithdrawHistory->withdrawAcceptedBy = Auth::guard("admin")->user()->id;
        /*$clubWithdrawHistory->withdrawAcceptedPcMac = strtok(exec('getmac'), ' ');*/
        $clubWithdrawHistory->status = 1;
        $clubWithdrawHistory->updated_at = Carbon::now();
        $clubWithdrawHistory->update();

        #Update master
        $mainSiteDeposit = Masterdeposit::first();
        $mainSiteDeposit->totalWithdrawFromClub = ($mainSiteDeposit->totalWithdrawFromClub + $clubWithdrawHistory->withdrawAmount);
        $mainSiteDeposit->update();

        Toastr::success("Success! Club Withdraw Accepted", "Success!");
        return redirect()->back();

    }

    #club withdraw accept view
    public function clubAcceptWithdrawView () {
        $clubWithdrawHistories = Clubwithdraw::with("club")->where("status",1)->get();
        return view("withdraw::Clubwithdraw.requestAccept",compact("clubWithdrawHistories"));
    }

}
