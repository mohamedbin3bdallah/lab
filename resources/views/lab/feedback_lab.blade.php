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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/new_patient.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/styles/test-result_responsive.css')}}">
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
 
  
  @if(session('type')=='labs')<a href="{{url('lab/new_patient')}}"><i class="fa fa-user-plus"></i> New Patients</a>@endif
 
  @if(session('type')=='labs')<a href="{{url('lab/'.session('id').'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>
 
  @elseif(session('type')=='branches')<a href="{{url('lab/'.$lab_id.'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>@endif
  
  @if(session('type')=='labs')<a href="{{url('lab/'.session('id').'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>
 
  @elseif(session('type')=='branches')<a href="{{url('lab/'.$lab_id.'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>@endif
 
  @if(session('type')=='labs')<a class="active" href="{{url('lab/feedback')}}"><i class="fa fa-commenting" aria-hidden="true"></i> Feedback</a>@endif
  
</div>


 

 <div class="content">
<div class="container">
 <br><br>
  <h2>
  Feedback
</h2>
 <hr>
  
    
  <div class="card">
  
  <div class="card-body">
  
		@if ($errors->any())
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success'))
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
        
  {!! Form::open(['url' => 'lab/feedback']) !!}
  <div class="row">
  <div class="col-sm-6">
  <!--<div class="form-group">
    {{ Form::label('Title:', null, ['for' => 'title']) }}
	{!! Form::text('title', old('title'), ['class' => 'form-control', 'required']) !!}
  </div>-->
  <div class="form-group">
	{{ Form::label('Title:', null, ['for' => 'title']) }}
	<select name="title" class="form-control" required>
	@if(!empty($qs))
		@foreach($qs as $q)
			<option value="{{$q->title}}">{{$q->title}}</option>
		@endforeach
	@endif
	</select>
  </div>
   </div>
 
    </div>
 
  <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    {{ Form::label('Feedback Details:', null, ['for' => 'description']) }}
	{!! Form::textarea('description', old('description'), ['class' => 'form-control', 'required']) !!}
  </div>
   </div> 
    </div>
        
  <br />


 
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

</div>
</div>
 
   
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
<script src="{{asset('resources/assets/lab/js/new_patient.js')}}"></script>

</body>
</html>