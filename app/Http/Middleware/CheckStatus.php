<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use function redirect;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::check() && Auth::user()->status != 'active'){
            Auth::logout();
            return redirect('/login')->with('error_login', 'User have been blocked');
        }
        return $response;
    }
}
