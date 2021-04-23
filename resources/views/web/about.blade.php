@extends('web.layouts.app')

@section('header')

<!DOCTYPE html>
<html lang="en">
<head>
<title>{{$alldata[0]->title}}</title>
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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/about.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body>

<div class="super_container">
	
@endsection

@section('content')	
	
<!--HOME	-->
	@if(!empty($alldata[0]))
	<div style="background-image:url('{{url('uploads/images/'.$alldata[0]->image)}}')" class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">{{$alldata[0]->title}} <!--<span>Lab Med</span>--></div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.about')}}</li>
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

	@if(!empty($alldata[1]))
	<div class="about">
		<div class="container">
			<div class="row">

				<!-- About Content -->
				<div class="col-lg-7">
					<br><br>
					<div class="section_title"><h2>{{$alldata[1]->title}}</h2></div>
					<br>
					<div class="about_text">
						<p>
						<?php echo htmlspecialchars_decode(stripslashes($about->content)); ?>
						</p>
						
					</div>
                </div>
				
				<!-- Boxes -->
				<div class="col-lg-5 boxes_col">

					<!-- Box -->
					<div class="img working_hours">
						@if(strpos($alldata[1]->image, '.jpg') !== false)<div class="img d-flex flex-column align-items-start justify-content-center"><img  class="hero" src="{{url('uploads/images/'.$alldata[1]->image)}}">
						@else<iframe  class="youtube_video"  width="460" height="315" src="{{$alldata[1]->image}}" frameborder="0" allowfullscreen></iframe>
						@endif
					<br><br>
						
					</div>
				</div>
			</div>
			</div>
			
			<br>
			<br><br>
			<div class="row">
				<div class="col-lg-1">
				</div>
				<div class="col-lg-10">
					<div class="about_text">
						<p>
							<?php echo htmlspecialchars_decode(stripslashes($alldata[1]->content)); ?>
						</p>
					</div>
				</div>
				<div class="col-lg-1">
				</div>
			</div>
	    </div>
    </div>
	@endif

	
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