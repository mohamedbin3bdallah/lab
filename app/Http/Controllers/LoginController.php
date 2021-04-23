<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Patient;
use App\Branch;
use App\Lab;

class LoginController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->types = array('users','patients','branches','labs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
		if(session('type'))
		{
			if(session('type') == 'users') return redirect('/admin');
			elseif(session('type') == 'patients') return redirect('/patient/test_result');
			elseif(session('type') == 'branches') return redirect('/branch');
			elseif(session('type') == 'labs') return redirect('/lab/'.session('id').'/patients');
		}
		else return view('web/admin_login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
		$attrs = array(
			'type' => 'Type',
			'email' => 'Email',
			'password' => 'Password',
		);

		$validator = Validator::make($request->all(), [
			'type' => 'required',
            'email' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('email',request('email'))->first();
		$find = DB::table(request('type'))->where('email',request('email'))->first();
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				session(['id' => $find->id]);
				session(['type' => request('type')]);
				if(request('type') == 'users') return redirect('/admin');
				elseif(request('type') == 'patients') return redirect('/patient/test_result');
				elseif(request('type') == 'branches') return redirect('/branch');
				elseif(request('type') == 'labs') return redirect('/lab/'.$find->id.'/patients');
			}
			else	return back()->withErrors('These credentials do not match our records');
		}
		else	return back()->withErrors('These credentials do not match our records');
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function logout()
	{
		Session::flush();
		return redirect('/');
	}
}
