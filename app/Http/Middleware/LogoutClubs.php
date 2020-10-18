<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogoutClubs
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
        $club = Auth::guard('club')->user();
        if(!empty($club)){
            if ($club->status == 0 || $club->status == 2) {
                Auth::guard('club')->logout();
                return redirect('/club/login');
            }
        }
        return $next($request);
    }
}
