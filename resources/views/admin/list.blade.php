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
								<th>Mobile</th>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                <th>Sr No</th>
								<th>Mobile</th>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($users as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->mobile}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>
									@if($u->status == 1)
                              			<span class="badge bg-success">Active</span>
									@else
										<span class="badge bg-danger">InActive</span>
									@endif
									</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('admin.edit', $u->id)}}">Edit</a></td>
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
