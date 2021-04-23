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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/branch-secondry.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/responsive.css')}}">
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
                            
							<div class="d-flex flex-row align-items-center justify-content-start ml-auto"><a href="{{url('logout')}}" class="btn btn-danger" style="float:right;">Logout</a>
                            </div>
                        
                        </div>
							
					</div>
						</div>

					</div>
				</div>
	</header>

<br>
<div class="container">


<!--<button type="button" class="btn btn-danger" style="float:right;">Logout</button><br /><br />-->
<br><br>
<ul class="breadcrumb">
    <li><a href="branch_main_page.php">Home</a> /</li> 	  
  </ul>

  


<h5 >Branch Name: {{$branch->name_en.' / '.$branch->name_ar}}</h5>
<hr />

@if (!empty($alldata))
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Lab Name </th>
        <th>Phone</th>
		<th>Address</th>
        
        
      </tr>
    </thead>
    <tbody id="myTable">
	  @foreach ($alldata as $key => $data)
      <tr>
        <td>
          <div class="panel panel-default">
     
            
         &nbsp; {{$key+1}}
        
    </div>
        
        
        </td>
    <td><a href="{{url('lab/'.$data->id.'/patients')}}"> {{$data->name}}</a>
        <td>{{$data->phone.' - '.$data->mobile}}</td>
			<td>{{$data->address}}
	
    
      </tr>
	  @endforeach
	  <tr>
        <td>
          <div class="panel panel-default">
     
            
         &nbsp; {{count($data)+1}}
        
    </div>
        
        
        </td>
    <td><a href="{{url('lab/'.$data->id.'/b_patients')}}"> Other</a>
        <td></td>
			<td>
	
    
      </tr>
    </tbody>
  </table>
  {!! $alldata->render() !!}
  @endif
  
</div>

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