<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthDoctor
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

        if (!Auth::guard('doctor')->check()) {
            $request->session()->flash('login_failed', 'you must login first');
            return redirect()->guest('/doctor/login');
        }

        return $next($request);
    }
}
