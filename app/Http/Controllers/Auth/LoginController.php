<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use function redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('checkStatus')->except('logout');
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/login');
    }
public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status'=>'active'])) {
            // Authentication passed...
            return redirect()->intended('/system/product');
        }
    }
}
