@extends('layouts.app')
	@section('styles')
		<!-- Bootstrap core CSS -->
		<link href="/css/app.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="/css/e2w_2.css" rel="stylesheet">
	@endsection
	
	@section('scripts')
		<!-- Bootstrap core JS -->
		<script src="/js/app.js"></script>
		<script src="/js/eastwest_2.js"></script>
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
						<div class="newAdminInput">
							<input type="text" name="first_name" class="" placeholder="Firstname" />
						</div>
						<div class="newAdminInput">
							<input type="text" name="last_name" class="" placeholder="Lastname" />
						</div>
						<div class="newAdminInput">
							<input type="text" name="username" class="" placeholder="Username" />
						</div>
						<div class="newAdminInput">
							<input type="text" name="password" class="" placeholder="Password" />
						</div>
						<div class="newAdminInput">
							<select class="" name="active">
								<option value="" selected disabled>---Make Account Active---</option>
								<option value="Y">Yes</option>
								<option value="N">No</option>
							</select>
						</div>
						<div class="newAdminInput">
							<input type="submit" name="submit" value="Add User" class="" />
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection