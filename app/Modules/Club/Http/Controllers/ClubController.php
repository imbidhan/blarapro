<?php

namespace App\Modules\Club\Http\Controllers;

use App\Models\Club\Club;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Exception;
class ClubController extends Controller
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

    #View Club
    public function index() {
        $clubs = Club::with('users')->whereIn("status",[0,1,2])->get();
        return view("club::club.index",compact("clubs"));
    }

    #Create Club
    public function create() {
        return view("club::club.create");
    }

    #Store Club
    public function store(Request $request) {

        $this->validate($request,[
            "username"=> "required|unique:clubs|regex:/^[a-zA-Z0-9_-]+$/",
            "email" => "required|email|unique:clubs,email",
            "password" => "required",
            "phone" => "required",
        ],[
            'username.required' => 'Username required',
            'username.unique' => 'Username already taken',
            'username.regex' => 'Username format is invalid',
            'email.required' => 'Email is required',
            'email.email' => 'Email format invalid',
            'email.unique' => 'Email already taken',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone number is required',
        ]);

        $email    = explode("@", trim(strip_tags($request->email)));
        $password = trim(strip_tags($request->password));
        try {
            $club = new Club();
            $club->clubName     = trim(strip_tags($request->clubName));
            $club->username     = trim(strip_tags(strtolower($request->username)));
            $club->phone        = trim(strip_tags($request->phone));
            $club->email        = trim(strip_tags($request->email));
            $club->password     = bcrypt($password);
            $club->status	    = 1;
            /*$club->pcMac	    = strtok(exec('getmac'), ' ');*/
            $club->userInfo     = $this->getUserLocationInfo();
            $club->created_by   = Auth::guard("admin")->user()->id;
            $club->save();

            Toastr::success("Club name create successfully","Success!");
            return redirect()->route("club_manage");
        }
        catch(Exception $e){
            Toastr::error("Something went wrong!","Danger!");
            return redirect()->back();
        }
    }

    #Club Edit
    public function edit($id) {
        $club = Club::find($id);
        return view("club::club.edit",compact("club"));
    }

    #Club update
    public function update(Request $request,$id) {

        $this->validate($request,[
            "clubName" => "required",
            "phone"    => "required",
        ]);

        try {
            $club = Club::find($id);
            $club->clubName = trim(strip_tags($request->clubName));
            $club->phone = trim(strip_tags($request->phone));
            $club->updated_by = Auth::guard("admin")->user()->id;
            $club->updated_at = Carbon::now();
            $club->save();

            Toastr::success("Club name updated successfully", "Success!");
            return redirect()->back();
        }
        catch(Exception $e){
            Toastr::error("Something went wrong!","Danger!");
            return redirect()->back();
        }

    }

    public function clubStatusChange(Request $request) {
        //return $request->all();
        try {

            $admin = Club::find($request->id);
            $admin->status = trim(strip_tags($request->status));
            $admin->save();
            Toastr::success("User status change successfully","Success!");
            return redirect()->back();

        }catch(Exception $e){

            Toastr::error("Something went wrong!","Danger!");
            return redirect()->back();

        }

        $club = Club::find($id);
        $club->status = 2;
        $club->save();

        Toastr::success("Club name deleted successfully","Success!");
        return redirect()->back();

    }

    #Club user password change
    public function clubUserPasswordChange($id) {
        $club = Club::find($id);
        return view("club::club.changeuserpassword",compact("club"));
    }

    #Club user password update
    public function clubUserPasswordUpdate(Request $request, $id) {

        $this->validate($request,[
            "password" => "required|min:8",
        ],[
            'password.required' => 'Password is required',
            'password.min' => 'Password must be 8 character',
        ]);

        try {
            $club = Club::find($id);
            $club->password = bcrypt(trim(strip_tags($request->password)));
            //$club->status = 2;
            $club->save();

            Toastr::success("Club password update successfully","Success!");
            return redirect()->route("club_manage");

        }catch (Exception $e){
            Toastr::error("Something went wrong","Error!");
            return redirect()->route("club_manage");
        }

    }
    
    #club user list
    public function everyClubTotalUseList($id) {
        $onlineUsers = DB::table('users')
            ->leftJoin("clubs","clubs.id", "=", "users.club_id")
            ->where("club_id",$id)
            ->select("users.*","clubs.username as clubUserName")
            ->get();
        return view("club::club.singleClubUserList",compact("onlineUsers"));
    }

}
