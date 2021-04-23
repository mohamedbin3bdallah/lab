<style>
:root {
  --clr1: {{$clr1->content}};
  --clr2: {{$clr2->content}};
}
</style>
@yield('header')

<head>
<style>
.header_container {
    width: 100%;
    background: white !important;
}

.fa {
    font-size: 20px;
    padding-right: 10px;
}

.one {
    font-size: 17px;
}

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
<!-- Header -->

	<header class="header trans_200">
		
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            @if($contact[3]->value)<div class="top_bar_item"><a href="{{$contact[3]->value}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>@endif
							@if($contact[4]->value)<div class="top_bar_item"><a href="#">
											<a href="{{$contact[4]->value}}" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
										</a></div>@endif
										@if($contact[5]->value)<div class="top_bar_item"><a href="#">
											<a href="{{$contact[5]->value}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
										</a></div>@endif
							<div class="emergencies  d-flex flex-row align-items-center justify-content-start ml-auto"><div class="main_menu_phone"><i class="fa fa-mobile"></i><span class="one">{{$contact[8]->value}}</span></div>
							
							</div>
							
							<div class="dropdown" id="selector">
  <button class="dropbtn" onclick="showmenu()">{{__('lab.lang')}}</button>
  <div class="dropdown-content">
    <a href="{{url('lang/en/'.str_replace('/','-',request()->path()))}}">{{__('lab.en')}}</a>
    <a href="{{url('lang/ar/'.str_replace('/','-',request()->path()))}}">{{__('lab.ar')}}</a>
  </div>
</div>
                    
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<nav class=" fill main_nav ml-auto">
								<ul>
									<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li><a href="{{url('about')}}">{{__('lab.about')}}</a></li>
									<li><a href="{{url('services')}}">{{__('lab.services')}}</a></li>
									<li><a href="{{url('test_library')}}">{{__('lab.test_library')}}</a></li>
									<li><a href="{{url('house_visit')}}">{{__('lab.house_visit')}}</a></li>
									<li><a href="{{url('test_result')}}">{{__('lab.test_result')}}</a></li>
									<li><a href="{{url('contact')}}">{{__('lab.contact')}}</a></li>
								</ul>
							</nav>
							<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Logo--> 
		<div class="logo_container_outer">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="logo_container">
							<a href="{{url('/')}}">
								<div class="logo_content d-flex flex-column align-items-start justify-content-center">
									<div class="logo_line"></div>
									<div class="logo d-flex flex-row align-items-center justify-content-center">
									<img src="{{url('uploads/images/'.$contact[0]->value)}}" width="75%">
									</div>
<!--									<div class="logo_sub">LAB Care Center</div>-->
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>	
		</div>

	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
					<li class="menu_item menu_mm"><a href="{{url('about')}}">{{__('lab.about')}}</a></li>
					<li class="menu_item menu_mm"><a href="{{url('services')}}">{{__('lab.services')}}</a></li>
					<li  class="menu_item menu_mm"><a href="{{url('test_library')}}">{{__('lab.test_library')}}</a></li>
					<li  class="menu_item menu_mm"><a href="{{url('house_visit')}}">{{__('lab.house_visit')}}</a></li>
			        <li  class="menu_item menu_mm"><a href="{{url('test_result')}}">{{__('lab.test_result')}}</a></li>
					<li class="menu_item menu_mm"><a href="{{url('contact')}}">{{__('lab.contact')}}</a></li>
					<li class="menu_item menu_mm"><a href="{{url('lang/en/'.str_replace('/','-',request()->path()))}}">{{__('lab.en')}}</a></li>
					<li class="menu_item menu_mm"><a href="{{url('lang/ar/'.str_replace('/','-',request()->path()))}}">{{__('lab.ar')}}</a></li>
				</ul>
			</div>
			
		</div>

	</div>

@yield('content')

	<head>
	<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/footer.css')}}">
	</head>
	
	<!-- footer -->
	<footer class="footer">
		<div class="footer_container">
			<div class="container">
				<div class="row">
					<!-- Footer - Links -->
					<div class="col-lg-4 footer_col">
						<div class="footer_links footer_column">
							<div class="footer_title">{{__('lab.useful_links')}}</div>
							<ul>
								<li><a href="{{url('/')}}">{{__('lab.home')}}</a></li>
									<li><a href="{{url('about')}}">{{__('lab.about')}}</a></li>
									<li><a href="{{url('services')}}">{{__('lab.services')}}</a></li>
									<li><a href="{{url('test_library')}}">{{__('lab.test_library')}}</a></li>
									<li><a href="{{url('house_visit')}}">{{__('lab.house_visit')}}</a></li>
										<li><a href="{{url('test_result')}}">{{__('lab.test_result')}}</a></li>
									<li><a href="{{url('contact')}}">{{__('lab.contact')}}</a></li>
							</ul>
						</div>
					</div>

					<!-- Footer - News -->
					<div class="col-lg-4 footer_col">
						<div class="footer_news footer_column">
							<div class="footer_title">{{__('lab.news')}}</div>
							@if(!empty($news))
							<ul>
								@foreach($news as $new)
								<li>
									<div class="footer_news_title"><a href="{{url('service/'.$new->id)}}">{{$new->title}}</a></div>
									
								</li>
								@endforeach
							</ul>
							@endif
						</div>
					</div>
					
					<!-- Footer - About -->
					<div class="col-lg-4 footer_col">
							<div class="footer_news footer_column">
							
							<div class="footer_title">{{__('lab.contact')}}</div>
							<ul class="footer_about_list">
								<li><div class="footer_about_icon"><img src="{{url('uploads/images/phone-call.svg')}}" alt=""></div><span dir="ltr">{{$contact[8]->value}}</span></li>
								<li><div class="footer_about_icon"><img src="{{url('uploads/images/envelope.svg')}}" alt=""></div><span>{{$contact[7]->value}}</span></li>
								<li><div class="footer_about_icon"><img src="{{url('uploads/images/placeholder.svg')}}" alt=""></div><span>{{$contact[6]->value}}</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="copyright_content d-flex flex-lg-row flex-column align-items-lg-center justify-content-start">
							<div class="cr">
							{{$contact[9]->value}}
							</div>
							<div class="footer_social ml-lg-auto">
								<ul>
									@if($contact[3]->value)<li><a href="{{$contact[3]->value}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>@endif
									@if($contact[4]->value)<li><a href="{{$contact[4]->value}}" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>@endif
									@if($contact[5]->value)<li><a href="{{$contact[5]->value}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</footer>

@yield('footer')