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
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lab/styles/test-result_responsive.css')}}">

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
 
  
  @if(session('type')=='labs')<a class="active" href="{{url('lab/new_patient')}}"><i class="fa fa-user-plus"></i> New Patients</a>@endif
 
  @if(session('type')=='labs')<a href="{{url('lab/'.session('id').'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>
 
  @elseif(session('type')=='branches')<a href="{{url('lab/'.$lab_id.'/patients')}}"><i class="fa fa-users" aria-hidden="true"></i> Patients List</a>@endif
  
  @if(session('type')=='labs')<a href="{{url('lab/'.session('id').'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>
 
  @elseif(session('type')=='branches')<a href="{{url('lab/'.$lab_id.'/test_price_list')}}"><i class="fa fa-list-alt" ari""a-hidden="true"></i> Tests Price List</a>@endif
 
  @if(session('type')=='labs')<a href="{{url('lab/feedback')}}"><i class="fa fa-commenting" aria-hidden="true"></i> Feedback</a>@endif
  
</div>



<div class="content">
<div class="container">

  <h2>Edit Patient
</h2>
 <hr>
  <div class="card">
    <div class="card-header">Edit patient</div>
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
		
		@if (session('fail'))
			<ul class="ul-danger">
					<li class="li-danger">
						{{session('fail')}}
					</li>
			</ul>
		@endif
  
  {!! Form::open(['url' => 'lab/old_patient/'.$patient->id]) !!}
 <div class="row">
   <div class="col-lg-4">
  <div class="form-group">
    <label for="name">Patient Name:</label>
    <input type="text" class="form-control" name="name" value="{{$patient->name}}" required>
  </div>
  </div>
  <div class="col-lg-4">
  <div class="form-group">
    <label for="phone">Phone:</label>
    <input type="text" class="form-control" name="phone" value="{{$patient->phone}}">
  </div>
  </div>
   <div class="col-lg-4">
  <div class="form-group">
    <label for="mobile">Mobile:</label>
    <input type="text" class="form-control" name="mobile" value="{{$patient->mobile}}">
  </div>
  </div>
    </div>
    
     <div class="row">
   <div class="col-lg-4">
  <div class="form-group">
    <label for="age">Age:</label>
    <input type="text" class="form-control" name="age" value="{{$patient->age}}" required>
  </div>
  </div>
  <div class="col-lg-4">
  <div class="form-group">
    <label for="pwd">Age type:</label>
    <select class="form-control" name="age_type" required>
      <option value="1" {{($patient->age_type ==1)? 'selected':''}}>Days</option>
      <option value="2" {{($patient->age_type ==2)? 'selected':''}}>Months</option>
      <option value="3" {{($patient->age_type ==3)? 'selected':''}}>Years</option>
      </select>
  </div>
  </div>
   <div class="col-lg-4">
  <div class="form-group">
    <label for="pwd">Gender:</label>
    <select class="form-control" name="gender">
      <option value="1" {{($patient->gender ==1)? 'selected':''}}>Male</option>
	  <option value="2" {{($patient->gender ==2)? 'selected':''}}>Female</option>
      </select>
  </div>
  </div>
    </div>
    
	@if(!empty($tests))
    <label for="pwd">Test Name</label><br />
    <input list="browsers" id="test_name" autocomplete="off" onclick="hide_list();" onkeyup="show_list();" style="width: 50%;" >
    <datalist id="browsers">
	</datalist>

  <button type="button" class="btn btn-primary" onclick="myFunction()">Add Test</button>
  
  	<div id="data">
		@foreach($tests as $test)
			<option id="{{$test->test()->first()->id}}" value="{{$test->test()->first()->name}}">
		@endforeach
	</div>
	
	@foreach($tests as $test)
		<input type="hidden" id="{{$test->test()->first()->name}}" value="{{$test->test()->first()->id}}">
		<input type="hidden" id="{{$test->test()->first()->id.'f'}}" value="{{$test->test()->first()->name}}">
		<input type="hidden" id="{{$test->test()->first()->id.'p'}}" value="{{$test->price}}">
	@endforeach
  
  <table id="demo"></table>
  @endif
  <br /> <br />
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

  </div> 
  
  </div>
  
  
  
