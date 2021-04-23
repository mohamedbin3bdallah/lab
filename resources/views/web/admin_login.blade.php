@extends('web.layouts.app')

@section('header')

<!DOCTYPE html>
<html lang="en">
<head>
<title>{{__('lab.admin_login')}}</title>
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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/login.css')}}">
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
							<div class="home_title"> {{$header->title}}<!--  <span>Result</span>--></div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.admin_login')}}</li>
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

	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-6">
					<div class="section_title"><h2>{{$body->title}}</h2></div>
					<div class="about_text">
						<p> 
						
{{$body->content}}
						</p>
                            
                        
						
					</div>
                </div>
				
				<!-- Boxes -->
				<div class="col-lg-6 boxes_col">

					<!-- Box -->
					<div class="img working_hours">
						<div class="img d-flex flex-column align-items-start justify-content-center">
						 <div class="section_title"><h2>{{__('lab.admin_login')}}</h2></div>
 <div class="contact_form_container">
 
						@if ($errors->any())
							<ul class="ul-danger">
								@foreach ($errors->all() as $error)
									<li class="li-danger">
										{{$error}}
									</li>
								@endforeach
							</ul>
						@endif
		
						@if (session('success_message'))
							<ul class="ul-success">
								<li class="li-success">
									{{session('success_message')}}
								</li>
							</ul>
						@endif

						<form class="contact_form" method="POST" action="{{ url('admin_login') }}">
                        {{ csrf_field() }}
							<div class="input_container"><input type="text" name="username" class="contact_input" placeholder="{{__('lab.username')}}" required="required"></div>
							<div class="input_container"><input type="password" name="password" class="contact_input" placeholder="{{__('lab.password')}}" required="required"></div>
						
						<!--<button type="submit" class="button contact_button"><a href="#">Login</a></button>-->
						<button type="submit" class="button contact_button">{{__('lab.login')}}</button>
						</form>
						<br><br>
					</div>
</div>
					</div>
				</div>
			</div>
		</div>
	    </div>
   
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