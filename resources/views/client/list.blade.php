@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Client</h4>
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>Sr No</th>
								<th>Name</th>
								<th>Client Type</th>
								<th>Mobile Number</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
							<th>Sr No</th>
								<th>Name</th>
								<th>Client Type</th>
								<th>Mobile Number</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($client as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>
										@if($u->client_type == 1)
											Individual
										@else
											Corporate
										@endif
										</td>
                                    <td>{{$u->mobile_number}}</td>
                                    <td>{{$u->email_address}}</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('case.edit', $u->id)}}">Edit</a></td>
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