@extends('admin.layouts.app')

@section('content')

<title>Patients</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<script type="text/javascript">
function handleChange(id,type,checkbox) {
    if(checkbox.checked == true){
		window.location.href = '{{url("admin/patients/status")}}'+'/'+id+'/'+type+'/'+1;
    }else{
        window.location.href = '{{url("admin/patients/status")}}'+'/'+id+'/'+type+'/'+0;
   }
}
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Patients</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/patients')}}">Patients</a></li>
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
        <th>Code</th>
        <th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Mobile</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Age Type</th>
		<th>Note</th>
		<th>Total Invoice</th>
		<th>Discount</th>
		<th>Accept</th>
		<th>Visit Date</th>
		<th>Branch</th>
		<th>Lab</th>
		<th>Active</th>
		<!--<th>Edit</th>-->
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$data->code}}</td>
          <td>{{$data->name}}</td>
		  <td>{{$data->email}}</td>
		  <td>{{$data->phone}}</td>
		  <td>{{$data->mobile}}</td>
		  <td>{{($data->gender==1)? 'Male':'Female'}}</td>
		  <td>{{$data->age}}</td>
		  <td>@if($data->age_type==1) {{'Days'}} @elseif($data->age_type==2) {{'Months'}} @else {{'Years'}} @endif</td>
		  <td>{{$data->note}}</td>
		  <td>{{$data->total_invoice}}</td>
		  <td>{{$data->discount}}</td>
		  <!--<td><input type="checkbox" value="{{($data->accept)? 0:1}}" onchange="handleChange({{$data->id}},'accept',this);" {{($data->accept)? 'checked':''}}></td>-->
		  <td>@if($data->accept==0) {{'Waiting'}} @elseif($data->accept==1) {{'Accept'}} @else {{'Finish'}} @endif</td>
		  <td>{{$data->visit_date}}</td>
		  <td>{{($data->branch_id)? $data->branch()->first()->name_en:''}}</td>
		  <td>{{($data->lab_id)? $data->lab()->first()->name:''}}</td>
		  <td><input type="checkbox" value="{{($data->status)? 0:1}}" onchange="handleChange({{$data->id}},'status',this);" {{($data->status)? 'checked':''}}></td>
          <!--<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>-->
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}
	@endif
  </div>


@endsection