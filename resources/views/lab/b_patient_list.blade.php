<!DOCTYPE html>
<html lang="en">
<head>
<title>Branch</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="LAB project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('resources/assets/lab/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!--======  fonts ======-->
<link href="{{asset('resources/assets/lab/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!--======  main STYLESHEETS ======-->
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/patient_list.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/test-result_responsive.css')}}">

<style>
.ul-danger, .li-danger, .ul-success, .li-success{
	text-align: center;
	padding: 1%;
}
.li-danger {
	list-style: none;
	color: #fff;
	background-color: red;
}
.li-success {
	list-style: none;
	color: #fff;
	background-color: green;
}
</style>

</head>
<body>
<div class="super_container">
	
<!-- Header -->

	<header class="header trans_200">
		
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            
							<div class="d-flex flex-row align-items-center justify-content-start ml-auto"><div class="main_menu_phone"><a href="{{url('logout')}}" class="btn btn-danger" style="float:right;">Logout</a>
  </div>
                        
                        </div>
							
							</div>
						</div>

					</div>
				</div>
			</div>
		
</header>

<div class="sidebar">
  <br /><br />
 <center>
 <i class="fa fa-user-circle" aria-hidden="true" style="font-size:60px;color:white;"></i>
 <p style="color:white;">{{$lab->name}} Lab</p>
 </center>
 
  <a class="active" href="{{url('lab/'.$lab_id.'/b_patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>
  
</div>



<br />
 <div class="content">
<div class="container">

  <h2 style="margin-top:4%;">
  Patient list
</h2>
 <hr>
  
    
   

@if (!empty($alldata))
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <div class="table-responsive">
		
		@if (session('success'))
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
		
		@if (session('fail'))
			<ul class="ul-danger">
					<li class="li-danger">
						{{session('danger')}}
					</li>
			</ul>
		@endif
		
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th>Tests Required</th>
		<th>Code</th>
        <th>Name</th>
		<!--<th>Email</th>
        <th>Phone</th>-->
		<th>Mobile</th>
		<th>Gender</th>
		<th>Age</th>
		<!--<th>Age Type</th>-->
		<th>Note</th>
        <!--<th>Date</th>-->
        <th>Total Coast</th>
		<!--<th>Discount</th>-->
		 @if(session('type')=='labs')<th>Settings</th>@endif
      </tr>
    </thead>
    <tbody id="myTable">
	@foreach ($alldata as $key => $data)
      <tr >
        <td>
          <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading{{$key}}">
             <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}"> Tests List
        </a>
      </h4>

        </div>
        <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
            <div class="panel-body" >
            <span style="font-size:12px;">
			@if(!empty($data->patient_test()))
				@foreach ($data->patient_test as $test)
					@if($test->file_path and $data->accept==2)<a href="{{url('uploads/pdf/'.$test->file_path)}}" target="_blank">{{$test->test()->first()->name}}</a> <br />
					@else {{$test->test()->first()->name}}<br />@endif
				@endforeach
			@endif
			</span>
            </div>
        </div>
    </div>

        </td>
		<td>{{$data->code}}</td>
        <td>{{$data->name}}</td>
		<!--<td>{{$data->email}}</td>
		<td>{{$data->phone}}</td>-->
        <td>{{$data->mobile}}</td>
		<td>{{($data->gender==1)? 'Male':'Female'}}</td>
		<td>{{$data->age.' - '}} @if($data->age_type==1) {{'Days'}} @elseif($data->age_type==2) {{'Months'}} @else {{'Years'}} @endif</td>
		<!--<td>@if($data->age_type==1) {{'Days'}} @elseif($data->age_type==2) {{'Months'}} @else {{'Years'}} @endif</td>-->
		<td>{{$data->note}}</td>
		<!--<td>{{$data->visit_date}}</td>-->
        <td>{{$data->total_invoice.' LE'}}</td>
		<!--<td>{{$data->discount}}</td>-->
		@if(session('type')=='labs')<td>@if($data->code == '' and $data->accept == 0)<a href="{{url('lab/b_old_patient/'.$data->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#myModal{{$data->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>@else<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i>@endif</td>@endif
      </tr>
	  
	  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<center>
						You want to delete this Patient
						<br>
						<br>
						<a href="{{url('lab/delete_patient/'.$data->id)}}" class="btn btn-danger">Delete</a>
						<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
					</center>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
		</div>
	
	  @endforeach
	  <!----------------------------------------------------------------------------------------------------------->
    </tbody>
  </table>
  {!! $alldata->render() !!}
   </div>
  @endif
</div>
    </div>
  
   </div>
   <script src="{{asset('resources/assets/lab/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/parallax-js-master/parallax.min.js')}}"></script>

<script src="{{asset('resources/assets/lab/js/custom.js')}}"></script>


</body>
</html>