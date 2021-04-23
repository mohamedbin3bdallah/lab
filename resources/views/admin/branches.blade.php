@extends('admin.layouts.app')

@section('content')

<title>Branches</title>

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
		window.location.href = '{{url("admin/branches/status")}}'+'/'+id+'/'+1;
    }else{
        window.location.href = '{{url("admin/branches/status")}}'+'/'+id+'/'+0;
   }
}
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Branches</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/branches')}}">Branches</a></li>
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
        <th>Arabic Name</th>
        <th>English Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Mobile</th>
		<th>Arabic Address</th>
        <th>English Address</th>
		<th>Active</th>
		<!--<th>Edit</th>-->
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$data->name_ar}}</td>
          <td>{{$data->name_en}}</td>
		  <td>{{$data->email}}</td>
		  <td>{{$data->phone}}</td>
		  <td>{{$data->mobile}}</td>
		  <td>{{$data->address_ar}}</td>
		  <td>{{$data->address_en}}</td>
		  <td><input type="checkbox" value="{{($data->status)? 0:1}}" onchange="handleChange({{$data->id}},this);" {{($data->status)? 'checked':''}}></td>
          <!--<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>-->
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}
	@endif
  </div>


@endsection