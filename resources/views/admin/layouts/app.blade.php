<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{url('uploads/images/logo.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidenav a {
    padding: 6px 8px 20px 16px;
    text-decoration: none;
    font-size: 13px;
    color: #818181;
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.main {
    margin-left: 260px; /* Same as the width of the sidenav */
    font-size: 16px; /* Increased text to enable scrolling */
    padding: 0px 10px;
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

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>
<div class="well"></div>
<div class="sidenav">
<br />
<center><img src="{{url('uploads/images/'.$logo->value_en)}}" width="100"/></center>
<br />
<br />
	<a href="{{url('admin/home')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Dashoard</a>

   <a href="{{url('admin/branches')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Branches</a>

   <a href="{{url('admin/labs')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Labs</a>

   <a href="{{url('admin/patients')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Patients</a>

  <a href="{{url('admin/drivers')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Drivers</a>
  
  <a href="{{url('admin/services')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Services</a>
 
  <a href="{{url('admin/cms')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;CMS</a>
  
  <a href="{{url('admin/maincms')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Main CMS</a>
  
  <a href="{{ url('logout') }}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Logout</a>
</div>

@yield('content')

</body>
</html>
