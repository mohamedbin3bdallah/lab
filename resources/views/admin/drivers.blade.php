@extends('admin.layouts.app')

@section('content')

<title>Drivers</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<script type="text/javascript">
function handleChange(id,checkbox) {
    if(checkbox.checked == true){
		window.location.href = '{{url("admin/drivers/status")}}'+'/'+id+'/'+1;
    }else{
        window.location.href = '{{url("admin/drivers/status")}}'+'/'+id+'/'+0;
   }
}

function loadUrl(id) {
	$('#myModal').modal('show');
    document.getElementsByName('iFrameName')[0].src = 'http://127.0.0.1/lab/admin/drivers/map/'+id;
}
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Drivers</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/drivers')}}">Drivers</a></li>
  </ul>
  
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

  @if (!empty($alldata))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
		<th>Phone</th>
		<th>Mobile</th>
		<!--<th>Latitude</th>
		<th>Longitude</th>-->
		<th>Map</th>
		<th>Active</th>
		<!--<th>Edit</th>-->
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$data->name}}</td>
		  <td>{{$data->phone}}</td>
		  <td>{{$data->mobile}}</td>
		  <!--<td>{{$data->latitude}}</td>
		  <td>{{$data->longitude}}</td>-->
		  <td><button class="btn btn-link" onclick="loadUrl({{$data->id}})">MAP</button></td>
		  <td><input type="checkbox" value="{{($data->status)? 0:1}}" onchange="handleChange({{$data->id}},this);" {{($data->status)? 'checked':''}}></td>
          <!--<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>-->
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}
	@endif
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Driver MAp</h4>
        </div>
        <div class="modal-body">
			<center>
				<div class="embed-responsive embed-responsive-4by3">
					<iframe name="iFrameName" class="embed-responsive-item" frameborder="0"></iframe>
				</div>
			</center>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>

    </div>
  </div>
 
  </div>

@endsection