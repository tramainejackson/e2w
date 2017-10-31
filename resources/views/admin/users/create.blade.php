@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="admin_page">
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			@include('layouts.admin_nav')
			<div class="adminDiv" id="all_users">
				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">Add New Admins</h1>
				</div>
				<div class="newUser">
					<form name="new_admin_user" class="" action="/admin" method="POST">
						
						{{ method_field('POST') }}
						{{ csrf_field() }}
						
						<div class="form-group">
							<label for="first_name" class="text-light">First Name</label>
							<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Firstname" />
							
							@if ($errors->has('first_name'))
								<span class="text-danger">First Name cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							<label for="last_name" class="text-light">Last Name</label>
							<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Lastname" />
							
							@if ($errors->has('last_name'))
								<span class="text-danger">Last Name cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							<label for="email" class="text-light">Username</label>
							<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" />
							
							@if ($errors->has('email'))
								<span class="text-danger">Email Address cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password" class="text-light">Password</label>
							<input type="text" name="password" class="form-control" placeholder="Password" />
							
							@if ($errors->has('password'))
								<span class="text-danger">Password cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							<label for="active" class="d-block text-light" >Active</label>
							
							<div class="btn-group">
								<button type="button" class="btn" style="">
									<input type="checkbox" name="active" value="Y" hidden />Yes
								</button>
								<button type="button" class="btn btn-danger active" style="">
									<input type="checkbox" name="active" value="N" checked hidden />No
								</button>
							</div>
						</div>
						<div class="newAdminInput">
							<input type="submit" name="submit" value="Add User" class="" />
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection