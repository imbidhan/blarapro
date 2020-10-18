<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Support\Facades\Auth;

class SubAdmin
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
        $user = Auth::guard("admin")->user()->userRole->name;

        if (Auth::guard("admin")->user()->userRole->name != 'subAdmin')
        {
            Toastr::warning("You don't have enough permission to perform this operation!","Warning!");
            return redirect()->back();
        }

        return $next($request);
    }
}
