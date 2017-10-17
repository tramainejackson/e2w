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
				<form name="update_user" class="" action="user_update.php" method="POST">
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Edit Admin</h1>
					</div>
					<div class="newUser">
						<div class="form-group">
							<label class="first_name">Firstname</label>
							<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="Firstname" />
						</div>
						<div class="form-group">
							<label class="last_name">Lastname</label>
							<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Lastname" />
						</div>
						<div class="form-group">
							<label class="username">Username</label>
							<input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Enter A Username" />
						</div>
						<div class="form-group">
							<label class="password">New Password</label>
							<input type="text" name="password" class="form-control" value="" placeholder="Enter A New Password" />
						</div>
						<div class="form-group">
							<label class="d-block">Active User</label>
							
							<div class="btn-group">
								<button type="button" class="btn {{ $user->active == 'Y' ? ' btn-success active' : '' }}" style="">
									<input type="checkbox" name="active" value="Y" {{ $user->active == 'Y' ? 'checked' : '' }} hidden />Yes
								</button>
								<button type="button" class="btn {{ $user->active == 'N' ? ' btn-danger active' : '' }}" style="">
									<input type="checkbox" name="active" value="N" {{ $user->active == 'N' ? 'checked' : '' }} hidden />No
								</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Update User" class="btn" />
					</div>
				</form>
			</div>
		</div>
	@endsection