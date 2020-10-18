<?php

namespace App\Http\Controllers;

use App\Models\Betplace\Betplace;
use App\Models\Club\Club;
use App\Models\Config\Bkash;
use App\Models\Config\Config;
use App\Models\Deposit\Masterdeposit;
use App\Models\Deposit\Userdeposit;
use App\Models\Match\Betdetail;
use App\Models\Match\Betoption;
use App\Models\Match\Match;
use App\Models\Match\Sport;
use App\Models\Slide\Slide;
use App\User;
use App\Userlogindetail;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Jenssegers\Agent\Agent;
use Exception;
use App\Models\Cointransfer\Cointransfer;
use App\Models\Withdraw\Userwithdraw;
class FrontendController extends Controller
{
    public function test() {

        /*$user = User::where("username",'jihad75')->first();
        return $user;*/

        /*$depositAmount = Userdeposit::where("user_id",469)->where("depositType","getmoney")->where("status",1)->sum("depositAmount");
        return $depositAmount;*/

        /*$coinReceive = Cointransfer::where("touserid",469)->where("status",1)->sum("transferAmount");
        return $coinReceive;*/

        /*$coinTransfer = Cointransfer::where("fromuserid",469)->where("status",1)->sum("transferAmount");
        return $coinTransfer;*/

        /*$withdrawAmount = Userwithdraw::where("user_id",469)->where("status",1)->sum("withdrawAmount");
        return $withdrawAmount;*/

        /*$profit = Betplace::where("user_id",469)->where("status",1)->sum("betAmount");
        return $profit;*/

        /*$lost = Betplace::where("user_id",469)->where("status",2)->sum("betAmount");
        return $lost;*/
/*
        $lost = Betplace::where("user_id",469)->where("status",0)->sum("betAmount");
        return $lost;*/

    }

    #Frontend home page view.
    public function index() {
        #all slider for frontend
        $slides = Slide::where("status",1)->get();

        #Config data send to frontend.
        $config = Config::first();
        //return count($slides);

        /*Upcoming match*/
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->orderBy("matchDateTime","asc")->get();

        return view("frontend.pages.home", compact('slides',"config","upcomingMatches"));
    }

