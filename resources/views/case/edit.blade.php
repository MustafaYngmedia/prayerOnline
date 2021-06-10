@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">

								@if ($message = Session::get('success'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
											<strong>{{ $message }}</strong>
									</div>
								@endif
								@if($errors->any())
								{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
								@endif
						<div class="box-content card white">
					<h4 class="box-title">Case @isset($user) - {{$case->id}} @endisset <a class="pull-right btn btn-primary btn-xs" href="{{route('case.list')}}">Back</a></h4>
					
					<div class="card-content">
						<form action="{{route('case.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{$case ? $case->id : ''}}"/>
							<div class="form-group">
								<label for="exampleInputEmail1">Case No</label>
								<input type="text" name="case_no" placeholder="Please Enter Case No" class="form-control" value="{{$case ? old('case_no',$case->case_no) : ''}}" >
							</div>


							<div class="form-group">
								<label for="exampleInputEmail1">Case Type</label>
								<select class="form-control" name="case_type">
									<option>- Select Case Type -</option>
									@foreach($case_category as $c)
										<option @isset($case) @if($c->id == $case->type->id) selected @endif @endisset value="{{$c->id}}">{{$c->name}}</option>
									@endforeach
								</select>
							</div>

									@isset($case)
										<ul>
											@foreach($case->case_client as $case_client)
												<li>{{$case_client->client->name}} <a href="{{route('case.delete',['type'=>'client','id'=>$case_client->id])}}" >Delete</a></li>
											@endforeach
										</ul>
									@endisset
							<div class="form-group">
								<label for="exampleInputEmail1">Client</label>
								<select class="form-control select2 select2WithClient" multiple name="client[]">
									
								</select>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Date</label>
								<input type="date" name="date" class="form-control" value="{{$case ? old('date',$case->date) : ''}}" >
							</div>

							
							<div class="form-group">
								<label for="exampleInputEmail1">Remark</label>
								<textarea class="form-control" name="remark">{{$case ? old('remark',$case->remark) : ''}}</textarea>
							</div>

							@isset($case)
								<ul>
									@foreach($case->case_handle_by as $case_handle_by)
										<li>{{$case_handle_by->user->name}} <a href="{{route('case.delete',['type'=>'handle_by','id'=>$case_handle_by->id])}}" >Delete</a></li>
									@endforeach
								</ul>
							@endisset
							<div class="form-group">
								<label for="exampleInputEmail1">Handle By</label>
								<select class="form-control select2 select2WithUsers" multiple name="handleBy[]">
								</select>
							</div>


							@isset($case)
								<table class="table table-striped">
									<tr>
										<td>Sr No</td>
										<td>Download</td>
										<td>Created By</td>
										<td>Delete</td>
										<td>Added At</td>
									</tr>
									@foreach($case->case_documents as $key => $case_documents)
										<tr>
											<td>{{++$key}}</td>
											<td><a download href="{{$case_documents->path}}">{{$case_documents->file_name}}</a></td>
											<td>{{$case_documents->user->name}}</td>
											<td><a href="{{route('case.delete',['type'=>'document','id'=>$case_documents->id])}}">Delete</a></td>
											<td>{{$case_documents->created_at->format('d-m-Y H:i:s')}}</td>
										</tr>
									@endforeach
								</table>
							@endisset

							<div class="form-group">
								<label for="exampleInputEmail1">Upload Document</label>
								<input type="file" name="documents[]" multiple/>
							</div>


							@isset($case)
								<div class="form-group">
									<table class="table table-striped table-bordered">
										<tr>
											<td>Sr No</td>
											<td>User Name</td>
											<td>Updated At</td>
										</tr>
										@foreach($case->history as $key => $history)
											<tr>
												<td>{{++$key}}</td>
												<td>{{$history->user->name}}</td>
												<td>{{$history->created_at->format('d-m-Y H:i:s')}}</td>
											</tr>
										@endforeach
									</table>
								</div>
							@endisset
							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" name="status">
									<option @isset($case) @if(old($case->status,'status') == 1) "selected" @endif @endisset value="1">Active</option>
									<option @isset($case) @if(old($case->status,'status') == 0) "selected" @endif @endisset value="0">In-Active</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
								@if(isset($case)) Update  @else Add  @endif
							</button>
						</form>
					</div>
					<!-- /.card-content -->
				</div>
	</div>
</div>
@endsection