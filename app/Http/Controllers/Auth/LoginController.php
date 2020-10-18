<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/user/info";
    protected $guardName = 'web';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout','userLogout');
    }
    #This function use for default.
    public function showLoginForm()
    {
        return redirect("/");
    }
    public function login(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:8'
        ],[
            "username.required" => "Incorrect user login credential.",
            "password.required" => "Incorrect user login credential.",
            "password.min" => "Incorrect user login credential."
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credential = [
            'username' => strtolower(trim(strip_tags($request->input('username')))),
            'password' => trim(strip_tags($request->input('password'))),
            'status' => 1
        ];

        //return $credential;
        if (Auth::guard($this->guardName)->attempt($credential)) {
            //return $credential;
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            #Here is redirect to user login details route and method but redirect url is commented.
            //return redirect($this->redirectTo);
            return redirect("/");

        } else {
            //return $request->all();
            $this->incrementLoginAttempts($request);
            return redirect("/")->with("error","Incorrect user login credential!");
        }
    }

    public function userLogout () {
        try {
            Auth::guard($this->guardName)->logout();
            //Session::flush();
            return redirect('/');
        }catch (Exception $exception){
            return redirect("/");
        }

    }

    public function userLogoutRedirect () {
        return redirect("/");
    }
}
