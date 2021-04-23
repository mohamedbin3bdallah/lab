<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Patient;
use App\Branch;
use App\Lab;

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
	
	public function login(Request $request)
{
	$attrs = array(
			'email' => 'Email',
			'password' => 'Password',
		);

		$validator = Validator::make($request->all(), [
            'email'           => 'required|max:255|email',
			'password'           => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
		  }

    if (Auth::guard('patient')->attempt(['email' => request('email'), 'password' => request('password')])) {
        // Success
        return redirect('/patient');
    } elseif (Auth::guard('branch')->attempt(['email' => request('email'), 'password' => request('password')])) {
        // Success
        return redirect('/branch');
		//$request->session()->push('email', request('email'));
		//print_r($request->session()->all());
		//print_r(Auth::user());
    } elseif (Auth::guard('lab')->attempt(['email' => request('email'), 'password' => request('password')])) {
        // Success
        return redirect('/lab/patients');
	} elseif (Auth::guard('web')->attempt(['email' => request('email'), 'password' => request('password')])) {
        // Success
        return redirect('/admin');
		//$request->session()->push('email', request('email'));
		//print_r($request->session()->all());
	} else {
        // Go back on error (or do what you want)
        return redirect()->back();
    }

}
	
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function authenticated()
	{
		if(auth()->user()->role == 'admin')
		{
			return redirect('/admin/home');
		}
		else return redirect('/');

		//return redirect('/user/dashboard');
	}
	
	//protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
