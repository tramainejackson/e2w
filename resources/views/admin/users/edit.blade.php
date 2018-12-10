@extends('admin.layouts.app')

	@section('content')

		<div class="row">

			<div class="col" id="all_users">

				<form name="update_user" class="" action="/admin/{{ $user->id }}" method="POST">
					
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Edit Admin</h1>
					</div>
					
					<div class="newUser">

						<div class="md-form">
							<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="Firstname" />
							
							@if ($errors->has('first_name'))
								<span class="text-danger">First Name cannot be empty</span>
							@endif

							<label class="first_name">Firstname</label>
						</div>

						<div class="md-form">
							<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Lastname" />
							
							@if ($errors->has('last_name'))
								<span class="text-danger">Last Name cannot be empty</span>
							@endif

							<label class="last_name">Lastname</label>
						</div>

						<div class="md-form">
							<input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter A Username" />
							
							@if ($errors->has('email'))
								<span class="text-danger">Email cannot be empty</span>
							@endif

							<label class="username">Email Address</label>
						</div>

						<div class="md-form">
							<label class="password">New Password</label>
							<input type="text" name="password" class="form-control" value="" placeholder="Enter A New Password" />
							
							@if ($errors->has('password'))
								<span class="text-danger">Password must be at least 7 characters long</span>
							@endif
						</div>

						<div class="md-form">

							<div class="btn-group mt-2">
								<button type="button" class="btn yesBtn{{ $user->active == 'Y' ? ' btn-success active' : ' stylish-color' }}">
									<input type="checkbox" name="active" value="Y" {{ $user->active == 'Y' ? 'checked' : '' }} hidden />Yes
								</button>

								<button type="button" class="btn noBtn{{ $user->active == 'N' ? ' btn-danger active' : ' stylish-color' }}">
									<input type="checkbox" name="active" value="N" {{ $user->active == 'N' ? 'checked' : '' }} hidden />No
								</button>
							</div>

							<label class="active">Active User</label>
						</div>

						<div class="newAdminInput">
							<button class="btn btn-info ml-0" type="submit">Update User</button>
						</div>

					</div>

				</form>

			</div>

		</div>

	@endsection