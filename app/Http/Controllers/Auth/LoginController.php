<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if($user->status == 0){
            $request->session()->flush();
            return redirect()->route('login')->with('error', 'Account not activated. Contact the administrator.');
        }else if($user->status == 1){
            date_default_timezone_set("Asia/Kathmandu");
            activity('User Module')->causedBy(Auth::user())->log("The User " . ucfirst(Auth::user()->name). " has signed in the ". ucfirst(Auth::user()->user_type). " dashboard at ". date("h:ia") );
            return redirect()->intended($this->redirectPath());
        }
    }

    public function logout(Request $request)
    {
        if(Auth::user()){
            date_default_timezone_set("Asia/Kathmandu");
            activity('User Module')->causedBy(Auth::user())->log("The User " . ucfirst(Auth::user()->name). " has signed out from the ". ucfirst(Auth::user()->user_type). " dashboard at ". date("h:ia") );
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
