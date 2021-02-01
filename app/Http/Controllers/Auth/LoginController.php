<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	/**
	 * Handle an authentication attempt.
	 *
	 * @return Response
	 */
	public function authenticate(Request $request) {
		if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 'Y'])) {
			// Authentication passed...
			$user = Auth::user();
			$user->last_login = Carbon::now();

			return redirect()->intended('admin');

		} else {
			return redirect()->back()->with(['errors' => 'That username/password combination was not found. Please try again.']);
		}
	}
}
