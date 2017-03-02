<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
            echo Auth::User()->role;
            if (Auth::User()->role == 'normal') {
                return redirect()->route('front_home');
            }
            if (Auth::User()->role == 'admin') {
                return redirect()->route('admin_home');
            }
        }

        return $next($request);
    }

}