    #HomeTabRefresh
    public function HomeTabRefresh() {

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
                    ->leftJoin('scores', 'scores.id', '=', 'matches.score_id')
                    ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
                    ->select("matches.id","matches.matchTitle","matches.matchDateTime","matches.status","sports.sportName","tournaments.tournamentName","scores.overs","scores.score")
                    ->where("matches.sport_id",$sport->id)
                    ->whereIn("matches.status",[2,3])
                    ->orderBy("matches.matchDateTime","ASC")
                    ->get()->map(function($query) use ($betCriOptions,$array){
                        //dd($query);
                        $array['matchTitle'] = $query->matchTitle;
                        $array['matchDateTime'] = $query->matchDateTime;
                        $array['status'] = $query->status;
                        $array['tournamentName'] = $query->tournamentName;
                        $array['overs'] = $query->overs;
                        $array['score'] = $query->score;
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

            /*$dataList = array(
                'matches' => $matches,
                'config' => $config
            );
            $tabRefreshData = view('frontend.partials.ajax.tabRefresh', $dataList)->render();

            $data = array(
                'tabRefreshData'=>$tabRefreshData,
            );*/

            $dataList = array(
                'matches' => $matches,
                'config' => $config
            );
            return Response::json($dataList);
        }
    }

    #HomeTabRefresh
    public function InPlayTabRefresh() {

        /*$sports = Sport::where("status",1)->get();
        #Config data send to frontend.
        $config = Config::first();

        if(count($sports) > 0){

            foreach($sports as $sport){

                $betCriOptions = DB::table('betoptions')->where('sport_id',$sport->id)
                    ->pluck('betOptionName','id');

                $array = [];
                $matches[] = DB::table('matches')
                    ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
                    ->leftJoin('scores', 'scores.id', '=', 'matches.score_id')
                    ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
                    ->select("matches.id","matches.matchTitle","matches.matchDateTime","matches.status","sports.sportName","tournaments.tournamentName","scores.overs","scores.score")
                    ->where("matches.sport_id",$sport->id)
                    ->whereIn("matches.status",[2,3])
                    ->orderBy("matches.matchDateTime","ASC")
                    ->get()->map(function($query) use ($betCriOptions,$array){
                        //dd($query);
                        $array['matchTitle'] = $query->matchTitle;
                        $array['matchDateTime'] = $query->matchDateTime;
                        $array['status'] = $query->status;
                        $array['tournamentName'] = $query->tournamentName;
                        $array['overs'] = $query->overs;
                        $array['score'] = $query->score;
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

            $dataList = array(
                'matches' => $matches,
                'config' => $config
            );
            $tabRefreshData = view('frontend.partials.ajax.tabRefresh', $dataList)->render();

            $data = array(
                'tabRefreshData'=>$tabRefreshData,
            );

            return Response::json($data);

        }*/
    }

    #show Single Bet Details from frontend modal
    public function showSingleBetDetails($id) {
        $betDetails = Betdetail::with("betoption")->where(["id"=>$id,"status"=>1])->first();

        if($betDetails){
            return $betDetails;
        }else{
            return "Not Found";
        }
    }

    #Store single user bet.
    public function storeSingleUserBet(Request $request) {

        #User login check
        $user = Auth::guard("web")->user();
        $loginCheck = Auth::guard("web")->check();

        #Only web user can bet
        if(empty($user) && empty($loginCheck)) {
            return response()->json(['errorMsg'=>'["error : Login First"]']);
        }

        #Check when this user last bet.
        $betPlace = Betplace::where([
            "user_id" => $user->id,
            "match_id" => trim(strip_tags($request->match_id)),
            "betdetail_id" => trim(strip_tags($request->betDetail_id)),
            "betoption_id" => trim(strip_tags($request->betoption_id)),
        ])->orderBy('created_at', 'desc')->first();

        if(!empty($betPlace)){
            $now = Carbon::now();
            $diff_in_second = $now->diffInSeconds($betPlace->created_at);
            if($diff_in_second < 20){
                return response()->json(['errorMsg'=>'["error : Please wait for sometimes."]']);
            }
        }

        #User Balance Check
        $userTotalBalance = $user->totalBalance;
        $betAmount        = trim(strip_tags($request->betAmount));

        if($userTotalBalance < $betAmount){
            return response()->json(['errorMsg'=>'["error : Amount is too low"]']);
        }

        if($userTotalBalance < 0 || $user->totalRegularDepositAmount < 0 || $user->totalSpecialDepositAmount < 0 || $user->totalCoinReceiveAmount < 0 || $user->totalSponsorAmount < 0 || $user->totalProfitAmount < 0 || $user->totalCoinTransferAmount < 0  || $user->totalLossAmount < 0   || $user->totalWithdrawAmount < 0 ){
            return response()->json(['errorMsg'=>'["error : Account problem contact admin."]']);
        }

        #Check : Is User given betAmount is same as config table minimum bet and maximum bet.
        $config = Config::first();
        if(($betAmount < $config->betMinimum) || ($betAmount > $config->betMaximum) ){
            return response()->json(['errorMsg'=>'["error : Bet range error"]']);
        }

        if($config->betOnOff == 0){
            return response()->json(['errorMsg'=>'["error : Please wait for sometime"]']);
        }

        #Check This Match Is On Live Or Upcoming .
        #Draft = 0;
        #Onbet/upcoming = 1;
        #Live = 2;
        #Done = 3;

        $match = Match::where("id",trim(strip_tags($request->match_id)))->whereIn("status",[1,2,3])->first();
        if(empty($match)){
            return response()->json(['errorMsg'=>'["error : Match not available right now"]']);
        }

        #Check : Is User bet action right bet option which is for live or upcoming match bet option.
        $betDetail = Betdetail::where([
            "id" => trim(strip_tags($request->betDetail_id)),
            "match_id" => trim(strip_tags($request->match_id)),
            "betoption_id" => trim(strip_tags($request->betoption_id)),
            "betRate" => trim(strip_tags($request->betDetailRate)),
            "status" => 1,
        ])->first();

        if(empty($betDetail)){
            return response()->json(['errorMsg'=>'["error : Bet unavailable now close popup"]']);
        }


        try {
            #Place bet Store here
            $betPlace = new Betplace();
            $betPlace->user_id = $user->id;
            $betPlace->betdetail_id = trim(strip_tags($request->betDetail_id));
            $betPlace->match_id = trim(strip_tags($request->match_id));
            $betPlace->betoption_id = trim(strip_tags($request->betoption_id));
            $betPlace->club_id = $user->club_id;
            $betPlace->clubRate = $config->clubRate;
            $betPlace->clubGet = ((trim(strip_tags($request->betAmount)) / 100 ) * $config->clubRate);

            if(!empty($user->sponsorName)) {
                $betPlace->sponsorName = $user->sponsorName;
                $betPlace->sponsorRate = $config->sponsorRate;
                $betPlace->sponsorGet = ((trim(strip_tags($request->betAmount)) / 100) * $config->sponsorRate);
            } else {
                $betPlace->sponsorName = null;
                $betPlace->sponsorRate = null;
                $betPlace->sponsorGet  = null;
            }

            $betPlace->betAmount = trim(strip_tags($request->betAmount));
            $betPlace->betRate   = trim(strip_tags($request->betDetailRate));
            if($match->status == 1){
                $betPlace->winLost   = "match upcoming";
            }elseif($match->status == 2){
                $betPlace->winLost   = "match live";
            }elseif($match->status == 3){
                $betPlace->winLost   = "match live";
            }

            /*$betPlace->pcMac     = strtok(exec('getmac'), ' ');*/
            $betPlace->save();

            $user->totalLossAmount = ($user->totalLossAmount + $betPlace->betAmount);
            $user->update();
            #Update user totalBalance
            $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
            $user->update();

            #Club update
            $club = Club::where("id",$user->club_id)->first();
            $club->totalProfit = ($club->totalProfit +  $betPlace->clubGet);
            $club->update();
            $club->totalBalance = ($club->totalProfit - $club->totalWithdrawAmount);
            $club->update();

            #MasterDeposit update
            $mainSiteDeposit = Masterdeposit::first();
            $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit - $betPlace->clubGet);
            $mainSiteDeposit->totalLossToClub  = ($mainSiteDeposit->totalLossToClub + $betPlace->clubGet);
            $mainSiteDeposit->update();

            if ($betPlace->sponsorName != null) {
                $userSponsor = User::where("username", $betPlace->sponsorName)->first();
                $userSponsor->totalSponsorAmount = ($userSponsor->totalSponsorAmount + $betPlace->sponsorGet);
                $userSponsor->update();

                #User total balance update
                $userSponsor->totalBalance = ($userSponsor->totalRegularDepositAmount + $userSponsor->totalSpecialDepositAmount + $userSponsor->totalCoinReceiveAmount + $userSponsor->totalSponsorAmount + $userSponsor->totalProfitAmount) - ($userSponsor->totalCoinTransferAmount + $userSponsor->totalLossAmount + $userSponsor->totalWithdrawAmount);
                $userSponsor->update();

                #MasterDeposit update
                $mainSiteDeposit = Masterdeposit::first();
                $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit - $betPlace->sponsorGet);
                $mainSiteDeposit->totalLossToSponsor = ($mainSiteDeposit->totalLossToSponsor + $betPlace->sponsorGet);
                $mainSiteDeposit->update();
            }

            return response()->json(['successMsg'=>'["success : Bet successfully done"]']);

        }catch (Exception $e){
            return response()->json(['errorMsg'=>'["error : Bet place not successfully."]']);
        }

    }

    #Single match Details
    public function singleMatchDetails($id) {

        #Config data send to frontend.
        $config = Config::first();

        /*Upcoming match*/
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->where("matchDateTime","asc")->get();

        $match = Match::with("sport","tournament","teamOne","teamTwo")->where('id',$id)->where('status','=',1)->first(); #Get total match.

        if(empty($match)){
            return redirect()->back();
        }

        //dd($match);

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                ->where(['match_id' => $id, 'betoption_id' => $betKey])
                ->whereIn("status",[0,1])
                ->get()
                ->toArray();


                if (!empty($betdetails)) {
                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);

        return view('frontend.pages.singleDetail',compact('config','upcomingMatches','match','optionBetDetails'));
    }

    #Club Single match Details
    public function clubSingleMatchDetails($id) {

        #Config data send to frontend.
        $config = Config::first();

        /*Upcoming match*/
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->get();

        $match = Match::with("sport","tournament","teamOne","teamTwo")->where('id',$id)->where('status','=',1)->first(); #Get total match.

        if(empty($match)){
            return redirect()->back();
        }

        //dd($match);

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                ->where(['match_id' => $id, 'betoption_id' => $betKey])
                ->whereIn("status",[0,1])
                ->get()
                ->toArray();


                if (!empty($betdetails)) {
                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);

        return view('club.clubSingleDetail',compact('config','upcomingMatches','match','optionBetDetails'));
    }

    #In play page view.
    public function inplay() {
        /*#Config data send to frontend.
        $config = Config::first();
        $upcomingMatches = Match::with(['sport','tournament','teamOne','teamTwo'])->where('status',1)->get();
        return view("frontend.pages.inplay",compact("config","upcomingMatches"));*/
    }

    #Advance page view.
    public function advance() {
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
        return view("frontend.pages.advance",compact("config","matches"));
    }

    #My profile page view.
    public function myProfile() {

        $user = User::with("club")
            ->where("username",Auth::guard("web")->user()->username)->where("status",1)->first();
        if(empty($user)){
            return redirect("/");
        }
        return view("frontend.pages.viewprofile",compact("user"));
    }

    #Edit profile page view.
    public function editProfile() {
        $user = User::select("id","username","country","phone")->where("username",Auth::guard("web")->user()->username)->where("status",1)->first();

        if(empty($user)){
            return redirect("/");
        }
        return view("frontend.pages.editprofile",compact("user"));
    }

    #Edit profile page view.
    public function updateProfile(Request $request,$username) {
        /*Validation*/
        $this->validate($request,[
            "country" => "required",
            "phone" => "required",
        ],[
            "country.required" => "Country is required",
            "phone.required" => "Phone is required",
        ]);

        $user = User::where("username",$username)->where("status",1)->first();
        try{
            $user->country = trim(strip_tags($request->country));
            $user->phone = trim(strip_tags($request->phone));
            $user->update();
            return redirect()->back()->with("success","Profile updated now");
        }catch (Exception $e){
            return redirect()->back()->with("warning","Something want wrong!");
        }

    }

    #Change club page view.
    public function changeClub() {
        $user = User::select("id","username","club_id")->where("username",Auth::guard("web")->user()->username)->where("status",1)->first();
        $clubs = Club::where("status",1)->get();
        if(empty($user)){
            return redirect("/");
        }
        return view("frontend.pages.changeclub",compact("clubs","user"));
    }

    #Update club page view.
    public function updateClub(Request $request, $username) {

        $user = User::where("username",$username)->where("status",1)->first();

        /*Validation*/
        $this->validate($request,[
            "club_id" => "required",
            "password" => "required",
        ],[
            "club_id.required" => "Club is required",
            "password.required" => "Password is required",
        ]);

        try{
            if(Hash::check(trim(strip_tags($request->password)), $user->password)) {
                $user->club_id = trim(strip_tags($request->club_id));
                $user->update();
                return redirect()->back()->with("success", "Club successfully changes");
            }else{
                return redirect()->back()->with('warning', "Sorry! Your password not match!");
            }
        }catch (Exception $e){
            return redirect()->back()->with("warning","Something want wrong!");
        }

    }

    #Change club page view.
    public function myFollower() {
        $followers = User::select("username","phone","status","created_at")->where("sponsorName",Auth::guard("web")->user()->username)->where("status",1)->orderBy("created_at","desc")->paginate(10);
        return view("frontend.pages.myfollower",compact("followers"));
    }

    #Change password page view.
    public function chnagePassword() {
        //return "Ok";
        return view("frontend.pages.changepassword");
    }

    #Update password page view.
    public function updatePassword(Request $request) {

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

            $user = User::where("username",Auth::guard("web")->user()->username)->where("status",1)->first();

            if(Hash::check(trim(strip_tags($request->oldPassword)), $user->password)) {
                $user->password = bcrypt($request->password);
                $user->update();
                return redirect()->back()->with("success","Password changed Successfully");
            }else{
                return redirect()->back()->with('warning', "Sorry! Your old password not match!");
            }
        }catch(Exception $e){
            return redirect()->back()->with("warning","Something want wrong!");
        }
    }

    #Bet history page view.
    public function betHistory() {
        $betHistories = Betplace::with("match","betoption","betdetail")->where("user_id",Auth::guard("web")->user()->id)->orderBy("created_at","desc")->paginate(50);
        return view("frontend.pages.bethistory",compact("betHistories"));
    }

    #Get Sponsor.
    public function getSponsor() {
        $getSponsors = Betplace::with("user")->where("sponsorName",Auth::guard("web")->user()->username)
            ->where("status","!=",5)
            ->orderBy("created_at","desc")->paginate(50);
        return view("frontend.pages.sponsor",compact("getSponsors"));
    }

    #User registration page view.
    public function userRegistration() {
        $clubs = Club::where("status",1)->get();
        return view("frontend.pages.userregistration",compact("clubs"));
    }

    #Online join user store
    public function onlineUserStore (Request $request) {
        $this->validate($request,[
            "username"=> "required|unique:users|regex:/^[a-zA-Z0-9_-]+$/",
            "email"=> "required|email|unique:users",
            "phone"=> "required",
            "country"=> "required",
            "club_id"=> "required",
            "password"=> "required|confirmed|min:8",
            "password_confirmation"=> "required",
        ],[
            'username.required' => 'Username required',
            'username.unique' => 'Username already taken',
            'username.regex' => 'Username format is invalid',
            'email.required' => 'Email is required',
            'email.email' => 'Email format invalid',
            'email.unique' => 'Email already taken',
            'phone.required' => 'Phone number is required',
            'country.required' => 'Country is required',
            'club_id.required' => 'Club is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum 8 character',
            'password_confirmation.required' => 'Confirm password is required',
            'password.confirmed' => 'Password and confirm password not match',
        ]);
        //return $request->all();
        $email    = explode("@", trim(strip_tags($request->email)));

        #check sponsor name here
        if($request->sponsorName != null){
            $sponsorName = trim(strip_tags($request->sponsorName));
            $user = User::select("username")->where(["status"=>1,"username"=> $sponsorName])->first();

            if(!$user){
                return redirect()->back()->with('message', 'Sponsor not found');
            }else{
                $sponsorName = $user->username;
            }

        }else{
            $sponsorName = null;
        }

        $user = new User();
        $user->name     = trim(strip_tags($request->username));
        $user->username = trim(strip_tags(strtolower($request->username)));
        $user->email    = trim(strip_tags($request->email));
        $user->password = bcrypt(trim(strip_tags($request->password)));
        $user->club_id  = trim(strip_tags($request->club_id));
        $user->sponsorName = $sponsorName;
        $user->phone    = trim(strip_tags($request->phone));
        $user->country  = trim(strip_tags($request->country));
        /*$user->pcMac    = strtok(exec('getmac'), ' ');*/
        $user->userInfo = $this->getUserLocationInfo();
        $user->status   = 1;
        $user->save();
        return redirect()->back()->with('success', "Account created you are ready for login.");

    }

    // Function to get the client IP address or Visitor ip address
    protected function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    protected function getUserLocationInfo() {

        $agent = new Agent();
        $platform = $agent->platform();
        $version  = $agent->version($platform);
        $browser  = $agent->browser();

        $divice = "";
        if($agent->isDesktop() == 1){
            $device = "Computer";
        }else if($agent->isTablet() == 1){
            $device = "Tablet";
        }else if($agent->isMobile() == 1){
            $device = "Mobile";
        }

        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $this->get_client_ip()));
        $userLocationInfo =  'Device:' . $device.' - ';
        $userLocationInfo .=  'Operating System:' . $platform ." ". $version.' - ';
        $userLocationInfo .=  'Browser:' . $browser .' - ';
        $userLocationInfo .=  'IP Address:' . $this->get_client_ip() .' - ';
        $userLocationInfo .=  'Continent:' . ($ipdat->geoplugin_continentName) ? $ipdat->geoplugin_continentName : ' ' .' - ';
        $userLocationInfo .=  'Country: ' . ($ipdat->geoplugin_countryName) ? $ipdat->geoplugin_countryName : ' ' .' - ';
        $userLocationInfo .=  'City:' . ($ipdat->geoplugin_city ) ? $ipdat->geoplugin_city : ' ' .' - ';
        $userLocationInfo .=  'Latitude:' . ($ipdat->geoplugin_latitude) ? $ipdat->geoplugin_latitude : ' ' .' - ';
        $userLocationInfo .=  'Longitude:' . ($ipdat->geoplugin_longitude) ? $ipdat->geoplugin_longitude : ' ' .' - ';
        $userLocationInfo .=  'Timezone:' . ($ipdat->geoplugin_timezone) ? $ipdat->geoplugin_timezone : ' ' ;
        return $userLocationInfo;

    }

    public function userLoginHistory () {
        //return "ok";
        try {
            if(Auth::guard("web")->user()){
                $userDetail = new Userlogindetail();
                $userDetail->user_id = Auth::user()->id;
                $userDetail->loginInfo = $this->getUserLocationInfo();
                $userDetail->save();
            }
            return redirect("/");
        }catch (Exception $e){
            return redirect("/");
        }

    }
    #refresh main balance
    public function refreshUserMainBalance() {
        try {
            if(Auth::guard("web")->user()){
                $userBalance = User::select("totalBalance")->where("id",Auth::user()->id)->first();
                return Response::json($userBalance);
            }else{
                return redirect("/");
            }
        }catch (Exception $e){
            return redirect("/");
        }
    }

    public function ethicalHacking() {
        return view("frontend.pages.ethicalhacking");
    }

}
