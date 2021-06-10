@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Cases</h4>
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>Sr No</th>
								<th>Case No</th>
								<th>Case Type</th>
								<th>Client</th>
								<th>Handle By</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Sr No</th>
								<th>Case No</th>
								<th>Case Type</th>
								<th>Client</th>
								<th>Handle By</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
                            @foreach($cases as $u)
                                <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->case_no}}</td>
                                    <td>{{$u->type->name}}</td>
									<td>
										@foreach($u->case_client as $case_client)
										{{$case_client->client->name}} ,
										@endforeach
									</td>
									<td>
										@foreach($u->case_handle_by as $case_handle_by)
										{{$case_handle_by->user->name}} ,
										@endforeach
									</td>
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