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
								<th>User Name</th>
								
								<th>Content</th>
							<th>Country</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                <th>Sr No</th>
								<th>User Name</th>
								<th>Title</th>
								<th>Content</th>
								
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($all_posts as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->user->name}}</td>
                                    <td>{{$u->text}}</td>
                                    <td>{{$u->country}}</td>
                             
                                    <td><a class="btn btn-xs btn-danger" href="{{route('post.delete', $u->id)}}">Delete</a></td>
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
