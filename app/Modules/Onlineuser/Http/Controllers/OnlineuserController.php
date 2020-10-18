<?php

namespace App\Modules\Onlineuser\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class OnlineuserController extends Controller
{
    #online user manage
    public function onlineUserManage() {
        $onlineUsers = User::with("club")->whereIn("status",[0,1,2])->get();
        return view("onlineuser::onlineuser.index",compact('onlineUsers'));
    }

    #online user manage
    public function onlineUserStatusChange(Request $request) {
        //return $request->all();
        try {
            
            $admin = User::find($request->id);
            $admin->status = trim(strip_tags($request->status));
            $admin->save();
            Toastr::success("User status change successfully","Success!");
            return redirect()->back();

        }catch(Exception $e){
            Toastr::error("Something went wrong!","Danger!");
            return redirect()->back();
        }

    }

    public function onlineUserPasswordChange($id) {
        return view("onlineuser::onlineuser.changepassword",compact('id'));
    }

    public function updateOnlineUserPassword (Request $request, $id){

        $this->validate($request,[
            "password"    => "required",
        ],[
            'password.required' => 'Password is required'
        ]);

        $user  = User::where("id",$id)->first();
        //dd($user);
        $user->password = trim(strip_tags(bcrypt($request->password)));
        //$user->status = 2;
        $user->save();

        Toastr::success("User password updated successfully","Success!");
        return redirect()->back();
    }
    
    #online User Bet History.
    public function onlineUserBetHistory ($id) {

        $betHistories = DB::table('betplaces')
            ->leftJoin('matches', 'matches.id', '=', 'betplaces.match_id')
            ->leftJoin('sports', 'sports.id', '=', 'matches.sport_id')
            ->leftJoin('teams as teamOne', 'teamOne.id', '=', 'matches.teamOne_id')
            ->leftJoin('teams as teamTwo', 'teamTwo.id', '=', 'matches.teamTwo_id')
            ->leftJoin('betoptions', 'betoptions.id', '=', 'betplaces.betoption_id')
            ->leftJoin('betdetails as userans', 'userans.id', '=', 'betplaces.betdetail_id')
            ->leftJoin('betdetails as rightans', 'rightans.id', '=', 'betplaces.winner_id')
            ->select("betplaces.created_at","betplaces.betAmount","betplaces.betRate","betplaces.betProfit","betplaces.betLost","betplaces.partialLost","betplaces.winLost",
                "matches.matchTitle","matches.matchDateTime","sports.sportName","teamOne.teamName as teamOne",
                "teamTwo.teamName as teamTwo","betoptions.betOptionName as question",
                "userans.betName as userAns","rightans.betName as rightAns")
            ->where("betplaces.user_id",$id)
            ->orderBy("betplaces.created_at","DESC")
            ->get();
        //dd($betHistories);
        return view("onlineuser::onlineuser.onlineUserBetHistory",compact('betHistories'));
    }
    

}
