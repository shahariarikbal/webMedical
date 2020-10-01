<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class ClientMiddleware
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
        if (Session::get('id')) {
            return $next($request);
        }else {
            return redirect('/clients/login-form')->with('error', 'Invalid User Login');
        }

    }
}
