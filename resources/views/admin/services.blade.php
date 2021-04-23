@extends('admin.layouts.app')

@section('content')

<title>Services</title>

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
		window.location.href = '{{url("admin/services/status")}}'+'/'+id+'/'+1;
    }else{
        window.location.href = '{{url("admin/services/status")}}'+'/'+id+'/'+0;
   }
}
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Services</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/services')}}">Services</a></li>
  </ul>

  <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button><br /><br />
  
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


   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New</h4>
        </div>
        <div class="modal-body">
		
		@if ($errors->any() and session('modal') == 'myModal')
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success') and session('modal') == 'myModal')
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
		

      {!! Form::open(['url' => 'admin/services/add', 'files' => true]) !!}
		<div class="form-group">
        {{ Form::label('Type:', null, ['for' => 'type']) }}
        <select class="form-control" name="type">
			<option value="1">Offer</option>
			<option value="2">Service</option>
			<option value="3">New</option>
		</select>
		  </div>
		  <div class="form-group">
        {{ Form::label('Arabic Title:', null, ['for' => 'title_ar']) }}
        {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Title:', null, ['for' => 'title_en']) }}
        {!! Form::text('title_en', old('title_en'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Arabic Description:', null, ['for' => 'description_ar']) }}
        {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Description:', null, ['for' => 'description_en']) }}
        {!! Form::textarea('description_en', old('description_en'), ['class' => 'form-control']) !!}
		  </div>
		  
		  <ul class="">
			<li class="">
					Image Dimension:  width=690,height=481
			</li>
		</ul>
		
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image', $attributes = array()) }}
		  </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>

    </div>
  </div>

@if(!empty($alldata))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
		<th>Type</th>
        <th>Arabic Title</th>
		<th>English Title</th>
		<!--<th>Arabic Description</th>
		<th>English Description</th>
		<th>Image</th>-->
		<th>Status</th>
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
      <tr>
        <td>{{$key+1}}</td>
			<td>{{$types[$data->flag]}}</td>
		    <td>{{$data->title_ar}}</td>
			<td>{{$data->title_en}}</td>
			<!--<td style="text-align:justify;"><p>{{$data->description_ar}}</p></td>
			<td style="text-align:justify;"><p>{{$data->description_en}}</p></td>
		    <td><img src="{{url('./uploads/services/'.$data->image)}}" width="50%"></td>-->
			<td><input type="checkbox" value="{{($data->status)? 0:1}}" onchange="handleChange({{$data->id}},this);" {{($data->status)? 'checked':''}}></td>
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

      <!-- Modal content-->
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
		

      {!! Form::open(['url' => 'admin/services/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->image) !!}
	  <div class="form-group">
        {{ Form::label('Type:', null, ['for' => 'type']) }}
        <select class="form-control" name="type">
			<option value="1" {{($data->flag==1)? 'Selected':''}}>Offer</option>
			<option value="2" {{($data->flag==2)? 'Selected':''}}>Service</option>
			<option value="3" {{($data->flag==3)? 'Selected':''}}>New</option>
		</select>
		  </div>
		  <div class="form-group">
        {{ Form::label('Arabic Title:', null, ['for' => 'title_ar']) }}
        {!! Form::text('title_ar', $data->title_ar, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Title:', null, ['for' => 'title_en']) }}
        {!! Form::text('title_en', $data->title_en, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Arabic Description:', null, ['for' => 'description_ar']) }}
        {!! Form::textarea('description_ar', $data->description_ar, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Description:', null, ['for' => 'description_en']) }}
        {!! Form::textarea('description_en', $data->description_en, ['class' => 'form-control']) !!}
		  </div>
		  <ul class="">
			<li class="">
					Image Dimension:  width=690,height=481
			</li>
		</ul>
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image', $attributes = array()) }}
		  </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>

    </div>
  </div>
  @endforeach
  @endif
  </div>

@endsection
