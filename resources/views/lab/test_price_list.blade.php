<!DOCTYPE html>
<html lang="en">
<head>
<title>LAB</title>
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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/styles/test-result_responsive.css')}}">



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
 
  
  @if(session('type')=='labs')<a href="{{url('lab/new_patient')}}"><i class="fa fa-user-plus"></i> New Patients</a>@endif
 
  @if(session('type')=='labs')<a href="{{url('lab/'.session('id').'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>
 
  @elseif(session('type')=='branches')<a href="{{url('lab/'.$lab_id.'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>@endif
  
  @if(session('type')=='labs')<a class="active" href="{{url('lab/'.session('id').'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>
 
  @elseif(session('type')=='branches')<a class="active" href="{{url('lab/'.$lab_id.'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>@endif
 
  @if(session('type')=='labs')<a href="{{url('lab/feedback')}}"><i class="fa fa-commenting" aria-hidden="true"></i> Feedback</a>@endif
  
</div>


 

 <div class="content">
<div class="container">
 <br><br>
  <h2>
  Test price list
</h2>
 <hr>
  
    
   

  
@if (!empty($alldata))
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th>ID</th>
		<th>TEST NAME</th>
		<!--<th>List</th>-->
        <th>SAMPLE TYPE	</th>
        <th>RUN/ PROCESS DAY</th>
		<th>PRECAUTIONS</th>
		<th>PRICE</th>
      </tr>
    </thead>
    <tbody id="myTable">
	@foreach ($alldata as $key => $data)
      <tr>
         <td>{{$key+1}}</td>
		<td>{{$data->test()->first()->name}}</td>
		<!--<td>{{$data->price_list()->first()->name}}</td>-->
        <td>{{$data->test()->first()->sample}}</td>
		<td>{{$data->test()->first()->process_day}}</td>
		<td>{{$data->test()->first()->precaution}}</td>
		<td>{{$data->price.' LE'}}</td>
      </tr>
	@endforeach
    </tbody>
	{!! $alldata->render() !!}
  </table>
    </div>
  @endif
    
</div>
    </div>
    </div>
    
<!--    script-->
<script src="{{asset('resources/assets/lab/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/parallax-js-master/parallax.min.js')}}"></script>

<script src="{{asset('resources/assets/lab/js/custom.js')}}"></script>


</body>
</html>