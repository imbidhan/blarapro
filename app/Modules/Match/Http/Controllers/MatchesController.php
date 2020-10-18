<?php

namespace App\Modules\Match\Http\Controllers;

use App\Events\betdetailUpdateEvent;
use App\Models\Betplace\Betplace;
use App\Models\Club\Club;
use App\Models\Config\Config;
use App\Models\Deposit\Masterdeposit;
use App\Models\Match\Score;
use App\User;
use Exception;

use App\Models\Match\Team;
use App\Models\Match\Match;
use App\Models\Match\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Match\Betdetail;
use App\Models\Match\Betoption;
use App\Models\Match\Tournament;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Match\Matchbetoption;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Jenssegers\Agent\Agent;
class MatchesController extends Controller
{
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

    #Check Ip address.
    public function checkAdminIp() {

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
        //return $userLocationInfo;
        //$ip = $this->get_client_ip();
        return view('match::matches.checkIp',compact('userLocationInfo'));

    }

    #Matches List
    public function index() {
        $circmatches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereNotIn('matches.status',[4,5,6])
            ->where('matches.sport_id',1)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $footmatches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereNotIn('matches.status',[4,5,6])
            ->where('matches.sport_id',2)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $baskmatches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereNotIn('matches.status',[4,5,6])
            ->where('matches.sport_id',3)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();
        $volleymatches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereNotIn('matches.status',[4,5,6])
            ->where('matches.sport_id',4)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        $tennismatches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName","teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")
            ->whereNotIn('matches.status',[4,5,6])
            ->where('matches.sport_id',5)
            ->orderBy("matches.matchDateTime","ASC")
            ->get();

        return view('match::matches.index',compact('circmatches','footmatches','baskmatches','volleymatches','tennismatches'));
    }

    #Complete Matches List
    public function completeMatchesManage() {
        //$matches = Match::with(['score','sport','tournament','teamOne','teamTwo','userUpdated'])->where("status",4)->orderBy('matchDateTime','DESC')->paginate(50);
        $matches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName",
                "teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")

