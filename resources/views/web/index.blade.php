@extends('web.layouts.app')

@section('header')

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

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/main_styles.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body>

<div class="super_container">

@endsection

@section('content')	
<!--HOME	-->

	@if(isset($sliders[0]))
	<div class="home">
			<div class="home_slider_container">
			
			<!-- Home Slider -->

			<div class="owl-carousel owl-theme home_slider">
				
				@foreach($sliders as $slider)
				<!-- Slider Item -->
				<div class="owl-item">
					<div class="slider_background" style="background-image:url('{{url('uploads/images/'.$slider->image)}}')"></div>
					<div class="container fill_height">
						@if(empty($slider->title) and empty($slider->content))
						@else
						<div class="row fill_height">
							<div class="col fill_height">
								<div class="home_slider_content">
									<h1>{{$slider->title}}</h1>
									<div class="home_slider_text">{{(strlen($slider->content) > 150)? substr($slider->content,0,strpos($slider->content,' ',140)):$slider->content}}</div>
									<!--@if($slider->link!='')<div class="link_button home_slider_button"><a id="read" href="{{$slider->link}}">{{__('lab.read_more')}}</a></div>@endif-->
									@if($slider->content!='')<div class="link_button home_slider_button"><a id="read" href="{{url('slider/'.$slider->id)}}">{{__('lab.read_more')}}</a></div>@endif
								</div>
							</div>
						</div>
						@endif
					</div>	
				</div>
				@endforeach

			</div>

			<div class="home_slider_nav home_slider_prev d-flex flex-column align-items-center justify-content-center"><img src="{{url('uploads/images/arrow_l.png')}}" alt=""></div>
			<div class="home_slider_nav home_slider_next d-flex flex-column align-items-center justify-content-center"><img src="{{url('uploads/images/arrow_r.png')}}" alt=""></div>

		</div>
		
	</div>
	@endif
	
	<!-- About -->

	@if(!empty($about))
	<div class="about">
		<div class="container">
			<div class="row row-lg-eq-height">
				
				<!-- About Content -->
				<div class="col-lg-7">
					<div class="about_content">
						<div class="section_title"><h2>{{$about->title}}</h2></div>
						<div class="about_text">
							<p><?php echo htmlspecialchars_decode(stripslashes($about->content)); ?></p>
						</div>
						
					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-5">
					@if(strpos($about2->image, '.jpg') !== false)<div class="about_image"><img src="{{url('uploads/images/'.$about2->image)}}" alt=""></div>
						@else<iframe  class="youtube_video"  width="460" height="315" src="{{$about2->image}}" frameborder="0" allowfullscreen></iframe>
						@endif
				</div>
			</div>
		</div>
	</div>
	@endif
<!-- Departments -->

	@if(!empty($offers))
	<div class="departments">
		
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title section_title_light"><h2>{{__('lab.offers')}}</h2></div>
				</div>
			</div>
			<div class="row departments_row row-md-eq-height">
				
				@foreach($offers as $offer)
				<!-- Department -->
				<div class="col-lg-4 col-md-6 dept_col">
					<div class="dept">
						<div class="dept_image"><img src="{{url('uploads/services/'.$offer->image)}}" alt=""></div>
						<div class="dept_content text-center">
							<div class="dept_title">{{$offer->title}}</div>
							<p class="two">{{(strlen($offer->description) > 130)? substr($offer->description,0,strpos($offer->description,' ',125)).' ...':$offer->description}}</p>
								<div class="button dept_button"><a href="{{url('service/'.$offer->id)}}">{{__('lab.read_more')}}</a></div>
						</div>
					
					</div>
				</div>
				@endforeach

				<!-- Department -->
				
			</div>
		</div>
	</div>
	@endif

	@if(!empty($apps))
	<div class="cta">
		<div class="cta_background parallax-window" style="background-image:url({{url('uploads/images/'.$apps->image)}})" ></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="cta_content text-center">
						<h2>{{$apps->title}}</h2>
						<p>{{$apps->content}}</p>
<!--						<div class="button cta_button"><a href="#">request a plan</a></div>-->
                @if($android->content)<a href="{{$android->content}}"><img class="play" src="{{url('uploads/images/800px-Logo_Google_play.png')}}" width="100px"></a>@endif
                @if($ios->content)<a href="{{$ios->content}}"><img class="play" src="{{url('uploads/images/appStore.png')}}" width="100px" ></a>@endif
					</div>
				</div>
			</div>
		</div>	
	
   
<!--   end container-->
    </div>
	@endif
<!-- footer -->

@endsection

@section('footer')

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