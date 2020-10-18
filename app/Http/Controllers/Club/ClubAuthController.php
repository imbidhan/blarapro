<?php

namespace App\Http\Controllers\Club;

use App\Admin;
use App\Clublogindetail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class ClubAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName = 'club';
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    protected $loginRoute;
    protected $redirectTo = "/club/home";

    public function __construct()
    {
        $this->middleware('guest:club')->except('clubLogout');
        $this->loginRoute = route('club.login');
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

    public function clubGetLogin()
    {
        return view('club.login');
    }

    public function clubLogout()
    {
        Auth::guard($this->guardName)->logout();
        return redirect()->guest($this->loginRoute);
    }

    public function clubLogoutRedirect()
    {
        return redirect("/club/home");
    }

    public function clubPostLogin(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8'
        ],[
            "username.required"=>"Username is required",
            "password.required"=>"Password is required",
            "password.min" => "Incorrect user login credential!"
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credential = [
            'username' => trim(strip_tags(strtolower($request->input('username')))),
            'password' => trim(strip_tags($request->input('password'))),
            'status' => 1
        ];

        if (Auth::guard($this->guardName)->attempt($credential,$request->filled('remember'))) {
            //return $request->all();
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            #Here is store club login details method But now disable..
            /*if(Auth::guard($this->guardName)->user()){
                $clubDetail = new Clublogindetail();
                $clubDetail->club_id = Auth::guard($this->guardName)->user()->id;
                $clubDetail->loginInfo = $this->getUserLocationInfo();
                $clubDetail->save();
            }*/

            return redirect()->route("club.home");

        } else {
            //return $request->all();
            $this->incrementLoginAttempts($request);
            return redirect()->back()->with("error","Incorrect user login credential!");
        }
    }

}
