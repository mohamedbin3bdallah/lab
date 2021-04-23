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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/test-labrary.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body onload="paginat_class();">

<div class="super_container">
	
@endsection

@section('content')

    <!-- Home -->

	@if(!empty($header))
	<div class="home">
		<div class="home_background parallax-window" style="background-image:url('{{url('uploads/images/'.$header->image)}}');background-position:center; background-repeat:no-repeat; background-size:cover;"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><!--<span>TEST</span>--> {{$header->title}}</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li>{{__('lab.test_library')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!-- table -->

@if(!empty($alldata))
	<div class="container mt-3">
<!--  <h2>Test Menu</h2>-->
<!--  <p>Type something in the input field to search the table for first names, last names or emails:</p>  -->
  <!--<input class="form-control" id="myInput" type="text" placeholder="{{__('lab.search')}}">-->
  <br>
  <!--<div class="table-responsive">-->
  <div class="">
  <table class="table table-bordered" id="example">
    <thead>
      <tr>
        <th>{{__('lab.test_name')}}</th>
        <th>{{__('lab.sample_type')}}</th>
        <th>{{__('lab.Run_Proces_day')}}</th>
        <th>{{__('lab.precautions_require')}}</th>
      </tr>
    </thead>
    <tbody id="myTable">

	@foreach($alldata as $data)
      <tr>
        <td>{{$data->name}}</td>
        <td>{{$data->sample}}</td>
        <td>@if($data->process_day) {{$data->process_day.' '.__('lab.days')}} @else {{__('lab.same_day')}} @endif</td>
        <td>{{$data->precaution}}</td>
      </tr>
 	@endforeach

    </tbody>
  </table>
        </div>
<!--  page-->
 
 <br />
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
<script src="{{asset('resources/assets/lab/js/services.js')}}"></script>
<script src="{{asset('resources/assets/lab/js/custom.js')}}"></script>

@if (!session('lang') or session('lang') != 'en')<script src="{{asset('resources/assets/lab/js/jquery.dataTables.ar.min.js')}}"></script>
@else<script src="{{asset('resources/assets/lab/js/jquery.dataTables.en.min.js')}}"></script>
@endif
<script src="{{asset('resources/assets/lab/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
	$('label').css('display','block');
	$("select").removeClass("custom-select");
} );
</script>
<script>
$(document).ready(function(){
	$('.pagination').show(function() {
		$('.pagination li').addClass('page-item');
		$('.pagination li a').addClass('page-link');
		$('.pagination li span').addClass('page-link');
	});
});
</script>
</body>
</html>

@endsection