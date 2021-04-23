<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use App\Cms;
use Auth;

class CmsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->pages = array(1=>'Home',2=>'About',3=>'Services',4=>'Test Labrary',5=>'House Visits',6=>'Test Results',7=>'Contact',8=>'Login',9=>'Sub Page');
		$this->types = array('users');
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
      $data = Cms::paginate(10);
      return view('admin/cms' , array('alldata'=>$data,'pages'=>$this->pages,'logo'=>$this->logo));
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
      $attrs = array(
		'title_ar' => 'Arabic Title',
		'title_en' => 'English Title',
        'content_ar' => 'Arabic Content',
		'content_en' => 'English Content',
		'image' => 'Image',
      );
	  
	  $image = '';
	  $title_ar = '';
	  $title_en = '';
	  $content_ar = '';
	  $content_en = '';

	  if(request()->hasFile('image') and request('page')==1 and request('section')=='slider') $image = 'mimes:jpeg|dimensions:width=1400,height=500';
	  //elseif(request()->hasFile('image') and request('page')==1 and request('section')=='about') $image = 'mimes:png|dimensions:width=435,height=400';
	  //elseif(request()->hasFile('image') and request('page')==1 and request('section')=='offers') $image = 'dimensions:width=690,height=481';
	  elseif(request()->hasFile('image') and request('page')==1 and request('section')=='apps') $image = 'mimes:jpeg|dimensions:width=1920,height=720';
	  
	  elseif(request()->hasFile('image') and request('page')==2 and request('section')=='header') $image = 'mimes:jpeg|dimensions:width=1920,height=600';
	  elseif(request()->hasFile('image') and request('page')==2 and request('section')=='body') $image = 'mimes:jpeg|dimensions:width=690,height=481';
	  
	  elseif(request()->hasFile('image') and request('page')==3 and request('section')=='header') $image = 'mimes:jpeg|dimensions:width=1920,height=600';
	  
	  elseif(request()->hasFile('image') and request('page')==4 and request('section')=='header') $image = 'mimes:jpeg|dimensions:width=1920,height=600';
	  
	  elseif(request()->hasFile('image') and request('page')==5 and request('section')=='header') $image = 'mimes:jpeg|dimensions:width=1920,height=600';
	  
	  elseif(request()->hasFile('image') and request('page')==6 and request('section')=='header') $image = 'mimes:jpeg|dimensions:width=1920,height=600';
	  
	  if(request('title_ar')) $title_ar = 'required|max:25';
	  if(request('title_en')) $title_en = 'required|max:25';
	  if(request('content_ar')) $content_ar = 'required';
	  if(request('content_en')) $content_en = 'required';
	  
	  $validator = Validator::make($request->all(), [
			'title_ar' => $title_ar,
			'title_en' => $title_en,
			'content_ar' => $content_ar,
			'content_en' => $content_en,
			'image' => $image,
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $add = Cms::find($id);
	  $fileName = request('oldimg');
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/images/', $fileName);
        if(request('oldimg') and strpos(request('oldimg'), '.jpg') !== false) unlink('./uploads/images/'.request('oldimg'));
        $add->image = $fileName;
      }

	  if(request('page')==1 and request('section')=='slider') 
	  {
		  if(request('active')) $add->status = request('active');
		  else $add->status = 0;
	  }
      $add->title_ar = request('title_ar');
	  $add->content_ar = request('content_ar');
	  $add->title_en = request('title_en');
	  $add->content_en = request('content_en');
	  $add->link = request('link');
	  $add->image = $fileName;
	  if($add->page_flag==2 and $add->section=='body' and request('link')) $add->image = request('link');
      $add->save();
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
			if(Cms::find($id)->update(array('status'=>$status))) $message = array('status_success'=>'Saved Successfully');
			else $message = array('status_fail'=>'Somthing wrong');
			return back()->with($message);
		}
		else return redirect('test_result');
    }
}
