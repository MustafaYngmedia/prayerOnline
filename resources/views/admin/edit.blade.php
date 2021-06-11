@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">

					<div class="box-content card white">
					<h4 class="box-title">Admin @isset($user) - {{$user->id}} @endisset <a class="pull-right btn btn-primary btn-xs" href="{{route('admin.list')}}">Back</a></h4>
					
					<div class="card-content">
						<form action="{{route('admin.store')}}" method="post">
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
							<input type="hidden" name="id" value="{{$user ? $user->id : ''}}"/>
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input type="text" name="name" class="form-control" value="{{$user ? $user->name : old('name')}}" id="exampleInputEmail1" placeholder="Enter your name">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" name="email" class="form-control" value="{{$user ? $user->email : old('email')}}"  id="exampleInputEmail1" placeholder="Enter your email">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Mobile Number</label>
								<input type="text" name="mobile_number" class="form-control" value="{{$user ? $user->mobile_number : old('mobile_number')}}"  id="exampleInputEmail1" placeholder="Enter your mobile number">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" name="status">
									<option @isset($user) @if($user->status == 1) "selected" @endif @endisset value="1">Active</option>
									<option @isset($user) @if($user->status == 0) "selected" @endif @endisset value="0">In-Active</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
								@if(isset($user)) Update  @else Add  @endif
							</button>
						</form>
					</div>
					<!-- /.card-content -->
				</div>
	</div>
</div>
@endsection