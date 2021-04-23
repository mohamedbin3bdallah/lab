@extends('web.layouts.app')

@section('header')

<!DOCTYPE html>
<html lang="en">
<head>
<title>{{$header->title}}</title>
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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/loginaccess.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body>

<div class="super_container">
	
@endsection

@section('content')
	
<!--HOME	-->
	@if(!empty($header))
	<div style="background-image:url('{{url('uploads/images/'.$header->image)}}')" class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">{{$header->title}}<!-- <span>Results</span>--></div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.test_result')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	
	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-6">
					<div class="section_title"><i class="fa fa-flask flak" style="font-size:38px"></i><a href="{{url('lab_login')}}"><h2>{{__('lab.lab_result')}}</h2></a></div>
                </div>
					
				<!-- Boxes -->
				<div class="col-lg-6 boxes_col">
				<div class="section_title"><i class="fa fa-sitemap" style="font-size:38px"></i><a href="{{url('branch_login')}}"><h2>{{__('lab.branch_result')}}</h2></a></div>	
			</div>
		</div>
		<br>
		<div class="row">

				<!-- About Content -->
				<div class="col-lg-12">
					<div class="section_title"><i class="fa fa-newspaper-o" style="font-size:36px"></i><a href="{{url('patient_login')}}"><h2>{{__('lab.patient_result')}}</h2></a></div>
                </div>
				
				
		</div>
	    </div>
    </div>
	
	
	<!-- footer -->

@endsection

@section('footer')
	
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

@endsection