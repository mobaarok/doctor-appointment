<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HospitalAuthenticate
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
        if( (Auth::guard('hospital')->check()) ) {
            return $next($request);
        }
        else {
            return redirect()->guest(route("hospital.login"));
        }
    }
}
