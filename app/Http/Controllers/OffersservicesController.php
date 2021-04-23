<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use App\Offersservices;
use Auth;

class OffersservicesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->service_types = array(1=>'Offer',2=>'Service',3=>'New');
		$this->types = array('users');
		$this->logo = Maincms::where('name','logo')->first();
		if(!in_array(session('type'),$this->types)) return Redirect::to('admin_login')->send();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$alldata = Offersservices::paginate(10);
        return view('admin/services', array('alldata'=>$alldata,'types'=>$this->service_types,'logo'=>$this->logo));
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
		$services_count = Offersservices::where('flag',1)->count();
		if($services_count < 9)
		{
		$attrs = array(
			'title_en' => 'English Title',
			'title_ar' => 'Arabic Title',
			'description_en' => 'English Description',
			'description_ar' => 'Arabic Description',
			'image' => 'Image'
		);

		$validator = Validator::make($request->all(), [
            'title_en' => 'required|max:25',
			'title_ar' => 'required|max:25',
			'description_en' => 'required',
			'description_ar' => 'required',
			'image' => 'image|dimensions:width=690,height=481'
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

		$add = new Offersservices();		
		
		if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/services/', $fileName);
        if(request('oldimg')) unlink('./uploads/services/'.request('oldimg'));
        $add->image = $fileName;
      }

      $add->title_en = request('title_en');
	  $add->title_ar = request('title_ar');
      $add->description_en = request('description_en');
	  $add->description_ar = request('description_ar');
	  $add->flag = request('type');
      $add->save();
      return back()->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
		}
		else back()->with(array('modal'=>'myModal','success'=>'Max Offers is 9'));
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
        $attrs = array(
			'title_en' => 'English Title',
			'title_ar' => 'Arabic Title',
			'description_en' => 'English Description',
			'description_ar' => 'Arabic Description',
			'image' => 'Image'
		);

		$validator = Validator::make($request->all(), [
            'title_en' => 'required|max:25',
			'title_ar' => 'required|max:25',
			'description_en' => 'required',
			'description_ar' => 'required',
			'image' => 'dimensions:width=690,height=481',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

		$edit = Offersservices::find($id);		
		
		if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/services/', $fileName);
        if(request('oldimg')) unlink('./uploads/services/'.request('oldimg'));
        $edit->image = $fileName;
      }

      $edit->title_en = request('title_en');
	  $edit->title_ar = request('title_ar');
      $edit->description_en = request('description_en');
	  $edit->description_ar = request('description_ar');
	  $edit->flag = request('type');
      $edit->save();
      return back()->with(array('modal'=>'myModal'.$id,'success'=>'Saved Successfully'));
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
			if(Offersservices::find($id)->update(array('status'=>$status))) $message = array('status_success'=>'Saved Successfully');
			else $message = array('status_fail'=>'Somthing wrong');
			return back()->with($message);
		}
		else return redirect('admin_login');
    }
}
