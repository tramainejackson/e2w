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
					<form name="new_admin_user" class="" action="users_add.php" method="POST">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" name="first_name" class="form-control" placeholder="Firstname" />
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" name="last_name" class="form-control" placeholder="Lastname" />
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" placeholder="Username" />
						</div><div class="form-group">
							<label for="email">Username</label>
							<input type="text" name="email" class="form-control" placeholder="Email Address" />
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" name="password" class="form-control" placeholder="Password" />
						</div>
						<div class="form-group">
							<label for="active" class="d-block" >Active</label>
							
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