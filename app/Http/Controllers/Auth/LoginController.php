<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        redirectPath as laravelRedirectPath;
    }

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
    }

    public function redirectPath()
    {
        // Do your logic to flash data to session...
        flash('You are logged')->success();

        // Return the results of the method we are overriding that we aliased.
        return $this->laravelRedirectPath();
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            flash('You need to confirm your account. We have sent you an activation code, please check your email.');
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
      //  return back();
    }
}
