<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Maincms;
use App\Branch;
use App\Lab;
use App\Patient;
use App\Patienttest;
use App\Testprice;
use Auth;

class PatientsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->types = array('users','patients','branches','labs');
		$this->logo = Maincms::where('name','logo')->first();
		if(!in_array(session('type'),$this->types)) return Redirect::to('admin_login')->send();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=NULL)
    {
      if(request()->segment(1) == 'lab' and $id)
	  {
		  $data = Patient::where('lab_id',$id)->paginate(10);
		  $lab = Lab::find($id);
		  return view('lab/patient_list' , array('alldata'=>$data,'lab_id'=>$id,'lab'=>$lab));
	  }
	  /*elseif(request()->segment(1) == 'branch')
	  {
		  $data = Patient::where('branch_id',session('id'))->paginate(10);
		  return view('lab/patient_list' , array('alldata'=>$data));
	  }*/
	  elseif(session('type') == 'users')
	  {
		  $data = Patient::paginate(10);
		  return view('admin/patients' , array('alldata'=>$data,'logo'=>$this->logo));
	  }
	  else return redirect('test_result');
    }
	
	public function index_1($id)
    {
      if($id)
	  {
		  $data = Patient::where('branch_id',$id)->paginate(10);
		  $lab = Branch::find($id);
		  return view('lab/b_patient_list' , array('alldata'=>$data,'lab_id'=>$id,'lab'=>$lab));
	  }
	  else return redirect('test_result');
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test_result()
    {
		if(session('type') == 'patients')
		{
			$data = Patienttest::where('patient_id',session('id'))->paginate(10);
			$patient = Patient::find(session('id'));
			//echo '<pre>'; print_r($data); echo '</pre>';
			return view('lab/test_result' , array('alldata'=>$data,'patient'=>$patient));
		}
		else return redirect('test_result');	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(session('type') == 'labs')
		{
			$lab = Lab::find(session('id'));
			//$tests = Testprice::all();
			$tests = Testprice::where('list_id',$lab->price_list_id)->get();
			return view('lab/new_patient' , array('tests'=>$tests,'lab'=>$lab));
		}
		else return redirect('test_result');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//print_r(request('tests'));
        $attrs = array(
			'name' => 'Name',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'age' => 'Age',
			'age_type' => 'Age Type',
			'gender' => 'Gender',
			'tests' => 'Tests',
			'total' => 'Total Price',
		);
		
		$phone = '';
		$mobile = '';
		
		if(request('phone')) $phone = 'numeric|max:0999999999|min:02000000';
		if(request('mobile')) $mobile = 'numeric|max:01599999999|min:01000000000';

		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'phone' => $phone,
			'mobile' => $mobile,
			'age' => 'required|integer',
			'age_type' => 'required|integer',
			'gender' => 'required|integer',
			'tests' => 'required|array',
			'total' => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
          }

      $add = new Patient();
      $add->name = request('name');
      $add->phone = request('phone');
	  $add->mobile = request('mobile');
	  $add->age = request('age');
	  $add->age_type = request('age_type');
	  $add->gender = request('gender');
	  $add->total_invoice = request('total');
	  $add->visit_date = date('Y-m-d');
	  $add->lab_id = session('id');
      $add->save();
	  
	  $lab = Lab::find(session('id'));
	  
	  foreach (request('tests') as $test) {
		$test_price = Testprice::where(array('list_id'=>$lab->price_list_id,'test_id'=>$test))->get()->first();
		$add_test = new Patienttest();
		$add_test->test_id = $test;
		$add_test->patient_id = $add->id;
		$add_test->price = $test_price->price;
		$add_test->save();
	  }

      return back()->with(array('success'=>'Saved Successfully'));
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
		if(session('type') == 'labs')
		{
			$lab = Lab::find(session('id'));
			$patient = Patient::find($id);
			$tests = Testprice::where('list_id',$lab->price_list_id)->get();
			if(!empty($patient)) return view('lab/old_patient' , array('tests'=>$tests,'lab'=>$lab,'patient'=>$patient));
			else
			{
				$data = Patient::where('lab_id',session('id'))->paginate(10);
				$lab = Lab::find(session('id'));
				return view('lab/patient_list' , array('alldata'=>$data,'lab_id'=>$id,'lab'=>$lab));
			}
		}
		else return redirect('admin_login');
    }
	
	public function edit_1($id)
    {
		if(session('type') == 'branches')
		{
			$lab = Branch::find(session('id'));
			$patient = Patient::find($id);
			$tests = Testprice::where('list_id',$lab->price_list_id)->get();
			if(!empty($patient)) return view('lab/old_patient' , array('tests'=>$tests,'lab'=>$lab,'patient'=>$patient));
			else
			{
				$data = Patient::where('branch_id',session('id'))->paginate(10);
				$lab = Branch::find(session('id'));
				return view('lab/b_patient_list' , array('alldata'=>$data,'lab_id'=>$id,'lab'=>$lab));
			}
		}
		else return redirect('admin_login');
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
		$edit = Patient::find($id);
		if($edit->accept == 0)
		{
         $attrs = array(
			'name' => 'Name',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'age' => 'Age',
			'age_type' => 'Age Type',
			'gender' => 'Gender',
			'tests' => 'Tests',
			'total' => 'Total Price',
		);
		
		$phone = '';
		$mobile = '';
		
		if(request('phone')) $phone = 'numeric|max:0999999999|min:02000000';
		if(request('mobile')) $mobile = 'numeric|max:01599999999|min:01000000000';

		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'phone' => $phone,
			'mobile' => $mobile,
			'age' => 'required|integer',
			'age_type' => 'required|integer',
			'gender' => 'required|integer',
			'tests' => 'required|array',
			'total' => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
          }

      $edit = Patient::find($id);
      $edit->name = request('name');
      $edit->phone = request('phone');
	  $edit->mobile = request('mobile');
	  $edit->age = request('age');
	  $edit->age_type = request('age_type');
	  $edit->gender = request('gender');
	  $edit->total_invoice = request('total');
	  $edit->visit_date = date('Y-m-d');
	  $edit->lab_id = session('id');
      $edit->save();
	  
	  Patienttest::where('patient_id',$id)->delete();
	  
	  $lab = Lab::find(session('id'));  
	  
	  foreach (request('tests') as $test) {
		$test_price = Testprice::where(array('list_id'=>$lab->price_list_id,'test_id'=>$test))->get()->first();
		$add_test = new Patienttest();
		$add_test->test_id = $test;
		$add_test->patient_id = $id;
		$add_test->price = $test_price->price;
		$add_test->save();
	  }

      return back()->with(array('success'=>'Saved Successfully'));
		}
		else return back()->with(array('fail'=>'تم استقبال الحالة ولا يمكن اتعديل على الحالة'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$delete = Patient::find($id);
		if($delete->accept == 0)
		{
			Patienttest::where('patient_id',$id)->delete();
			Patient::find($id)->delete();
			return back()->with(array('success'=>'Saved Successfully'));
		}
		else return back()->with(array('fail'=>'تم استقبال الحالة ولا يمكن حذف على الحالة'));
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function status($id, $type, $status)
    {
		if(session('type') == 'users')
		{
			if(Patient::find($id)->update(array($type=>$status))) $message = array('success'=>'Saved Successfully');
			else $message = array('fail'=>'Somthing wrong');
			return back()->with($message);
		}
		else return redirect('test_result');
    }
}
