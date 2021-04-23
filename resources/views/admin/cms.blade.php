@extends('admin.layouts.app')

@section('content')

<title>CMS</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<script type="text/javascript">
$(document).ready(function(){
		$('#upload_type').change(function(){
			var val = $(this).val();
			if(val==1) { $('#about_body').html(''); $('#about_body').append('<label>Image</label><input type="file" name="image">'); }
			else if(val==2) { $('#about_body').html(''); $('#about_body').append('<label>Video</label><input type="text" name="link" class="form-control" value="'+$('#url').val()+'">'); }
			else $('#about_body').html('');
		});
});
</script>

		<script src="{{asset('resources/assets/tinymce/tinymce.min.js')}}"></script>
		<!--<script>tinymce.init({ selector:'textarea' });</script>-->
		<script>
			tinymce.init({
				selector: 'textarea.editor',
				height: 99,
				menubar: false,
				plugins: [
					'advlist autolink lists link image charmap print preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code'
				],
				toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				content_css: '//www.tinymce.com/css/codepen.min.css'
			});
		</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;CMS</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/cms')}}">CMS</a></li>
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
        <th>Page</th>
		<th>Section</th>
		<th>Arabic Title</th>
		<th>English Title</th>
		<!--<th>Arabic Content</th>
		<th>English Content</th>
		<th>Link</th>
		<th>Image</th>-->
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
      <tr>
			<td>{{$key+1}}</td>
		    <td>{{$pages[$data->page_flag]}}</td>
			<td>{{$data->section}}</td>
			<td>{{$data->title_ar}}</td>
			<td>{{$data->title_en}}</td>
			<!--<td style="text-align:justify;"><p>{{$data->content_ar}}</p></td>
			<td style="text-align:justify;"><p>{{$data->content_en}}</p></td>
			<td>{{$data->link}}</td>
		    <td>@if($data->image)<img src="{{url('./uploads/images/'.$data->image)}}" width="80px" >@endif</td>-->
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
		
		

      {!! Form::open(['url' => 'admin/cms/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->image) !!}
	  {!! Form::hidden('page', $data->page_flag) !!}
	  {!! Form::hidden('section', $data->section) !!}
	  {!! Form::hidden('oldpdf', $data->pdf) !!}
		  <div class="form-group">
			{{ Form::label('Page:', null, ['for' => 'page']) }}
			<br>
			{{$pages[$data->page_flag]}}
		  </div>
		   <div class="form-group">
			{{ Form::label('Section:', null, ['for' => 'section']) }}
			<br>	
			{{$data->section}}
		  </div>
		  
		  @if(!in_array($data->section,array('video','testimon')))
		  <div class="form-group">
        {{ Form::label('Arabic Title:', null, ['for' => 'title_ar']) }}
        {!! Form::text('title_ar', $data->title_ar, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Title:', null, ['for' => 'title_en']) }}
        {!! Form::text('title_en', $data->title_en, ['class' => 'form-control']) !!}
		  </div>
		  @endif
		  
		  @if(($data->page_flag==2 and $data->section == 'body') or ($data->section == 'about'))
		<div class="form-group">
        {{ Form::label('Arabic Content:', null, ['for' => 'content_ar']) }}
        {!! Form::textarea('content_ar', $data->content_ar, ['class' => 'form-control editor']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Content:', null, ['for' => 'content_en']) }}
        {!! Form::textarea('content_en', $data->content_en, ['class' => 'form-control editor']) !!}
		  </div>
		  @elseif(!in_array($data->section,array('header')))
		  <div class="form-group">
        {{ Form::label('Arabic Content:', null, ['for' => 'content_ar']) }}
        {!! Form::textarea('content_ar', $data->content_ar, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('English Content:', null, ['for' => 'content_en']) }}
        {!! Form::textarea('content_en', $data->content_en, ['class' => 'form-control']) !!}
		  </div>
		  @endif
		  
		  <!--@if(in_array($data->section,array('slider')))
		  <div class="form-group">
        {{ Form::label('Link:', null, ['for' => 'link']) }}
        {!! Form::text('link', $data->link, ['class' => 'form-control']) !!}
		  </div>
		  @endif-->
		  
		  @if(in_array($data->section,array('slider')))
		<ul class="">
			<li class="">
					Image Dimension:  width=1400,height=500
			</li>
		</ul>
		@endif
		<!--@if(in_array($data->section,array('about')))
		<ul class="">
			<li class="">
					Image Dimension:  width=435,height=400
			</li>
		</ul>
		@endif-->
		@if(in_array($data->section,array('apps')))
		<ul class="">
			<li class="">
					Image Dimension:  width=1920,height=720
			</li>
		</ul>
		@endif
		@if(in_array($data->section,array('header')))
		<ul class="">
			<li class="">
					Image Dimension:  width=1920,height=600
			</li>
		</ul>
		@endif
		@if(in_array($data->page_flag,array(2)) and in_array($data->section,array('body')))
		<ul class="">
			<li class="">
					Image Dimension:  width=690,height=481
			</li>
		</ul>
		@endif
		  
		  @if(!in_array($data->section,array('about','body','s.media','contact')))
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image') }}
		  </div>
		  @endif
		  
		  @if(in_array($data->page_flag,array(2)) and in_array($data->section,array('body')))
			 <input type="hidden" id="url" value="{{$data->image}}">
		  <div class="form-group">
			<select id="upload_type" name="upload_type" class="form-control">
				<option value="">Select</option>
				<option value="1">Image</option>
				<option value="2">Video</option>
			</select>
		  </div>
		  <div class="form-group" id="about_body">
		  </div>
		  @endif
		  
		  @if($data->page_flag==1 and $data->section == 'slider')
		<div class="form-group">
        {{ Form::label('Active:', null, ['for' => 'active']) }}
        {!! Form::checkbox('active', 1, $data->status) !!}
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
