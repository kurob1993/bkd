<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    * Modifikasi Cara Login
    * Login Dengan user name atau email
    */
    protected function attemptLogin($request)
    {
        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $loggedIn = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->filled('remember') );
        } else {
            //they sent their username instead 
            $loggedIn = Auth::attempt([
                'username' => $request->email,
                'password' => $request->password
            ], $request->filled('remember') );
        }
    }

    /*
    * Modifikasi Form Login
    * Form Login di arahkan ke folder core-ui untuk view template
    */
    public function showLoginForm()
    {
        return view('core-ui.auth.login');
    }
}
