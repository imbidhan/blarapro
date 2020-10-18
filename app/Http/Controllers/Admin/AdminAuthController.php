<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName = 'admin';
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    protected $loginRoute;
    protected $redirectTo = "/admin/home";

    public function __construct()
    {
        $this->middleware('guest:admin')->except('postLogout');
        $this->loginRoute = route('admin.login');
    }

    public function getLogin()
    {
        return view('backend.pages.admin.login');
    }

    public function postLogout()
    {
        Auth::guard($this->guardName)->logout();
        //Session::flush();
        return redirect()->guest($this->loginRoute);
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:8'
        ],[
            "password.min" => "Incorrect user login credential!"
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }
        $credential = [
            'email' => trim(strip_tags(strtolower($request->input('username')))),
            'password' => trim(strip_tags($request->input('password'))),
            /*'pcMac' => $request->input('pcMac')*/
        ];
        //return $credential;
        if (Auth::guard($this->guardName)->attempt($credential,$request->filled('remember'))) {
            //return $request->all();
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->route("admin.home");

        } else {
            //return $request->all();
            $this->incrementLoginAttempts($request);
            return redirect()->back()->with("error","Incorrect user login credential!");
        }
    }

}
