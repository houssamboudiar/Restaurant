<?php

namespace App\ Http\ Controllers\ Auth;
use Illuminate\Http\Request;
use App\ Http\ Controllers\ Controller;
use Illuminate\ Foundation\ Auth\ AuthenticatesUsers;

class LoginController extends Controller {
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

    protected
    function authenticated(Request $request, $user) {
        if ($user -> user_type == "client") {
            return redirect('/client');
        } else if ($user -> user_type == "serveur") {
            return redirect('/server');
        } else if ($user -> user_type == "cuisinier") {
            return redirect('/cuisinier');
        } else if ($user -> user_type == "admin"){
            return redirect('/admin');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public
    function __construct() {
        $this -> middleware('guest') -> except('logout');
    }
}
