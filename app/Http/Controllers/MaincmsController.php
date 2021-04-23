<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use Auth;

class MaincmsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->sections = array('logo'=>'Logo','main_color'=>'Main Color','second_color'=>'Second Color','facebook'=>'Facebook','youtube'=>'Youtube','instagram'=>'Instagram','address'=>'Address','email'=>'Email','phone'=>'Phone','cobyright'=>'CobyRight','ios'=>'IOS App','android'=>'Android App','lng_lat'=>'Lng Lat');
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
      $data = Maincms::paginate(10);
      return view('admin/maincms' , array('alldata'=>$data,'sections'=>$this->sections,'logo'=>$this->logo));
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
      $attrs = array();
	  
	  $value = '';
	  $value_ar = '';
	  $value_en = '';

	  if(request()->hasFile('image') and request('section')=='logo') { $attrs['value'] = 'Image'; $value = 'image|dimensions:width=150,height=139'; }
	  elseif(in_array(request('section'), array('facebook','youtube','instagram')) and request('value_ar')!='' and request('value_en')!='') { $attrs['value_ar'] = 'URL'; $attrs['value_en'] = 'URL'; $value_ar = 'required|URL'; $value_en = 'required|URL'; }
	  elseif(in_array(request('section'), array('main_color','second_color'))) { $attrs['value_ar'] = 'Color'; $attrs['value_en'] = 'Color'; $value_ar = 'required|max:7|min:4'; $value_en = 'required|max:7|min:4'; }
	  elseif(in_array(request('section'), array('email'))) { $attrs['value_ar'] = 'Email'; $attrs['value_en'] = 'Email'; $value_ar = 'required|email'; $value_en = 'required|email'; }
	  elseif(in_array(request('section'), array('phone'))) { $attrs['value_ar'] = 'Phone'; $attrs['value_en'] = 'Phone'; $value_ar = 'required|numeric|max:99999999999'; $value_en = 'required|numeric|max:99999999999'; }
	  
	  $validator = Validator::make($request->all(), [
			'image' => $value,
			'value_ar' => $value_ar,
			'value_en' => $value_en,
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $add = Maincms::find($id);
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/images/', $fileName);
        if(request('oldimg')) unlink('./uploads/images/'.request('oldimg'));
        $add->value_ar = $fileName;
		$add->value_en = $fileName;
		$add->save();
      }
	  else
	  {
		$add->value_ar = request('value_ar');
		$add->value_en = request('value_en');
		$add->save();
	  }
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