            ->where('matches.status',4)
            ->orderBy("matches.matchDateTime","DESC")
            ->paginate(50);
        return view('match::matches.completeMatches',compact('matches'));
    }

    #Close Matches List
    public function closeMatchesManage() {
        //$matches = Match::with(['score','sport','tournament','teamOne','teamTwo','userUpdated'])->where("status",5)->orderBy('matchDateTime','DESC')->paginate(50);
        $matches = DB::table('matches')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'matches.tournament_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->select("matches.*","tournaments.tournamentName","sports.sportName",
                "teamOne.teamName as teamOne","teamTwo.teamName as teamTwo")

            ->where('matches.status',5)
            ->orderBy("matches.matchDateTime","DESC")
            ->paginate(50);
        return view('match::matches.closeMatches',compact('matches'));
    }

    #Matches Details complete
    public function matchesDetailClose($id) {

        $match = Match::where('id',$id)->where('status','=',5)->first(); #Get total match.
        if(empty($match)){Toastr::warning("Match already done or not find!","Warning!");
            return redirect()->back();
        }

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')
            ->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->whereIn("status",[0,1,2])
                    ->get()
                    ->toArray();


                if (!empty($betdetails)) {

                    $betStatusOff = DB::table('betdetails')
                        ->where(['match_id' => $id, 'betoption_id' => $betKey])
                        ->where("status","=",0)
                        ->get()->count();

                    $betHideFromUserStatus = DB::table('betdetails')
                        ->where(['match_id' => $id, 'betoption_id' => $betKey])
                        ->where("status","=",2)
                        ->get()->count();

                    $betCoin = Betplace::where(['match_id'=>$id,'betoption_id'=>$betKey])->sum("betAmount");

                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betoption_id'] = $betKey;
                    $optionBetDetails[$betKey]['match_id'] = $id;
                    $optionBetDetails[$betKey]['betStatus'] = $betStatusOff;
                    $optionBetDetails[$betKey]['betHideFromUserStatus'] = $betHideFromUserStatus;
                    $optionBetDetails[$betKey]['betCoin'] = $betCoin;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);
        //dd($betOptions);
        $config = Config::select("partialOne","partialTwo")->first();
        $allBetPlaces = Betplace::with(["user","club","betoption","betdetail","winnerItem"])->where("match_id",$id)->orderBy("status","ASC")->get();
        $totalSponsorGetThisMatch = Betplace::where("match_id",$id)->where("sponsorName", "!=" ,null)->orderBy("status","ASC")->sum("sponsorGet");
        $totalReturn = Betplace::where("match_id",$id)->where("status", "=" ,5)->get();
        $totalBackUser = Betplace::where("match_id",$id)->whereIn("status", [1,3,4])->get();
        $totalUnpublished = Betplace::where("match_id",$id)->where("status",0)->get();
        return view('match::matches.closeDetail',compact('match','betOptions','optionBetDetails','allBetPlaces',"totalSponsorGetThisMatch","totalBackUser","totalUnpublished","totalReturn","config"));
    }

    #Matches Details action
    public function matchDetailsCloseAction(Request $request,$id) {
        //return $request->all();
        $this->validate($request,[
            'status' => 'required',
        ],[
            'status.required' => 'Status required for update match!',
        ]);

        $match = Match::find($id);
        $match->status = trim(strip_tags($request->status));
        $match->save();

        Toastr::success("Match Disappear","Success!");
        return redirect()->route('close_matches_manage');

    }

    #Match Create
    public function create() {
        $sports = Sport::where('status',1)->get();
        $tournaments = Tournament::where('status',1)->get();
        $teams = Team::where('status',1)->get();
        return view('match::matches.create',compact('sports'));
    }

    #Change Sports
    public function changeSports($id) {
        $tournaments = Tournament::where('sport_id',$id)->where('status',1)->get();
        $teams = Team::where('sport_id',$id)->where('status',1)->get();
        $dataList = array(
            'tournaments' => $tournaments,
            'teams' => $teams,
        );
        $appendTournament = view('match::matches.appendTournament', $dataList)->render();
        $appendTeam = view('match::matches.appendTeam', $dataList)->render();

        $data = array(
            'appendTournament'=>$appendTournament,
            'appendTeam'=>$appendTeam,
        );

        return Response::json($data);
    }

    #Validation activates
    protected function matchServerValidation($request) {

        $this->validate($request,[
            'matchTitle' => 'required',
            'sport_id' => 'required',
            'tournament_id' => 'required',
            'teamOne_id' => 'required',
            'teamTwo_id' => 'required',
            'matchDateTime' => 'required',
        ],[
            'matchTitle.required' => 'Match Title is required',
            'sport_id.required' => 'Sport name is required',
            'tournament_id.required' => 'Tournament name is required',
            'teamOne_id.required' => 'First team is required',
            'teamTwo_id.required' => 'Second team is required',
            'matchDateTime.required' => 'Match date time is required',
        ]);
    }

    #Match Store
    public function store(Request $request) {

        $this->matchServerValidation($request);

        try{

            if($request->teamOne_id === $request->teamTwo_id){
                Toastr::warning("First and Second Team Can\'t be same!","Warning!");
                return redirect()->route('matches_create');
            }

            $alreadyCreateMatch = Match::where('sport_id',$request->sport_id)
            ->where('tournament_id',$request->tournament_id)
            ->where('teamOne_id',$request->teamOne_id)
            ->where('teamTwo_id',$request->teamTwo_id)
            ->where('matchDateTime',$request->matchDate)
            ->first();

            $alreadyCreateMatch = Match::where('sport_id',$request->sport_id)
            ->where('tournament_id',$request->tournament_id)
            ->Where('teamOne_id',$request->teamTwo_id)
            ->Where('teamTwo_id',$request->teamOne_id)
            ->where('matchDateTime',$request->matchDate)
            ->first();

            if($alreadyCreateMatch){
                Toastr::warning("Match already created!","Warning!");
                return redirect()->route('matches_create');
            }

            #Score create
            $score = new Score();
            $score->overs = null;
            $score->score = null;
            $score->save();

            #Match create
            $match = new Match();
            $match->score_id = $score->id;
            $match->sport_id = trim(strip_tags($request->sport_id));
            $match->tournament_id = trim(strip_tags($request->tournament_id));
            $match->teamOne_id = trim(strip_tags($request->teamOne_id));
            $match->teamTwo_id = trim(strip_tags($request->teamTwo_id));
            $match->matchTitle = trim(strip_tags($request->matchTitle));
            $match->matchDateTime  = trim(strip_tags($request->matchDateTime));
            $match->created_by = Auth::guard("admin")->user()->id;
            $match->save();

            $score->match_id = $match->id;
            $score->update();

            Toastr::success("Match created Successfully","Success!");
            return redirect()->route('matches_create');

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('matches_create');
        }
    }

    #Edit Matches
    public function edit($id) {
        try {
            $match = Match::where('id', $id)->where('status', '!=', 4)->first();
            if (!empty($match) || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0) {
                $sports = Sport::where('status', 1)->get();
                return view('match::matches.edit', compact('sports', 'match'));
            } else {
                Toastr::warning("Match already done or not find!", "Warning!");
                return redirect()->route('matches_manage');
            }
        }catch (Exception $e){
            Toastr::error("Something want worng", "Warning!");
            return redirect()->back();
        }
    }

    #Update Matches
    public function update(Request $request, $id) {

        $this->matchServerValidation($request);

        try{

            if($request->teamOne_id === $request->teamTwo_id){
                Toastr::warning("First and Second Team Can\'t be same!","Warning!");
                return redirect()->route('matches_edit',['id'=>$id]);
            }
            #Validation for enter table.
            $alreadyCreateMatchOne = Match::where('sport_id',$request->sport_id)
            ->where('matchTitle',trim(strip_tags($request->matchTitle)))
            ->where('tournament_id',$request->tournament_id)
            ->where('teamOne_id',$request->teamOne_id)
            ->where('teamTwo_id',$request->teamTwo_id)
            ->where('matchDateTime',$request->matchDateTime)
            ->first();

            if($alreadyCreateMatchOne){
                Toastr::warning("Match already created!","Warning!");
                return redirect()->route('matches_edit',['id'=>$id]);
            }

            #Validation for enter table.
            $alreadyCreateMatchTwo = Match::where('sport_id',$request->sport_id)
            ->where('matchTitle',trim(strip_tags($request->matchTitle)))
            ->where('tournament_id',$request->tournament_id)
            ->Where('teamOne_id',$request->teamTwo_id)
            ->Where('teamTwo_id',$request->teamOne_id)
            ->where('matchDateTime',$request->matchDateTime)
            ->first();

            if($alreadyCreateMatchTwo){
                Toastr::warning("Match already created!","Warning!");
                return redirect()->route('matches_edit',['id'=>$id]);
            }

            $match = Match::find($id);
            $match->sport_id = trim(strip_tags($request->sport_id));
            $match->tournament_id = trim(strip_tags($request->tournament_id));
            $match->teamOne_id = trim(strip_tags($request->teamOne_id));
            $match->teamTwo_id = trim(strip_tags($request->teamTwo_id));
            $match->matchTitle = trim(strip_tags($request->matchTitle));
            $match->matchDateTime = trim(strip_tags($request->matchDateTime));
            $match->updated_by = Auth::guard("admin")->user()->id;
            $match->updated_at = Carbon::now();
            $match->update();

            Toastr::success("Match updated Successfully","Success!");
            return redirect()->route('matches_edit',['id'=>$id]);

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('matches_edit',['id'=>$id]);
        }

    }

    #Matches details
    public function matchDetail($id) {

        $match = Match::where('id',$id)->whereNotIn('status',[4,5])->first(); #Get total match.
        if(empty($match)){Toastr::warning("Match already done or not find!","Warning!");
            return redirect()->route('matches_manage');
        }

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')
            ->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->whereIn("status",[0,1,2])
                    ->get()
                    ->toArray();


                if (!empty($betdetails)) {

                    $betStatusOff = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->where("status","=",0)
                    ->get()->count();

                    $betHideFromUserStatus = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->where("status","=",2)
                    ->get()->count();

                    $betCoin = Betplace::where(['match_id'=>$id,'betoption_id'=>$betKey])->sum("betAmount");

                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betoption_id'] = $betKey;
                    $optionBetDetails[$betKey]['match_id'] = $id;
                    $optionBetDetails[$betKey]['betStatus'] = $betStatusOff;
                    $optionBetDetails[$betKey]['betHideFromUserStatus'] = $betHideFromUserStatus;
                    $optionBetDetails[$betKey]['betCoin'] = $betCoin;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);
        //dd($betOptions);
        $config = Config::select("partialOne","partialTwo")->first();
        $allBetPlaces = Betplace::with(["user","club","betoption","betdetail","winnerItem"])->where("match_id",$id)->orderBy("created_at","DESC")->get();
        $totalSponsorGetThisMatch = Betplace::where("match_id",$id)->where("sponsorName", "!=" ,null)->orderBy("status","ASC")->sum("sponsorGet");
        $totalReturn = Betplace::where("match_id",$id)->where("status", "=" ,5)->get();
        $totalBackUser = Betplace::where("match_id",$id)->whereIn("status", [1,3,4])->get();
        $totalUnpublished = Betplace::where("match_id",$id)->where("status",0)->get();
        return view('match::matches.detail',compact('match','betOptions','optionBetDetails','allBetPlaces',"totalSponsorGetThisMatch","totalBackUser","totalUnpublished","totalReturn","config"));
    }

    #Matches Details complete
    public function matchesDetailComplete($id) {

        $match = Match::where('id',$id)->where('status','=',4)->first(); #Get total match.
        if(empty($match)){Toastr::warning("Match already done or not find!","Warning!");
            return redirect()->route('complete_matches_manage');
        }

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')
            ->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->whereIn("status",[0,1,2])
                    ->get()
                    ->toArray();


                if (!empty($betdetails)) {

                    $betStatusOff = DB::table('betdetails')
                        ->where(['match_id' => $id, 'betoption_id' => $betKey])
                        ->where("status","=",0)
                        ->get()->count();

                    $betHideFromUserStatus = DB::table('betdetails')
                        ->where(['match_id' => $id, 'betoption_id' => $betKey])
                        ->where("status","=",2)
                        ->get()->count();

                    $betCoin = Betplace::where(['match_id'=>$id,'betoption_id'=>$betKey])->sum("betAmount");

                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betoption_id'] = $betKey;
                    $optionBetDetails[$betKey]['match_id'] = $id;
                    $optionBetDetails[$betKey]['betStatus'] = $betStatusOff;
                    $optionBetDetails[$betKey]['betHideFromUserStatus'] = $betHideFromUserStatus;
                    $optionBetDetails[$betKey]['betCoin'] = $betCoin;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);
        //dd($betOptions);
        $config = Config::select("partialOne","partialTwo")->first();
        $allBetPlaces = Betplace::with(["user","club","betoption","betdetail","winnerItem"])->where("match_id",$id)->orderBy("status","ASC")->get();
        $totalSponsorGetThisMatch = Betplace::where("match_id",$id)->where("sponsorName", "!=" ,null)->orderBy("status","ASC")->sum("sponsorGet");
        $totalReturn = Betplace::where("match_id",$id)->where("status", "=" ,5)->get();
        $totalBackUser = Betplace::where("match_id",$id)->whereIn("status", [1,3,4])->get();
        $totalUnpublished = Betplace::where("match_id",$id)->where("status",0)->get();
        return view('match::matches.vanishDetail',compact('match','betOptions','optionBetDetails','allBetPlaces',"totalSponsorGetThisMatch","totalBackUser","totalUnpublished","totalReturn","config"));
    }

    #Matches Unpublished list
    public function matchUnpublishedList($id) {

        $match = Match::where('id',$id)->where('status','!=',4)->first(); #Get total match.

        if(empty($match)){Toastr::warning("Wrong input you given!","Warning!");
            return redirect()->route('matches_manage');
        }

        $betOptionPluck = DB::table('betoptions')
            ->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {

            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey,'status' => 3])
                    ->get()
                    ->toArray();


                if (!empty($betdetails)) {
                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betoption_id'] = $betKey;
                    $optionBetDetails[$betKey]['match_id'] = $id;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);

        return view('match::matches.unpublishedlist',compact('match','optionBetDetails'));
    }

    #Bet Win or Lost
    public function betWinLost(Request $request)
    {
        $this->validate($request,[
            "betDetailId"=>"required"
        ],[
            "betDetailId.required" => "Please select who is won the match.",
        ]);
        //return $request->all();
        try {

            #Winer
            $winners = Betplace::where(["betdetail_id" => $request->betDetailId, "match_id" => $request->match_id, "betoption_id" => $request->betoption_id, "status" => 0])->get();

            foreach ($winners as $winner) {

                $winner->winner_id = $request->betDetailId;
                $winner->betProfit = (($winner->betAmount * $winner->betRate) - $winner->betAmount);
                $winner->winLost = "win";
                $winner->status = 1;
                $winner->accepted_id = Auth::guard("admin")->user()->id;
                $winner->updated_at = Carbon::now();
                $winner->update();

                #User Update
                $user = User::where("id", $winner->user_id)->first();
                $user->totalProfitAmount = ($user->totalProfitAmount + $winner->betProfit);
                $user->totalLossAmount = ($user->totalLossAmount - $winner->betAmount);
                $user->update();

                #User total balance update
                $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                $user->update();
            }

            #Losers
            $losers = Betplace::where(["match_id" => $request->match_id, "betoption_id" => $request->betoption_id, "status" => 0])->get();

            foreach ($losers as $loser) {

                $loser->winner_id = $request->betDetailId;
                $loser->betLost = $loser->betAmount;
                $loser->winLost = "lost";
                $loser->status = 2;
                $loser->accepted_id = Auth::guard("admin")->user()->id;
                $loser->updated_at = Carbon::now();
                $loser->update();
            }

            #Betdetail
            $betDetail = Betdetail::where(["match_id" => $request->match_id, "betoption_id" => $request->betoption_id])
                ->whereIn("status", [0, 1, 2])
                ->update(["status" => 3]);

            $message = 1;
            event(new betdetailUpdateEvent($message));

            Toastr::success("Bet option published successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something Went wrong", "Error!");
            return redirect()->back();
        }

    }

    #Bet Win or Lost
    public function betUnpublished(Request $request)
    {

        $this->validate($request,[
            "betDetailId"=>"required"
        ],[
            "betDetailId.required" => "Please select who is won the match.",
        ]);

        try {
            #Config
            $config = Config::select("sponsorRate")->first();

            #check you select winner option when you published.
            $winnerOptions = Betplace::where(["winner_id" => $request->betDetailId, "match_id" => $request->match_id, "betoption_id" => $request->betoption_id])->get();
            if ($winnerOptions->count() == 0) {
                Toastr::error("Please select winner option or this option did partial.", "Wirning!");
                return redirect()->back();
            }

            #Winner
            $winners = Betplace::where(["betdetail_id" => $request->betDetailId, "winner_id" => $request->betDetailId, "match_id" => $request->match_id, "betoption_id" => $request->betoption_id, "status" => 1])->get();
            if($winners->count() > 0) {
                foreach ($winners as $winner) {

                    #User Update
                    $user = User::where("id", $winner->user_id)->first();
                    $user->totalProfitAmount = ($user->totalProfitAmount - $winner->betProfit);
                    $user->totalLossAmount = ($user->totalLossAmount + $winner->betAmount);
                    $user->update();

                    #User total balance update
                    $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                    $user->update();

                    $winner->winner_id = null;
                    $winner->betProfit = 0.00;
                    $winner->winLost = "match live";
                    $winner->status = 0;
                    $winner->accepted_id = null;
                    $winner->updated_at = null;
                    $winner->update();

                }
            }

            #Losers
            $losers = Betplace::where("betdetail_id", "!=", $request->betDetailId)->where(["winner_id" => $request->betDetailId, "match_id" => $request->match_id, "betoption_id" => $request->betoption_id, "status" => 2])->get();
            if($losers->count() > 0) {
                foreach ($losers as $loser) {

                    $loser->winner_id = null;
                    $loser->betLost = 0.00;
                    $loser->winLost = "match live";
                    $loser->status = 0;
                    $loser->accepted_id = null;
                    $loser->updated_at = null;
                    $loser->update();
                }
            }

            #Betdetail
            $betDetail = Betdetail::where(["match_id" => $request->match_id, "betoption_id" => $request->betoption_id])
                ->where("status", 3)
                ->update(["status" => 2]);

            Toastr::success("Bet option Unpublished successfully", "Success!");
            return redirect()->back();

        }catch (Exception $e){
            Toastr::error("Something Went wrong", "Error!");
            return redirect()->back();
        }

    }

    #bet partial One match
    public function partialOne ($rate,$matchId,$betOptionId) {

        try {
            $betPlaces = Betplace::where(["match_id"=>$matchId, "betoption_id"=>$betOptionId,"status"=>0])->get();
            //return $betPlaces;
            $config = Config::select("partialOne","sponsorRate")->first();
            //return $config;

            if(!empty($betPlaces)){
                foreach ($betPlaces as $betPlace) {
                    //return $betPlace;
                    $betPlace->partialLost = (($betPlace->betAmount / 100) * $config->partialOne);
                    $betPlace->partialRate = $config->partialOne;
                    $betPlace->winLost = "partial $config->partialOne";
                    $betPlace->status = 3;
                    $betPlace->accepted_id = Auth::guard("admin")->user()->id;
                    $betPlace->updated_at = Carbon::now();
                    $betPlace->update();

                    #User Update
                    $user = User::where("id",$betPlace->user_id)->first();
                    $user->totalLossAmount =  ($user->totalLossAmount - ($betPlace->betAmount - $betPlace->partialLost));
                    $user->update();
                    $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                    $user->update();

                    #MasterDeposit update
                    $mainSiteDeposit = Masterdeposit::first();
                    $mainSiteDeposit->totalPartialFromUser = ($mainSiteDeposit->totalPartialFromUser + $betPlace->partialLost);
                    $mainSiteDeposit->update();

                }

                #Betdetail
                $betDetail = Betdetail::where(["match_id"=>$matchId, "betoption_id"=>$betOptionId])
                    ->whereIn("status",[0,1,2])
                    ->update(["status"=>3]);
                $message = 1;
                event(new betdetailUpdateEvent($message));
                Toastr::success("Partial action successfully done", "Success!");
                return redirect()->back();
            }else{
                Toastr::error("Not Found","Error!");
                return redirect()->back();
            }

        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #bet partial Two match
    public function partialTwo ($rate,$matchId,$betOptionId) {
        try {
            $betPlaces = Betplace::where(["match_id"=>$matchId, "betoption_id"=>$betOptionId,"status"=>0])->get();
            //return $betPlaces;
            $config = Config::select("partialTwo","sponsorRate")->first();
            //return $config;

            if(!empty($betPlaces)){
                foreach ($betPlaces as $betPlace) {
                    //return $betPlace;
                    $betPlace->partialRate = $config->partialTwo;
                    $betPlace->partialLost = (($betPlace->betAmount / 100) * $config->partialTwo);
                    $betPlace->winLost = "partial $config->partialTwo";
                    $betPlace->status = 3;
                    $betPlace->accepted_id = Auth::guard("admin")->user()->id;
                    $betPlace->updated_at = Carbon::now();
                    $betPlace->update();

                    #User Update
                    $user = User::where("id",$betPlace->user_id)->first();
                    $user->totalLossAmount =  ($user->totalLossAmount - ($betPlace->betAmount - $betPlace->partialLost));
                    $user->update();
                    $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
                    $user->update();

                    #MasterDeposit update
                    $mainSiteDeposit = Masterdeposit::first();
                    $mainSiteDeposit->totalPartialFromUser = ($mainSiteDeposit->totalPartialFromUser + $betPlace->partialLost);
                    $mainSiteDeposit->update();

                }

                #Betdetail
                $betDetail = Betdetail::where(["match_id"=>$matchId, "betoption_id"=>$betOptionId])
                    ->whereIn("status",[0,1,2])
                    ->update(["status"=>3]);

                $message = 1;
                event(new betdetailUpdateEvent($message));

                Toastr::success("Partial action successfully done", "Success!");
                return redirect()->back();

            }else{
                Toastr::error("Not Found","Error!");
                return redirect()->back();
            }

        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #Total match bet off
    public function totalMatchBetOnOff(Request $request, $matchId) {

        if($request->status == 0){
            try {
                $betDetails = Betdetail::where(["match_id"=>$matchId])->where("status",1)->update(['status'=>0]);
                $message = 1;
                event(new betdetailUpdateEvent($message));
                Toastr::success("Total bet Off successfully","Success!");
                return redirect()->back();
            }catch (Exception $e){
                Toastr::error("Something went wrong","Error!");
                return redirect()->back();
            }

        }else{
            try {
                $betDetails = Betdetail::where(["match_id"=>$matchId])->where("status",0)->update(['status'=>1]);
                $message = 1;
                event(new betdetailUpdateEvent($message));
                Toastr::success("Total bet on successfully","Success!");
                return redirect()->back();
            }catch (Exception $e){
                Toastr::error("Something went wrong","Error!");
                return redirect()->back();
            }
        }
    }
    #Tune Off
    public function betActionOff($matchId,$betOptionId) {

        try {
            $betDetails = Betdetail::where(["match_id"=>$matchId,"betoption_id"=>$betOptionId])->whereIn("status",[0,1])->update(['status'=>0]);
            $message = 1;
            event(new betdetailUpdateEvent($message));
            Toastr::success("Bet Off successfully","Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #Tune On
    public function betActionOn($matchId,$betOptionId) {

        try {
            $betDetails = Betdetail::where(["match_id" => $matchId, "betoption_id" => $betOptionId])->whereIn("status",[0,1])->update(['status' => 1]);
            $message = 1;
            event(new betdetailUpdateEvent($message));
            Toastr::success("Bet On successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #Hide form Frontend
    public function betActionHideFormUserPage($matchId,$betOptionId) {

        try {
            $betDetails = Betdetail::where(["match_id" => $matchId, "betoption_id" => $betOptionId])->update(['status' => 2]);
            $message = 1;
            event(new betdetailUpdateEvent($message));
            Toastr::success("Bet hide form user page successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #Bet delete
    public function betActionDelete($matchId,$betOptionId) {

        try {
            $betDetails = Betdetail::where(["match_id" => $matchId, "betoption_id" => $betOptionId])->update(['status' => 4]);
            Toastr::success("Bet delete successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #User bet return
    public function userBetReturn($betPlaceId) {

        try {

            $betPlace = Betplace::where("id",$betPlaceId)->first();
            $betPlace->winLost = "bet return";
            $betPlace->status = 5;
            $betPlace->save();

            $user = User::where("id",$betPlace->user_id)->where("status",1)->first();
            $user->totalLossAmount = ($user->totalLossAmount - $betPlace->betAmount);
            $user->update();

            #Update user totalBalance
            $user->totalBalance = ($user->totalRegularDepositAmount + $user->totalSpecialDepositAmount + $user->totalCoinReceiveAmount + $user->totalSponsorAmount + $user->totalProfitAmount) - ($user->totalCoinTransferAmount + $user->totalLossAmount + $user->totalWithdrawAmount);
            $user->update();

            /*#Club update
            $club = Club::where("id",$betPlace->club_id)->first();
            $club->totalProfit = ($club->totalProfit -  $betPlace->clubGet);
            $club->update();
            $club->totalBalance = ($club->totalProfit - $club->totalWithdrawAmount);
            $club->update();

            #MasterDeposit update
            $mainSiteDeposit = Masterdeposit::first();
            $mainSiteDeposit->totalSiteDeposit = ($mainSiteDeposit->totalSiteDeposit + $clubHolderProfit);
            $mainSiteDeposit->totalLossToClub  = ($mainSiteDeposit->totalLossToClub - $clubHolderProfit);
            $mainSiteDeposit->update();*/

            Toastr::success("Bet return successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #User bet return
    public function userBetDelete($betPlaceId) {

        try {

            $betPlace = Betplace::where("id",$betPlaceId)->first();
            $betPlace->delete();

            Toastr::success("Bet delete successfully", "Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->back();
        }

    }

    #Matches Details action
    public function matchDetailsAction(Request $request,$id) {

        //return $request->all();
        $this->validate($request,[
            'status' => 'required',
        ],[
            'status.required' => 'Status required for update match!',
        ]);

        $match = Match::find($id);
        $match->status = trim(strip_tags($request->status));
        $match->save();

        $message = 1;
        event(new betdetailUpdateEvent($message));

        if($request->status == 0){
            Toastr::success("Match go drafted","Success!");
            return redirect()->back();
        }elseif ($request->status == 1){
            Toastr::success("Match go to Upcoming","Success!");
            return redirect()->back();
        }elseif ($request->status == 2){
            Toastr::success("Match go live","Success!");
            return redirect()->back();
        }elseif ($request->status == 3){
            Toastr::success("Match done","Success!");
            return redirect()->back();
        }elseif ($request->status == 4){
            Toastr::success("Match fully finished","Success!");
            return redirect()->route('matches_manage');
        }elseif ($request->status == 7){
            Toastr::success("Match fully finished","Success!");
            return redirect()->route('matches_manage');
        }

    }

    #Matches Details action
    public function matchDetailsVanishAction(Request $request,$id) {
        //return $request->all();
        $this->validate($request,[
            'status' => 'required',
        ],[
            'status.required' => 'Status required for update match!',
        ]);

        $match = Match::find($id);
        $match->status = trim(strip_tags($request->status));
        $match->save();

        Toastr::success("Match vanish","Success!");
        return redirect()->route('complete_matches_manage');

    }

    #Matches matches bet setup
    public function matchesBetSetup(Request $request, $id) {

        $this->validate($request,[
            'betoption_id' => 'required',
            'option_type' => 'required',
            /* 'betName.*' => 'required|regex:/^[a-zA-Z0-9-_()]+$/u', */
            'betName.*' => 'required',
            'betRate.*' => 'required|numeric',
        ],[
            'betoption_id.required' => 'Bet option is required',
            'option_type.required' => 'Option type is required',
            'betName.*.regex' => 'Bet name content letter,underscor,hypen',
        ]);

        $betDetail = Betdetail::where(["match_id"=> $id, "betoption_id"=> trim(strip_tags($request->betoption_id)), "status"=>3])->first();
        if(!empty($betDetail)){
            Toastr::error("Sorry! This bet already published!","Danger!");
            return redirect()->back();
        }

        try{

            for($i=0; $i<count($request->betName); $i++) {

                $betDetail = new Betdetail();
                $betDetail->match_id = $id;
                $betDetail->betoption_id = trim(strip_tags($request->betoption_id));
                $betDetail->betName = trim(strip_tags($request->betName[$i]));
                $betDetail->betRate = trim(strip_tags($request->betRate[$i]));
                $betDetail->created_by   = Auth::guard("admin")->user()->id;
                $betDetail->save();

            }

            Toastr::success("Bet setup Successfully","Success!");
            return redirect()->back();
        } catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }

    }

    #Matches matches bet setup
    public function matchesBetSetupLive(Request $request, $id) {

        $this->validate($request,[
            'betoption_id' => 'required',
            'option_type' => 'required',
            /* 'betName.*' => 'required|regex:/^[a-zA-Z0-9-_()]+$/u', */
            'betName.*' => 'required',
            'betRate.*' => 'required|numeric',
        ],[
            'betoption_id.required' => 'Bet option is required',
            'option_type.required' => 'Option type is required',
            'betName.*.regex' => 'Bet name content letter,underscor,hypen',
        ]);

        $betDetail = Betdetail::where(["match_id"=> $id, "betoption_id"=> trim(strip_tags($request->betoption_id)), "status"=>3])->first();
        if(!empty($betDetail)){
            Toastr::error("Sorry! This bet already published!","Danger!");
            return redirect()->back();
        }

        try{

            for($i=0; $i<count($request->betName); $i++) {

                $betDetail = new Betdetail();
                $betDetail->match_id = $id;
                $betDetail->betoption_id = trim(strip_tags($request->betoption_id));
                $betDetail->betName = trim(strip_tags($request->betName[$i]));
                $betDetail->betRate = trim(strip_tags($request->betRate[$i]));
                $betDetail->created_by   = Auth::guard("admin")->user()->id;
                $betDetail->save();

            }

            $message = 1;
            event(new betdetailUpdateEvent($message));

            Toastr::success("Bet setup Successfully","Success!");
            return redirect()->back();
        } catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }

    }


    #Update single bet option
    public function updateSingleBetOption(Request $request, $id) {

        $this->validate($request,[
            /* 'betNameEdit' => 'required|regex:/^[a-zA-Z0-9-_()]+$/u', */
            'betNameEdit' => 'required',
            'betRateEdit' => 'required|numeric',
        ],[
            'betNameEdit.required' => 'Bet name is required',
            'betRateEdit.required' => 'Bet rate is required',
            'betRateEdit.numeric' => 'Bet rate is only taken numeric value',
        ]);

        try{

            $betDetail = Betdetail::find($id);
            $betDetail->betName = trim(strip_tags($request->betNameEdit));
            $betDetail->betRate = trim(strip_tags($request->betRateEdit));
            $betDetail->updated_by   = Auth::guard("admin")->user()->id;
            $betDetail->updated_at   = Carbon::now();
            $betDetail->update();

            $message = 1;
            event(new betdetailUpdateEvent($message));

            Toastr::success("Single bet updated successfully","Success!");
            return redirect()->back();

        } catch(Exception $e) {

            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();

        }
    }

    #Total question bet rate update
    public function totalQuestionBetRateUpdate (Request $request) {
        //dd($request->betRateEdit);
        # Here is validation.
        /*$this->validate($request,[
            'betRateEdit' => 'required|numeric',
        ],[
            'betRateEdit.required' => 'Bet rate is required',
        ]);*/
        try {
            $betOptionItems = $request->id;
            foreach($betOptionItems as $key=>$betOptionItem){
                echo $betOptionItem;
                $betDetail = Betdetail::where("betoption_id",$request->betoptionId)
                    ->where("id",$betOptionItem)->first();
                $betDetail->betRate = $request->betRateEdit[$key];
                $betDetail->update();
            }

            $message = 1;
            event(new betdetailUpdateEvent($message));

            Toastr::success("Bet rate successfully updated!","Success!");
            return redirect()->back();
        }catch (Exception $e){
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }

    }
    #Single bet delete.
    public function singleBetDelete ($id) {
        try{
            $singleBetDetails = Betdetail::where("id",$id)->first();
            $singleBetDetails->status = 4;
            $singleBetDetails->update();

            Toastr::success("Bet option successfully deleted!","Success!");
            return redirect()->back();

        }catch (Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();
        }


    }

    #Update live bet matches rate
    public function liveMatchBetRateView ($id,$score_id) {
        /*Check Only live match can available otherwise back*/
        $match = Match::where('id',$id)->whereIn('status',[2,3])->first(); #Get total match.

        if(empty($match)){Toastr::warning("Match already done or not find!","Warning!");

            return redirect()->back();
        }

        //dd($match);

        $betOptions = Betoption::where('sport_id',$match->sport_id)->get(); #For dropdown select.
        //dd($betOptions);

        $betOptionPluck = DB::table('betoptions')
            ->pluck('betOptionName','id');
        //dd($betOptionPluck);

        $optionBetDetails = [];
        if($betOptionPluck) {
            foreach ($betOptionPluck as $betKey => $betOption) {
                //return $id;
                $betdetails = DB::table('betdetails')
                    ->where(['match_id' => $id, 'betoption_id' => $betKey])
                    ->whereIn("status",[0,1,2])
                    ->get()
                    ->toArray();


                if (!empty($betdetails)) {

                    $betStatusOff = DB::table('betdetails')
                        ->where(['match_id' => $id, 'betoption_id' => $betKey])
                        ->where("status","=",0)
                        ->get()->count();

                    $betCoin = Betplace::where(['match_id'=>$id,'betoption_id'=>$betKey])->sum("betAmount");

                    $optionBetDetails[$betKey]['matchOption'] = $betOption;
                    $optionBetDetails[$betKey]['betoption_id'] = $betKey;
                    $optionBetDetails[$betKey]['match_id'] = $id;
                    $optionBetDetails[$betKey]['betStatus'] = $betStatusOff;
                    $optionBetDetails[$betKey]['betCoin'] = $betCoin;
                    $optionBetDetails[$betKey]['betDetails'] = $betdetails;
                }
            }

        }
        //dd($optionBetDetails);
        //dd($match);
        //dd($betOptions);
        $allBetOff = Betdetail::where("match_id",$id)->where("status",0)->where("status","!=",3)->get()->count();
        $score = Score::with('match')->where("id",$score_id)->first();
        return view('match::matches.updatebetrate',compact('match','betOptions','optionBetDetails','allBetOff','score'));
    }

    public function liveMatchUpdateBetRate(Request $request, $id) {

        $this->validate($request,[
            'betRateEdit' => 'required|numeric',
        ],[
            'betRateEdit.required' => 'Bet rate is required',
        ]);

        try{

            $betDetail = Betdetail::find($id);
            $betDetail->betRate = trim(strip_tags($request->betRateEdit));
            $betDetail->update();

            Toastr::success("Live matches bet rate updated","Success!");
            return redirect()->back();

        } catch(Exception $e) {

            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->back();

        }
    }

}
