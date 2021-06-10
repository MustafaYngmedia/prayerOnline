@extends('layouts.app')
@section('content')

<div id="wrapper">
	<div class="main-content">

					
						<div class="box-content card white">
					<h4 class="box-title">Client @isset($user) - {{$user->id}} @endisset <a class="pull-right btn btn-primary btn-xs" href="{{route('client.list')}}">Back</a></h4>
					<div class="card-content">
						<form action="{{route('client.store')}}" method="post" enctype="multipart/form-data">
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
								<label >Name<span style="color:red">*</span></label>
								<input type="text" name="name" class="form-control" value="{{$user ? $user->name : old('name')}}"placeholder="Enter your name">
							</div>
							<div class="form-group">
								<label >Designation</label>
								<input type="text" name="designation" class="form-control" value="{{$user ? $user->designation : old('designation')}}"placeholder="Enter your Designation">
							</div>

							<div class="form-group">
								<label >Father's Name<span style="color:red">*</span></label>
								<input type="text"  name="father_name" class="form-control" value="{{$user ? $user->father_name : old('father_name')}}"placeholder="Enter your Father's Name">
							</div>
							
							<div class="form-group">
								<label >Mother's Name</label>
								<input type="text" name="mother_name" class="form-control" value="{{$user ? $user->mother_name : old('mother_name')}}"placeholder="Enter your Mother's Name">
							</div>
							
							<div class="form-group">
								<label >Dob<span style="color:red">*</span></label>
								<input type="date" name="dob" class="form-control" value="{{$user ? date('Y-m-d',strtotime($user->dob)) : old('dob')}}"placeholder="Enter your Dob">
							</div>
							
							<div class="form-group">
								<label >Marital Status<span style="color:red">*</span></label>
								<select name="marital_status" class="form-control">
									<option value="">- Select -</option>

									<option value="1" @isset($user) {{$user->marital_status == '1' ? 'selected' : ''}} @endisset >Single</option>
									<option value="2" @isset($user) {{$user->marital_status == '2' ? 'selected' : ''}} @endisset >Marriage</option>
									<option value="3" @isset($user) {{$user->marital_status == '3' ? 'selected' : ''}} @endisset >Divored</option>

								</select>
							</div>
							
							<div class="form-group">
								<label >Date of Anniversary</label>
								<input type="date" name="doa" class="form-control" value="{{$user ? date('Y-m-d',strtotime($user->doA)) : old('doA')}}"placeholder="Enter your Date of Anniversary">
							</div>

							<div class="form-group">
								<label >Present Address<span style="color:red">*</span></label>
								<textarea name="present_address" class="form-control" placeholder="Enter your Present Address">{{$user ? $user->present_address  : old('present_address')}}</textarea>
							</div>

							<div class="form-group">
								<label >Permanent Address</label>
								<textarea name="permanent_address" class="form-control" placeholder="Enter your Permanent Address">{{$user ? $user->permanent_address  : old('permanent_address')}}</textarea>
							</div>

							
							<div class="form-group">
								<label >Mobile Number<span style="color:red">*</span></label>
								<input name="mobile_number" class="form-control" value="{{$user ? $user->mobile_number  : old('mobile_number')}}" placeholder="Enter your Mobile Number" />
							</div>

							<div class="form-group">
								<label >Mobile Number 2</label>
								<input name="mobile_number_2" class="form-control" value="{{$user ? $user->mobile_number_2  : ''}}" placeholder="Enter your Mobile Number 2" />
							</div>

							
							<div class="form-group">
								<label >Email Address<span style="color:red">*</span></label>
								<input name="email_address" class="form-control" value="{{$user ? $user->email_address  : ''}}" placeholder="Enter your Email Address" />
							</div>
							
							<div class="form-group">
								<label >Email Address 2</label>
								<input name="email_address_2" class="form-control" value="{{$user ? $user->email_address_2  : ''}}" placeholder="Enter your Email Address 2" />
							</div>


							<div class="form-group">
								<label >Pan Card</label>
								@if(isset($user) && $user->pan_file != "")
									<a download href="{{$user->pan_file}}">Download</a>
								@endif
								<input name="pan_file" type="file"  class="form-control" placeholder="Enter your Email Address 2" />
							</div>

							<div class="form-group">
								<label >Aadhar Card<span style="color:red">*</span></label>
								@if(isset($user) && $user->aadhar_file != "")
									<a download href="{{$user->aadhar_file}}">Download</a>
								@endif
								<input name="aadhar_file" type="file"  class="form-control" />
							</div>

							<div class="form-group">
								<label >Passport</label>
								@if(isset($user) && $user->passport_number_file != "")
									<a download href="{{$user->passport_number_file}}">Download</a>
								@endif
								<input name="passport_number_file" type="file"  class="form-control" />
							</div>
							
							<div class="form-group">
								<label >Passport Photo</label>
								@if(isset($user) && $user->passport_photo_file != "")
									<a download href="{{$user->passport_photo_file}}">Download</a>
								@endif
								<input name="passport_photo_file" type="file"  class="form-control" />
							</div>

							<div class="form-group">
								<label >Client Type<span style="color:red">*</span></label>
								<select name="client_type" class="form-control">
									<option value="">- Select -</option>
									<option value="1" @isset($user) {{$user->client_type == 1 ? 'selected' : ''}} @endisset >Individual</option>
									<option value="2" @isset($user) {{$user->client_type == 2 ? 'selected' : ''}} @endisset >Corporate</option>
								</select>
							</div>

							
							<div class="form-group">
								<label >Company Type<span style="color:red">*</span></label>
								<select name="" name="company_type" class="form-control">
									<option value="">- Select -</option>
									<option value="1" @isset($user) {{$user->company_type == 1 ? 'selected' : ''}} @endisset >Test 1</option>
									<option value="2" @isset($user) {{$user->company_type == 2 ? 'selected' : ''}} @endisset >Test 2</option>
								</select>
							</div>
							<div class="form-group">
								<label >Company Name<span style="color:red">*</span></label>
								<input name="company_name" class="form-control" value="{{$user ? $user->company_name  : ''}}" placeholder="Enter your Company Name" />
							</div>

							<div class="form-group">
								<label >Registered Office</label>
								<input name="registered_office" class="form-control" value="{{$user ? $user->registered_office  : ''}}" placeholder="Enter Company Registered Office" />
							</div>

							<div class="form-group">
								<label >Corporate Office<span style="color:red">*</span></label>
								<input name="corporate_office" class="form-control" value="{{$user ? $user->corporate_office  : ''}}" placeholder="Enter Company Corporate Office" />
							</div>
							
							<div class="form-group">
								<label >Tel Office<span style="color:red">*</span></label>
								<input name="tel_office" class="form-control" value="{{$user ? $user->tel_office  : ''}}" placeholder="Enter Tel Office" />
							</div>

							<div class="form-group">
								<label >Tel Office 2</label>
								<input name="tel_office_2" class="form-control" value="{{$user ? $user->tel_office_2  : ''}}" placeholder="Enter Tel Office 2" />
							</div>

							<div class="form-group">
								<label >Website</label>
								<input name="website" class="form-control" value="{{$user ? $user->website  : ''}}" placeholder="Enter Company Website" />
							</div>
							<div class="form-group">
								<label >Company Email Address<span style="color:red">*</span></label>
								<input name="company_email_address" class="form-control" value="{{$user ? $user->company_email_address  : ''}}" placeholder="Enter Company Email Address" />
							</div>

							<div class="form-group">
								<label >Company Email Address 2</label>
								<input name="company_email_address_2" class="form-control" value="{{$user ? $user->company_email_address_2  : ''}}" placeholder="Enter Email Address 2" />
							</div>

							
							<div class="form-group">
								<label >Company Pan Card</label>
								@if(isset($user) && $user->company_pan_file != "")
									<a download href="{{$user->company_pan_file}}">Download</a>
								@endif
								<input name="company_pan_file" type="file"  class="form-control"/>
							</div>

							<div class="form-group">
								<label >Company CIN</label>
								@if(isset($user) && $user->company_cin_file	 != "")
									<a download href="{{$user->company_cin_file	}}">Download</a>
								@endif
								<input name="company_cin_file" type="file" class="form-control"/>
							</div>
							
							<div class="form-group">
								<label >Company Gst</label>
								@if(isset($user) && $user->gst_file	 != "")
									<a download href="{{$user->gst_file	}}">Download</a>
								@endif
								<input name="gst_file" type="file" class="form-control"/>
							</div>
							<div class="form-group">
								<label >Company Gst Number</label>
								<input name="gst_number" type="text" value="{{$user ? $user->gst_number  : ''}}" placeholder="Enter Company Gst Number" class="form-control"/>
							</div>


							<div class="form-group">
								<label >Occupation Type</label>
								<select name="" name="occuption_type" class="form-control">
									<option value="">- Select -</option>
									<option value="1" @isset($user) {{$user->occuption_type == 1 ? 'selected' : ''}} @endisset >Self-Employed</option>
									<option value="2" @isset($user) {{$user->occuption_type == 2 ? 'selected' : ''}} @endisset >Private Service</option>
									<option value="3" @isset($user) {{$user->occuption_type == 3 ? 'selected' : ''}} @endisset >Government Service</option>
									<option value="4" @isset($user) {{$user->occuption_type == 4 ? 'selected' : ''}} @endisset >Student</option>
									<option value="5" @isset($user) {{$user->occuption_type == 5 ? 'selected' : ''}} @endisset >Others</option>
								</select>
							</div>
							<div class="form-group">
								<label >Name of Organisation</label>
								<input name="occupation_org_name" type="text" value="{{$user ? $user->occupation_org_name  : ''}}" placeholder="Enter Name of Organisation" class="form-control"/>
							</div>
							
							<div class="form-group">
								<label>Occupation Designation</label>
								<input name="occupation_designation" type="text" value="{{$user ? $user->occupation_designation  : ''}}" placeholder="Occupation Designation" class="form-control"/>
							</div>
							
							<div class="form-group">
								<label>Occupation Address</label>
								<input name="occupation_address" type="text" value="{{$user ? $user->occupation_address  : ''}}" placeholder="Occupation Address" class="form-control"/>
							</div>
							
							<div class="form-group">
								<label>Occupation Email</label>
								<input name="occupation_email" type="text" value="{{$user ? $user->occupation_email  : ''}}" placeholder="Occupation Email" class="form-control"/>
							</div>
							<div class="form-group">
								<label >Comment</label>
								<textarea name="comment" class="form-control" placeholder="Enter your Comment">{{$user ? $user->comment  : ''}}</textarea>
							</div>
							<div class="form-group">
								<label >Status</label>
								<select class="form-control" name="status">
									<option @isset($user) @if($user->status == 1) selected @endif @endisset value="1">Active</option>
									<option @isset($user) @if($user->status == 0) selected @endif @endisset value="0">In-Active</option>
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