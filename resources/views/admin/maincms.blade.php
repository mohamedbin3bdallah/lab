@extends('admin.layouts.app')

@section('content')

<title>Main CMS</title>

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
		window.location.href = '{{url("admin/maincms/status")}}'+'/'+id+'/'+1;
    }else{
        window.location.href = '{{url("admin/maincms/status")}}'+'/'+id+'/'+0;
   }
}
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Main CMS</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/maincms')}}">Main CMS</a></li>
  </ul>
  
  @if (session('status_success'))
	<ul class="ul-success">
		<li class="li-success">
			{{session('status_success')}}
		</li>
	</ul>
  @endif
  @if (session('status_fail'))
	<ul class="ul-danger">
		<li class="li-danger">
			{{session('status_fail')}}
		</li>
	</ul>
  @endif

@if(!empty($alldata))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
		<th>Section</th>
		<th>Arabic Value</th>
		<th>English Value</th>
		<!--<th>Active</th>-->
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
      <tr>
			<td>{{$key+1}}</td>
		    <td>{{$sections[$data->name]}}</td>
			<td>@if($data->name=='logo')<img src="{{url('./uploads/images/'.$data->value_ar)}}" width="80px" >@else{{$data->value_ar}}@endif</td>
			<td>@if($data->name=='logo')<img src="{{url('./uploads/images/'.$data->value_en)}}" width="80px" >@else{{$data->value_en}}@endif</td>
			<!--<td><input type="checkbox" value="{{($data->status)? 0:1}}" onchange="handleChange({{$data->id}},this);" {{($data->status)? 'checked':''}}></td>-->
		    <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}

       <!-- Modal -->
  @foreach ($alldata as $data)
  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit item</h4>
        </div>
        <div class="modal-body">

		@if ($errors->any() and session('modal') == 'myModal'.$data->id)
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success') and session('modal') == 'myModal'.$data->id)
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
		
		

      {!! Form::open(['url' => 'admin/maincms/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->value_en) !!}
	  {!! Form::hidden('section', $data->name) !!}
		  <div class="form-group">
			{{ Form::label('Section:', null, ['for' => 'section']) }}
			<br>
			{{$sections[$data->name]}}
		  </div>
		  
		  @if(!in_array($data->name,array('logo')))
		  <div class="form-group">
        {{ Form::label('Arabic Value:', null, ['for' => 'value_ar']) }}
        {!! Form::text('value_ar', $data->value_ar, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Value:', null, ['for' => 'value_en']) }}
        {!! Form::text('value_en', $data->value_en, ['class' => 'form-control']) !!}
		  </div>
		  @endif
		  
		  @if(in_array($data->name,array('logo')))
		<ul class="">
			<li class="">
					Image Dimension:  width=150,height=139
			</li>
		</ul>
		@endif
		  
		  @if(in_array($data->name,array('logo')))
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image') }}
		  </div>
		  @endif
		  
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
      </div>

    </div>
  </div>
  @endforeach
  @endif
  </div>

@endsection
