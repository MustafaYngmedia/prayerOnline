@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Users</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>Sr No</th>
								<th>Mobile</th>
								<th>Name</th>
								<th>Email</th>

								<th>Status</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
						<tfoot>
							<tr>
                                <th>Sr No</th>
								<th>Mobile</th>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<!-- <th>Action</th> -->
							</tr>
						</tfoot>
						<tbody>
                            @foreach($users as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->mobile}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>
									@if($u->status == 1)
                              			<span class="badge bg-success">Active</span>
									@else
										<span class="badge bg-danger">InActive</span>
									@endif
									</td>
                                    <?php /** <!-- <td><a class="btn btn-xs btn-primary" href="{{route('users.edit', $u->id)}}">Edit</a></td> --> **/?>
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