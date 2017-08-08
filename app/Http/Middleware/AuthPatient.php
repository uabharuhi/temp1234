<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthPatient
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

        if (!Auth::guard('patient')->check()) {
            $request->session()->flash('login_failed', 'patient ..you must login first');
            return redirect()->guest('/patient/login');
        }

        return $next($request);
    }
}
