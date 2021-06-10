@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Admin</h4>
					<!-- /.box-title -->
					<!-- /.dropdown js__dropdown -->
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>Sr No</th>
								<th>Type</th>
								<th>Title</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
							<th>Sr No</th>
								<th>Type</th>
								<th>Title</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($posts as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>
										@switch($u->type)
											@case('1')
												Text
											@break
											@case('2')
												Video
											@break
											@case('3')
												Audio
											@break
										@endswitch
									</td>
                                    <td>{{$u->title}}</td>
                                    <td>
									@if($u->status == 1)
                              			<span class="badge bg-success">Active</span>
									@else
										<span class="badge bg-danger">InActive</span>
									@endif
									</td>
                                    <td>{{$u->created_at}}</td>

                                    <td>
										<a class="btn btn-xs btn-primary" href="{{route('admin-post.edit', $u->id)}}">Edit</a>
										<a class="btn btn-xs btn-danger" href="{{route('admin-post.delete', $u->id)}}">Delete</a>

									</td>
                                </tr>
                            @endforeach
                        </tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
    </div>
</div>
@endsection