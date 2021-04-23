@extends('web.layouts.app')

@section('header')

<!DOCTYPE html>
<html lang="en">
<head>
<title>{{__('lab.contact')}}</title>
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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/contact.css')}}">
@if (!session('lang') or session('lang') != 'en')<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/bootstrap-rtl.css')}}">@endif
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
</head>
<body>

<div class="super_container">
	
@endsection

@section('content')
	
<!--HOME	-->
<div class="contact">
		<div class="container">
			<div class="row">

				<!-- Contact Info -->
				<div class="col-lg-6 col">
            
            <div class="boxes working_hour" >
							<div class="section_title">
            <h2>{{__('lab.contact')}}</h2>
          </div>
						
            <div class="contact_text">
            <!--<h4> Head Office</h4>-->	
            </div>
            <ul class="contact_about_list">
                <li dir="ltr">{{__('lab.phone')}}:{{$contact[8]->value}} </li><br>
                <li>{{__('lab.email')}}:{{$contact[7]->value}}</li><br>
                <li>{{__('lab.address')}}:{{$contact[6]->value}}</li><br>
            </ul>

						</div>

            
        </div>      
				<!-- Contact Form -->
				<div class="col-lg-6 form_col col">
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
					
						{!! Form::open(['url' => 'contact', 'class' => 'contact_form']) !!}
							<div class="row">
								<div class="col-md-6 input_col">
									<div class="input_container input_name" id="name"><input type="text" name="name" class="contact_input" placeholder="{{__('lab.name')}}" required="required"></div>
								</div>
								<div class="col-md-6 input_col">
									<div class="input_container"><input type="email" name="email" class="contact_input" placeholder="{{__('lab.email')}}" required="required"></div>
								</div>
							</div>
							<div class="input_container"><input type="text" class="contact_input" name="subject" placeholder="{{__('lab.subject')}}" required="required"></div>
							<div class="input_container"><textarea class="contact_input contact_text_area" name="message" placeholder="{{__('lab.message')}}" required="required"></textarea></div>
							<!--<button class="button contact_button"><a href="#">Send</a></button>-->
							{!! Form::submit(__('lab.send'), ['name'=>'submit', 'class'=>'button contact_button']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="row map_row">
				<div class="col">

					<!-- Contact Map -->

					<div class="contact_map">

						<!-- Google Map -->
						
						<div class="map">
							<div id="google_map" class="google_map">
								<div class="map_container">
									<!--<div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13820.229010308805!2d31.18398866977539!3d30.00651240000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458468b02f560b1%3A0x6b58810eefaa4f36!2sAl+Mokhtabar+-+Moamena+Kamel+Laboratories!5e0!3m2!1sen!2seg!4v1545772017136" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe></div>-->
									<div id="map"><iframe id="contact_map" src="https://maps.google.com/maps?q={{$lng_lat->content}}&hl=en&z=14&amp&output=embed" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                                </div>
								</div>
							</div>
						</div>

						<!-- Working Hours -->
						@if(!empty($alldata))
						<div class="box working_hours">
							<div><i class="fa fa-map-marker fa-5x" id="mark"></i></div>
							<div class="box_title"><span id="contact_modal_tr" class="btn btn-success" data-toggle="modal" data-target="#myModal">{{__('lab.branch_contact')}}</span></div>

							<div class="working_hours_list">
								<ul>
									<li class="d-flex flex-row align-items-center justify-content-start">
										
										<select class="form-control">
                                          <!--<option>Contury</option>-->
                                          <option>{{__('lab.egypt')}}</option>
                                        </select>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<select id="branch" class="form-control">
                                          <option value="q">{{__('lab.branch')}}</option>
										  @foreach($alldata as $key => $data)
											<option value="{{$key}}">{{$data->name}}</option>
										  @endforeach
                                        </select>

									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div></div>
										<div class="ml-auto"></div>
									</li>
								</ul>
							</div>
						</div>
  <!-- The Modal -->
  @foreach($alldata as $key => $data)
  <input type="hidden" id="lat{{$key}}" value="{{$data->latitude}}">
  <input type="hidden" id="lng{{$key}}" value="{{$data->longitude}}">
  <div class="modal" id="myModal{{$key}}">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">{{__('lab.branch_details')}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <ul class="branch">
                <li>{{__('lab.phone')}}:{{$data->phone}} </li><br>
                <li>{{__('lab.email')}}: {{$data->email}}</li><br>
                <li>{{__('lab.address')}}:{{$data->address}}</li><br>
            </ul>

        </div>
        
       
      </div>
    </div>
  </div>
  @endforeach
  @endif
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
<script>
$(document).ready(function(){
	$('#branch').change(function() {
		var key = $('#branch').val();
		if(key!='q')
		{
			$('#contact_modal_tr').attr('data-target','myModal'+key);
			$('#myModal'+key).show();
			$('#contact_map').attr('src','https://maps.google.com/maps?q='+$('#lat'+key).val()+','+$('#lng'+key).val()+'&hl=en&z=14&amp&output=embed');
		}
		else $('#contact_map').attr('src','https://maps.google.com/maps?q={{$lng_lat->content}}&hl=en&z=14&amp&output=embed');
	});
	
	$('.close').click(function() {
		$('.modal').hide();
	});
	
	$('#contact_modal_tr').click(function() {
		var key = $('#branch').val();
		if(key!=0) $('#myModal'+key).show();
		else if(key==0) $('#myModal'+key).show();
	})
});
</script>
</body>
</html>

@endsection