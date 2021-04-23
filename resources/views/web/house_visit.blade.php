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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/visit.css')}}">
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
							<div class="home_title"> {{$header->title}}<!--  <span>VISIT</span>--></div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.house_visit')}}</li>
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
					<div class="section_title"><h2>{{$body->title}}</h2></div>
					<div class="about_text">
						<p>{{$body->content}}.</p>
                            
                        
						
					</div>
                </div>
				
				<!-- Boxes -->
				<div class="col-lg-6 boxes_col">

					<!-- Box -->
					<div class="img working_hour">
						<div class="img d-flex flex-column align-items-start justify-content-center">
						 <div class="section_title"><h2>{{$header->title}}</h2></div>
				
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

						{!! Form::open(['url' => 'house_visit', 'files' => true, 'class'=>'contact_form']) !!}
							<div class="row">
								<div class="col-md-6 input_col" id="name">
									<div class="input_container input_name"><input type="text" class="contact_input" name="patient_name" placeholder="{{__('lab.your').' '.__('lab.name')}}" required="required"></div>
								</div>
								<div class="col-md-6 input_col">
									<div class="input_container"><input type="text" class="contact_input" name="patient_phone" placeholder="{{__('lab.your').' '.__('lab.phone')}}" required="required"></div>
								</div>
							</div>
							<div class="input_container"><input type="text" class="contact_input" name="address" placeholder="{{__('lab.your').' '.__('lab.address')}}" required="required"></div>
                            <!--<h4> {{__('lab.date')}}:</h4>--><div class="input_container input_name"> <input type="date" name="date" id="" class="contact_input"></div>
							
						
						<br>
						<div class="form-group">
                        <textarea id="txt_sty" class="contact_input" name="notes" placeholder="{{__('lab.note')}}" required="required"></textarea>
					</div>
						<div class="form-group">
    <!--<label for="exampleFormControlFile1">{{__('lab.file')}}</label>-->
    <input type="file" name="file" class="form-control-file input_container input_name" id="exampleFormControlFile1">
  </div>

					
	<!--<button role="submit" class="button contact_button"><a href="#">send</a></button>-->
	{!! Form::submit(__('lab.send'), ['name'=>'submit', 'class'=>'button contact_button']) !!}
						<br>
					
						
  {!! Form::close() !!}
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