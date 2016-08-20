<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfUserIsNotAdmin
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
        if(!Auth::user()) {
            return redirect('/auth/login')
                    ->withErrors("You must be logged in to view this page.");
        }
        else {
            if(Auth::user()->type != 'admin') {
                Auth::logout();
                return redirect('/auth/login')
                        ->with("warning", "You don't have enough permissions to view this page.");;
            }
        }

        return $next($request);
    }
}