</div>

  </div>
  
  
    
<!--   end container -->
    </div>
    
<!--  script -->
     <script>
var fruits,price, text, fLen, fLen1, i, count = 0, c=0;

@if(!empty($patient->patient_test))
	fruits = [
		@foreach ($patient->patient_test as $patient_test)
			document.getElementById('{{ $patient_test->test()->first()->id }}'+'f').value,
		@endforeach
	];
	price = [
		@foreach ($patient->patient_test as $patient_test)
			document.getElementById('{{ $patient_test->test()->first()->id }}'+'p').value,
		@endforeach
	];
	@foreach ($patient->patient_test as $patient_test)
		var element = document.getElementById('{{ $patient_test->test()->first()->id }}');
		element.parentNode.removeChild(element);
	@endforeach
@else
	fruits = [];
	price = [];
@endif

fLen1 = fruits.length;
if(fruits.length > 0){
 text = "<table>";
for (i = 0; i < fLen1; i++) {
  count = count + parseInt(price[i]);
text += "<tr><td> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'><i class='fa fa-trash' aria-hidden='true'></i>   </a>" + fruits[i] + "</td><td>&nbsp;&nbsp;&nbsp;   " + price[i] + " LE<input type='hidden' name='tests[]' value='"+document.getElementById(fruits[i]).value+"'></td></tr>";
}
text += "</table><hr />total " + count + " LE <input type='hidden' name='total' value='"+count+"'></ul>";

document.getElementById("demo").innerHTML = text;

count = 0;
}


function hide_list()
{
	document.getElementById("browsers").innerHTML = '';	
}

function show_list()
{
	document.getElementById("browsers").innerHTML = document.getElementById("data").innerHTML;
}

function myFunction() {
  
  var test_name = document.getElementById("test_name").value; 
  //var splitstring = test_name.split('-');
    var test_price = document.getElementById(document.getElementById(test_name).value+'p').value;
  //alert(test_price);
  
  //fruits.push(splitstring[0]);
  fruits.push(test_name);
  //price.push(splitstring[1]);
  price.push(test_price);
  
  fLen = fruits.length;
  
 text = "<table>";
for (i = 0; i < fLen; i++) {
  count = count + parseInt(price[i]);
  text += "<tr><td> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'><i class='fa fa-trash' aria-hidden='true'></i>   </a>" + fruits[i] + "</td><td>&nbsp;&nbsp;&nbsp;   " + price[i] + " LE<input type='hidden' name='tests[]' value='"+document.getElementById(fruits[i]).value+"'></td></tr>";
}
text += "</table><hr />total " + count + " LE <input type='hidden' name='total' value='"+count+"'></ul>";

document.getElementById("demo").innerHTML = text;
document.getElementById("test_name").value = '';
document.getElementById("test_name").focus();


var element = document.getElementById(document.getElementById(test_name).value);
    element.parentNode.removeChild(element);

document.getElementById("data").innerHTML = document.getElementById("browsers").innerHTML;

count = 0;
}

function removelistitem(x){

var test_id = document.getElementById(fruits[x]).value;
var append = document.getElementById('data');
append.insertAdjacentHTML('beforeend', '<option id="'+test_id+'" value="'+fruits[x]+'">');

fruits.splice(x, 1); 
price.splice(x, 1); 

fLen = fruits.length;

text = "<table>";
for (i = 0; i < fLen; i++) {
count = count + parseInt(price[i]);
  text += "<tr><td> <a href='#' style='color:red;' onclick='removelistitem(" + i + ")'><i class='fa fa-trash' aria-hidden='true'></i>  </a>" + fruits[i] + "</td><td>&nbsp;&nbsp;&nbsp;   " + price[i] + " LE<input type='hidden' name='tests[]' value='"+document.getElementById(fruits[i]).value+"'></td></tr>";
}
text += "</table><hr />total " + count + " LE <input type='hidden' name='total' value='"+count+"'></ul>";
document.getElementById("demo").innerHTML = text;
document.getElementById("test_name").value = '';
document.getElementById("test_name").focus();
count = 0;
}
</script>

</body>
</html>