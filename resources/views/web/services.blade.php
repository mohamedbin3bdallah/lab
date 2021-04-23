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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/services.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body>

<div class="super_container">
	
@endsection

@section('content')	

    <!-- Home -->

	@if(!empty($header))
	<div class="home">
		<div class="home_background parallax-window" style="background-image:url('{{url('uploads/images/'.$header->image)}}');background-position:center;" ></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><!--<span>lab</span>--> {{$header->title}}</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.services')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!-- Services -->

	@if(!empty($alldata))
	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title"><h2>{{$header->title}}</h2></div>
				</div>
			</div>
			<div class="row services_row">
				
				<!-- Service -->
				@foreach($alldata as $data)
				<div class="col-lg-4 col-md-6 service_col">
					<a href="{{url('service/'.$data->id)}}">
						<div class="service text-center trans_200">
							<div class="service_icon"><img class="svg" src="{{url('uploads/images/'.$data->image)}}" alt=""></div>
							<div class="service_title trans_200">{{$data->title}}</div>
							<div class="service_text">
								<p>{{(strlen($data->description) > 150)? substr($data->description,0,strpos($data->description,' ',140)):$data->description}}.</p>
							</div>
						</div>
					</a>
				</div>
				@endforeach

			</div>
		</div>
	</div>
	@endif
	
	
	
	
	<!-- footer -->
@endsection

@section('footer')

<!--end container-->
    </div>

<script src="{{asset('resources/assets/lab/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/lab/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('resources/assets/lab/js/financial_custom.js')}}"></script>
<script src="{{asset('resources/assets/lab/js/custom.js')}}"></script>

</body>
</html>

@endsection