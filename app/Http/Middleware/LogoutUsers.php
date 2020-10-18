<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogoutUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = Auth::guard('web')->user();
        if(!empty($user)){
            if ($user->status == 0 || $user->status == 2 ) {
                Auth::guard('web')->logout();
                return redirect('/');
            }
        }

        return $next($request);
    }
}
