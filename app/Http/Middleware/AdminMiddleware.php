<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\DB;
use Session;

class AdminMiddleware {

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->user()) {
            if ($this->auth->user()->confirmed == 0) {
                Session::flush();
                Session::flash('error', 'Please check your Mail Box for verification!');
                return redirect()->route('admin_login');
            }
            if ($this->auth->user()->locked == 1) {
                Session::flush();
                Session::flash('error', 'Your Account is locked!');
                return redirect()->route('admin_login');
            }
            if ($this->auth->user()->role == 'normal') {
                Session::flush();
                Session::flash('error', 'Email and password is invalid.');
                return redirect()->route('admin_login');
            }
            return $next($request);
        } else {
            return redirect()->route('admin_login');
        }
        return $next($request);
    }

}
