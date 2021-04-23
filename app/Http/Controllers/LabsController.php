<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use App\Branch;
use App\Lab;

class LabsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->types = array('users','branches','labs');
		$this->logo = Maincms::where('name','logo')->first();
		if(!in_array(session('type'),$this->types)) return Redirect::to('test_result')->send();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(request()->segment(1) == 'branch' and session('type') == 'branches')
		{
			$data = Lab::where('branch_id',session('id'))->paginate(10);
			$branch = Branch::find(session('id'));
			return view('lab/branch_main_page' , array('alldata'=>$data, 'branch'=>$branch));
		}
		elseif(session('type') == 'users')
		{
			$data = Lab::paginate(10);
			return view('admin/labs' , array('alldata'=>$data,'logo'=>$this->logo));
		}
		else return redirect('admin_login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function status($id, $status)
    {
		if(session('type') == 'users')
		{
			if(Lab::find($id)->update(array('status'=>$status))) $message = array('success'=>'Saved Successfully');
			else $message = array('fail'=>'Somthing wrong');
			return back()->with($message);
		}
		else return redirect('test_result');
    }
}
