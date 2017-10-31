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
				<form name="update_user" class="" action="/admin/{{ $user->id }}" method="POST">
					
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Edit Admin</h1>
					</div>
					<div class="newUser">
						<div class="form-group">
							<label class="first_name text-light">Firstname</label>
							<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="Firstname" />
						</div>
						<div class="form-group">
							<label class="last_name text-light">Lastname</label>
							<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Lastname" />
						</div>
						<div class="form-group">
							<label class="username text-light">Email Address</label>
							<input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter A Username" />
						</div>
						<div class="form-group">
							<label class="password text-light">New Password</label>
							<input type="text" name="password" class="form-control" value="" placeholder="Enter A New Password" />
						</div>
						<div class="form-group">
							<label class="d-block text-light">Active User</label>
							
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
					<div class="newAdminInput">
						<input type="submit" name="submit" value="Update User" class="" />
					</div>
				</form>
			</div>
		</div>
	@endsection