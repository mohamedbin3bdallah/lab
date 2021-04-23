<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Branch;
use App\Driver;
use App\Feedback;
use App\Test;
use App\Cms;
use App\Homevisit;
use App\Maincms;
use App\Offersservices;
//use Response;

class ApiController extends Controller
{

  public function get_all_tests(Request $request){
    $data = null;
    if(! isset($request->lang)){
      $code = 410;
      $message = "Invalid Request";
    }else{
      /*if($request->lang == "English"){
        $tests = Test::select('name_en as name', 'sample_en as sample' , 'precaution_en as precaution' , 'process_day_en as process_day')->get();
      }  else {
        $tests = Test::select('name_ar as name', 'sample_ar as sample' , 'precaution_ar as precaution' , 'process_day_ar as process_day')->get();
      }*/
      $tests = Test::select('name', 'sample' , 'precaution' , 'process_day')->get();

      if($tests->count() <= 0){
        $code = 411;
        $message = "There is no data";
      }else{
        $code = 200;
        $message = "Done";
        $data['tests']=$tests;
    }
    }
    return $this->returnJson($message,$code,$data);
  }

  public function get_all_branches(Request $request){
    $data = null;
    if(! isset($request->lang)){
      $code = 410;
      $message = "Invalid Request";
    }else{
      if($request->lang == "English"){
        $branches = Branch::select('name_en as name', 'address_en as address' , 'latitude' , 'longitude')->get();
      }  else {
        $branches = Branch::select('name_ar as name', 'address_ar as address' , 'latitude' , 'longitude')->get();
      }

      if($branches->count() <= 0){
        $code = 411;
        $message = "There is no data";
      }else{
        $code = 200;
        $message = "Done";
        $data['branches']=$branches;
      }

    }
    return $this->returnJson($message,$code,$data);
  }

  public function get_all_offers(Request $request){
    $data = null;
    if(! isset($request->lang)){
      $code = 410;
      $message = "Invalid Request";
    }else{
      if($request->lang == "English"){
        $offers = Offersservices::select('title_en as title', 'description_en as description' , 'image')->where('flag',1)->get();
      }  else {
        $offers = Offersservices::select('title_ar as title', 'description_ar as description' , 'image')->where('flag',1)->get();
      }

      if($offers->count() <= 0){
        $code = 411;
        $message = "There is no data";
      }else{
        $code = 200;
        $message = "Done";
        $data['offers']=$offers;
      }
    }
    return $this->returnJson($message,$code,$data);
  }

  public function get_about(Request $request){
    $data = null;
    if(! isset($request->lang)){
      $code = 410;
      $message = "Invalid Request";
    }else{
      if($request->lang == "English"){
        $about = Cms::select('title_en as title', 'content_en as content' , 'image')->where('page_flag',2)->where('section',"body")->first();
      }  else {
        $about = Cms::select('title_ar as title', 'content_ar as content' , 'image')->where('page_flag',2)->where('section',"body")->first();
      }

      if($about == ""){
        $code = 411;
        $message = "There is no data";
      }else{
        $code = 200;
        $message = "Done";
        $data['about']=$about;
      }
    }
    return $this->returnJson($message,$code,$data);
  }

  public function get_contact(Request $request){
    $data = null;
    //$contact = Maincms::all();
    $facebook = Maincms::select('value_en')->where('name','facebook')->first();
    $youtube = Maincms::select('value_en')->where('name','youtube')->first();
    $instagram = Maincms::select('value_en')->where('name','instagram')->first();
    $email = Maincms::select('value_en')->where('name','email')->first();
    $phone = Maincms::select('value_en')->where('name','phone')->first();
    $contact = Maincms::select('value_en as address_en','value_ar as address_ar')->where('name','address')->first();
    $contact->facebook = $facebook->value_en;
    $contact->youtube = $youtube->value_en;
    $contact->instagram = $instagram->value_en;
    $contact->email = $email->value_en;
    $contact->phone = $phone->value_en;
    if($contact->count() <=0){
      $code = 411;
      $message = "There is no data";
    }else{
      $code = 200;
      $message = "Done";
      $data['contact']=$contact;
    }
    return $this->returnJson($message,$code,$data);
  }

  public function home_visit_request(Request $request){
    $data = null;
    if(! isset($request->patient_name) || ! isset($request->patient_phone) || ! isset($request->address) || ! isset($request->notes) || ! isset($request->date)){
      $code = 410;
      $message = "Invalid Request";
    }else{
      $home_visit = new Homevisit();
      $home_visit->patient_name = $request->patient_name;
      $home_visit->patient_phone = $request->patient_phone;
      $home_visit->address = $request->address;
      $home_visit->notes = $request->notes;
      $home_visit->date = $request->date;
      $home_visit->save();

      if(isset($request->file)){
        $name = "home_visit_".$home_visit->id.".jpg";
        $this->uploadFile($request->file ,"./uploads/house_visits/" ,$name);
        $home_visit->file_upload = $name;
        $home_visit->save();

      }

      $code = 200;
      $message = "Done";

    }
    return $this->returnJson($message,$code,$data);
  }


/******************** Helper *************************/

  public function uploadFile($file,$path,$name){
        $f = finfo_open();
        $decoded_img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));

        $mime_type = finfo_buffer($f, $decoded_img, FILEINFO_MIME_TYPE);
        //file_put_contents(public_path($path).$name, $decoded_img);
        file_put_contents($path.$name, $decoded_img);
    }

  public function returnJson($message,$code,$data){
    $status = array('message' => $message,'code'=>$code);
    if($data != null){
      $response  = array('status'=>$status,'data' =>$data);
    } else {
      $response  = array('status'=>$status);
    }
    return response()->json($response, 200);
  }

}
