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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<!--======  fonts ======-->
<link href="{{asset('resources/assets/lab/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!--======  main STYLESHEETS ======-->
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/test-result.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/test-result_responsive.css')}}">
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


	<!-- Menu -->

	<div class="menu_container menu_mm" id="lab"> 

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="index.html">Home</a></li>
					<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
					<li class="menu_item menu_mm"><a href="#">Services</a></li>
					<li class="menu_item menu_mm"><a href="#">News</a></li>
					<li  class="menu_item menu_mm"><a href="#">TEST LIBRARY</a></li>
					<li  class="menu_item menu_mm"><a href="visit.html">HOUSE VISITS</a></li>
			        <li  class="menu_item menu_mm"><a href="loginaccess.html">TEST RESULT</a></li>
					<li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="menu_extra">
				<div class="menu_appointment"><a href="#">Request an Appointment</a></div>
				<div class="menu_emergencies">For Emergencies:196000</div>
			</div>

		</div>

	</div>
	
	
<!-- inrto-->
<div class="container" >
<div class="sty_padding">

<br /><br />
<ul class="breadcrumb">
    <li><span>Patient Profile</span></li> 	
  </ul>

  </div>

  
<div class="row">
<div class="col-sm-6">
<h5>Date: {{$patient->visit_date}}</h5>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
<h5>Patient Name: {{$patient->name}}</h5>
</div>
</div>
<div class="row">
  <div class="col-sm-6">
<h5>Age: {{$patient->age}} Years</h5>
</div>
</div>
<hr />



<div class="container mt-3">
<center><h1>Test Results</h1></center><br />
@if (!empty($alldata))
@foreach ($alldata as $key => $data)
<ul class="list-group">
    <li class="list-group-item">
	<img src="{{url('uploads/images/form.png')}}" width="60px">&nbsp;|&nbsp;@if($data->file_path)<a href="{{url('uploads/pdf/'.$data->file_path)}}" target="_blank">@endif{{$data->test()->first()->name}}@if($data->file_path)</a>@endif
	</li>
</ul>
@endforeach
{!! $alldata->render() !!}
@endif
</div>

</div>
	
</div>


<!--script-->

<script src="{{asset('resources/assets/lab/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/js/patient-details.js')}}"></script>



</body>
</html>