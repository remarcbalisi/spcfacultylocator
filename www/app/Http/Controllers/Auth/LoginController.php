<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;

//models
use App\User;

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
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt( $request->only(['username','password']), $request->has('remember') )) {
            // Authentication passed...
            return redirect()->back();
        }

        return redirect()
                ->back()
                ->with('info','Username and password does not match');
    }

    public function logout(){
        Auth::logout();
        return redirect('index');
    }
}
