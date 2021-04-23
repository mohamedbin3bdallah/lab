<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Branch;
use App\Test;
use App\Cms;
use App\Maincms;
use App\User;
use App\Offersservices;
use App\Homevisit;
use Mail;
use Auth;

class FrontController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
	{
        $this->langs = array('ar','en');
		$this->types = array('users','patients','branches','labs');
		if(in_array(session('lang'),$this->langs)) $this->lang = session('lang');
		else $this->lang = 'ar';
		$this->contact = Maincms::select('name','value_'.$this->lang.' as value')->get();
		$this->news = Offersservices::select('id','title_'.$this->lang.' as title','description_'.$this->lang.' as description','updated_at')->where(array('flag'=>3,'status'=>1))->orderBy('updated_at','DESC')->take(3)->get();
		$this->clr1 = Maincms::select('value_'.$this->lang.' as content')->where('name','main_color')->get()->first();
		$this->clr2 = Maincms::select('value_'.$this->lang.' as content')->where('name','second_color')->get()->first();
		\App::setLocale($this->lang);
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lang($lang,$page=NULL)
    {
	  if(in_array($lang,$this->langs)) session(['lang' => $lang]);
	  else session(['lang' => 'ar']);
      if($page) return redirect(str_replace('-','/',$page))->with(array());
	  else return redirect('/')->with(array());
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function error()
    {
        return view('web/404' , array('news'=>$this->news,'contact'=>$this->contact));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sliders = Cms::select('id','title_'.$this->lang.' as title','content_'.$this->lang.' as content','image','link')->where(array('page_flag'=>1,'section'=>'slider','status'=>1))->get();
      $about = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('page_flag'=>1,'section'=>'about'))->get()->first();
	  $about2 = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('page_flag'=>2,'section'=>'body'))->get()->first();
	  $offers = Offersservices::select('id','title_'.$this->lang.' as title','description_'.$this->lang.' as description','image')->where(array('flag'=>1,'status'=>1))->get();
	  $apps = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('page_flag'=>1,'section'=>'apps'))->get()->first();
	  $android = Maincms::select('value_'.$this->lang.' as content')->where('name','android')->get()->first();
	  $ios = Maincms::select('value_'.$this->lang.' as content')->where('name','ios')->get()->first();
      return view('web/index', with(array('sliders'=>$sliders,'about'=>$about,'about2'=>$about2,'offers'=>$offers,'apps'=>$apps,'android'=>$android,'ios'=>$ios,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2)));
    }
	
		/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slider($id)
    {
		$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>9,'section'=>'header'))->get()->first();
		$data = Cms::select('id','title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('id'=>$id))->get()->first();
        return view('web/slider' , array('data'=>$data,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
		$alldata = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('page_flag'=>2,'status'=>1))->get();
		$about = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content','image')->where(array('page_flag'=>1,'section'=>'about'))->get()->first();
        return view('web/about' , array('alldata'=>$alldata,'about'=>$about,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
		$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>3))->get()->first();
		$alldata = Offersservices::select('id','title_'.$this->lang.' as title','description_'.$this->lang.' as description','image')->where(array('flag'=>2,'status'=>1))->get();
        return view('web/services' , array('alldata'=>$alldata,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test_library()
    {
		$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>4))->get()->first();
		$alldata = Test::all();
        return view('web/test_library' , array('alldata'=>$alldata,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function house_visit(Request $request)
    {
		if(request('submit'))
        {
          $attrs = array(
            'patient_name' => __('lab.name'),
            'patient_phone' => __('lab.phone'),
            'address' => __('lab.address'),
            'date' => __('lab.date'),
            'notes' => __('lab.note'),
			'file' => __('lab.file'),
          );
		  
		  $validator = Validator::make($request->all(), [
			'patient_name' => 'required|max:50',
            'patient_phone' => 'required|numeric|max:01599999999|min:01000000000',
            'address' => 'required',
            'date' => 'required|date',
            'notes' => 'required',
			'file' => '',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
          }

			$add = new Homevisit();		  

			if (request()->hasFile('file')) {
				$file = request()->file('file');
				$fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
				$file->move('./uploads/house_visits/', $fileName);
				$add->file_upload = $fileName;
			}

			$add->patient_name = request('patient_name');
			$add->patient_phone = request('patient_phone');
			$add->address = request('address');
			$add->date = request('date');
			$add->notes = request('notes');
			$add->save();
			return back()->with(array('success_message'=>__('lab.success_message'), 'color'=>'green'));
        }
        else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>5,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>5,'section'=>'body'))->get()->first();
			return view('web/house_visit' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test_result()
    {
		$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>6,'section'=>'header'))->get()->first();
        return view('web/test_result' , array('header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        if(request('submit'))
        {
          $attrs = array(
            'name' => __('lab.name'),
            'email' => __('lab.email'),
            'subject' => __('lab.subject'),
            'message' => __('lab.message'),
          );

          $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'email' => 'required|email|max:250',
            'subject' => 'required|max:250',
            'message' => 'required',
          ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
          }


          $data = array(
			'name' => request('name'),
			'email' => request('email'),
			'subject' => request('subject'),
			'message' => request('message'),
		   );
          Mail::send(['html'=>'web/mail/contact'], ['data'=>$data], function($message){
            $message->to('mohamedsalem66770@email.com', 'Company Name')->subject('Contact Form');
            $message->from(request('email'),request('name'));
          });
          return back()->with(array('success_message'=>__('lab.success_message'), 'color'=>'green'));
        }
        else
		{
			$data = Branch::select('id','name_'.$this->lang.' as name','address_'.$this->lang.' as address','email','phone','latitude','longitude')->where('status',1)->get();
			$lng_lat = Maincms::select('value_'.$this->lang.' as content')->where('name','lng_lat')->get()->first();
			return view('web/contact' , array('alldata'=>$data,'lng_lat'=>$lng_lat,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id)
    {
		$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>9,'section'=>'header'))->get()->first();
		$data = Offersservices::select('id','title_'.$this->lang.' as title','description_'.$this->lang.' as description','image','updated_at')->where(array('id'=>$id))->get()->first();
        return view('web/service' , array('data'=>$data,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function loginForm()
    {
		if(session('type'))
		{
			if(session('type') == 'users') return redirect('/admin');
			elseif(session('type') == 'patients') return redirect('/patient/test_result');
			elseif(session('type') == 'branches') return redirect('/branch');
			elseif(session('type') == 'labs') return redirect('/lab/'.session('id').'/patients');
		}
		else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>8,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>8,'section'=>'body'))->get()->first();
			return view('web/login' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact));
		}
    }*/
	
	/*public function login(Request $request)
    {
		$attrs = array(
			'username' => __('lab.username'),
			'password' => __('lab.username'),
		);

		$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('user_name',request('username'))->first();
		$find = DB::table('users')->where('user_name',request('username'))->first();
		$type = 'users';
		if(empty($find)) { $type = 'patients'; $find = ''; $find = DB::table('patients')->where('user_name',request('username'))->first(); }
		if(empty($find)) { $type = 'branches'; $find = ''; $find = DB::table('branches')->where('user_name',request('username'))->first(); }
		if(empty($find)) { $type = 'labs'; $find = ''; $find = DB::table('labs')->where('user_name',request('username'))->first(); }
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				if($find->status)
				{
					session(['id' => $find->id]);
					session(['type' => $type]);
					if($type == 'users') return redirect('/admin');
					elseif($type == 'patients') return redirect('/patient/test_result');
					elseif($type == 'branches') return redirect('/branch');
					elseif($type == 'labs') return redirect('/lab/'.$find->id.'/patients');
				}
				else	return back()->withErrors(__('lab.user_block'));
			}
			else	return back()->withErrors(__('lab.credential'));
		}
		else	return back()->withErrors(__('lab.credential'));
    }*/
	
	public function admin_loginForm()
    {
		if(session('type') == 'users') return redirect('/admin');
		else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>8,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>8,'section'=>'body'))->get()->first();
			return view('web/admin_login' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	public function patient_loginForm()
    {
		if(session('type') == 'patients') return redirect('/patient/test_result');
		else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>8,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>8,'section'=>'body'))->get()->first();
			return view('web/patient_login' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	public function branch_loginForm()
    {
		if(session('type') == 'branches') return redirect('/branch');
		else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>8,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>8,'section'=>'body'))->get()->first();
			return view('web/branch_login' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	public function lab_loginForm()
    {
		if(session('type') == 'labs') return redirect('/lab/'.session('id').'/patients');
		else
		{
			$header = Cms::select('title_'.$this->lang.' as title','image')->where(array('page_flag'=>8,'section'=>'header'))->get()->first();
			$body = Cms::select('title_'.$this->lang.' as title','content_'.$this->lang.' as content')->where(array('page_flag'=>8,'section'=>'body'))->get()->first();
			return view('web/lab_login' , array('body'=>$body,'header'=>$header,'news'=>$this->news,'contact'=>$this->contact,'clr1'=>$this->clr1,'clr2'=>$this->clr2));
		}
    }
	
	public function admin_login(Request $request)
    {
		$attrs = array(
			'username' => __('lab.username'),
			'password' => __('lab.username'),
		);

		$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('user_name',request('username'))->first();
		$find = DB::table('users')->where('user_name',request('username'))->first();
		$type = 'users';
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				if($find->status)
				{
					session(['id' => $find->id]);
					session(['type' => $type]);
					return redirect('/admin');
				}
				else	return back()->withErrors(__('lab.user_block'));
			}
			else	return back()->withErrors(__('lab.credential'));
		}
		else	return back()->withErrors(__('lab.credential'));
    }
	
	public function patient_login(Request $request)
    {
		$attrs = array(
			'username' => __('lab.username'),
			'password' => __('lab.username'),
		);

		$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('user_name',request('username'))->first();
		$find = DB::table('patients')->where('user_name',request('username'))->first();
		$type = 'patients';
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				if($find->status)
				{
					session(['id' => $find->id]);
					session(['type' => $type]);
					return redirect('/patient/test_result');
				}
				else	return back()->withErrors(__('lab.user_block'));
			}
			else	return back()->withErrors(__('lab.credential'));
		}
		else	return back()->withErrors(__('lab.credential'));
    }
	
	public function branch_login(Request $request)
    {
		$attrs = array(
			'username' => __('lab.username'),
			'password' => __('lab.username'),
		);

		$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('user_name',request('username'))->first();
		$find = DB::table('branches')->where('user_name',request('username'))->first();
		$type = 'branches';
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				if($find->status)
				{
					session(['id' => $find->id]);
					session(['type' => $type]);
					return redirect('/branch');
				}
				else	return back()->withErrors(__('lab.user_block'));
			}
			else	return back()->withErrors(__('lab.credential'));
		}
		else	return back()->withErrors(__('lab.credential'));
    }
	
	public function lab_login(Request $request)
    {
		$attrs = array(
			'username' => __('lab.username'),
			'password' => __('lab.username'),
		);

		$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
			'password' => 'required',
		]);
		  
		$validator->SetAttributeNames($attrs);

		if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
        }

		//$find = request('type')::where('user_name',request('username'))->first();
		$find = DB::table('labs')->where('user_name',request('username'))->first();
		$type = 'labs';
		if(!empty($find))
		{
			if(password_verify(request('password'), $find->password))
			{
				if($find->status)
				{
					session(['id' => $find->id]);
					session(['type' => $type]);
					return redirect('/lab/'.$find->id.'/patients');
				}
				else	return back()->withErrors(__('lab.user_block'));
			}
			else	return back()->withErrors(__('lab.credential'));
		}
		else	return back()->withErrors(__('lab.credential'));
    }
	
	public function logout()
	{
		Session::flush();
		return redirect('/');
	}
}
