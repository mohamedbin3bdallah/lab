<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->types = array('users');
		$this->logo = Maincms::where('name','logo')->first();
		if(!in_array(session('type'),$this->types)) return Redirect::to('admin_login')->send();
		else $this->user = User::find(session('id'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/home', array('user'=>$this->user,'logo'=>$this->logo));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function error()
	{
		return view('admin/404', array('user'=>$this->user,'logo'=>$this->logo));
	}
}
