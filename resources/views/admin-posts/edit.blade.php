@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">

					<div class="box-content card white">
					<h4 class="box-title">Post @isset($post) - {{$post->id}} @endisset <a class="pull-right btn btn-primary btn-xs" href="{{route('admin-post.list')}}">Back</a></h4>
					
					<div class="card-content">
						<form action="{{route('admin-post.store')}}" method="post" enctype="multipart/form-data">
							@csrf
								@if ($message = Session::get('success'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
											<strong>{{ $message }}</strong>
									</div>
								@endif
								@if($errors->any())
								{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
								@endif
							<input type="hidden" name="id" value="{{$post ? $post->id : ''}}"/>
							<div class="form-group">
								<label for="exampleInputEmail1">Title</label>
								<input type="text" name="title" class="form-control" value="{{$post ? $post->title : old('title')}}" id="exampleInputEmail1" placeholder="Enter Title">
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">Thumbnail (if Type is Audio/ Video)</label>
								<input type="file" name="thumbnail" />
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Type</label>
								<select class="form-control" name="type">
									<option @isset($post) @if($post->type == 1) selected @endif @endisset value="1">Text</option>
									<option @isset($post) @if($post->type == 2) selected @endif @endisset value="2">Video</option>
									<option @isset($post) @if($post->type == 3) selected @endif @endisset  value="3">Audio</option>

								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Text</label>
								<textarea class="form-control" name="text">@isset($post) {{$post->type_text}} @endisset</textarea>
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">Video / Audio</label>
								<input type="file" name="file" />
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" name="status">
									<option @isset($post) @if($post->status == 1) "selected" @endif @endisset value="1">Active</option>
									<option @isset($post) @if($post->status == 0) "selected" @endif @endisset value="0">In-Active</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
								@if(isset($post)) Update  @else Add  @endif
							</button>
						</form>
					</div>
					<!-- /.card-content -->
				</div>
	</div>
</div>
@endsection