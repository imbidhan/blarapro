<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Support\Facades\Auth;

class MainAdmin
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
        $userRoleName = Auth::guard("admin")->user()->userRole->name;

        if (Auth::guard("admin")->user()->userRole->name != 'mainAdmin')
        {
            Toastr::warning("You don't have enough permission to perform this operation!","Warning!");
            return redirect()->back();
        }

        return $next($request);
    }
}
