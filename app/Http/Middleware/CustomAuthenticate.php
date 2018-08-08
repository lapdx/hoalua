<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Config;

class CustomAuthenticate
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

        // Status flag:
        $loginSuccessful = false;
        // Check username and password:
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            if ($username == env('BASIC_AUTHENTICATION_USERNAME') && $password == env('BASIC_AUTHENTICATION_PASSWORD')){
                $loginSuccessful = true;
            }
        }
        if ($loginSuccessful){
            return $next($request);
        }else{
            if (Auth::check()) {
                return $next($request);
            }
            // return response('Unauthorized.', 401);
            return redirect()->intended('login');
        }
    }
}
