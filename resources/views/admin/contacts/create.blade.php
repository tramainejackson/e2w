@extends('admin.layouts.app')

	@section('content')

		<div class="row" id="all_users">

			<div class="col">

				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">Add New Contact</h1>
				</div>

				<div class="newUser">

					{!! Form::open(['action' => 'DistributionListController@store', 'method' => 'POST', 'class' => '']) !!}
						
						<div class="md-form">
							<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter Firstname" />
							
							@if ($errors->has('first_name'))
								<span class="text-danger">First Name cannot be empty</span>
							@endif

							<label for="first_name" class="">First Name</label>
						</div>

						<div class="md-form">
							<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter Lastname" />
							
							@if ($errors->has('last_name'))
								<span class="text-danger">Last Name cannot be empty</span>
							@endif

							<label for="last_name" class="">Last Name</label>
						</div>

						<div class="md-form">
							<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email Address" />
							
							@if ($errors->has('email'))
								<span class="text-danger">Email Address cannot be empty</span>
							@endif

							<label for="email" class="">Email Address</label>
						</div>

						<div class="md-form">
							<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone Number" />

							@if($errors->has('phone'))
								<span class="text-danger">Phone number doesn't have enough numbers</span>
							@endif

							<label for="phone" class="">Email Address</label>
						</div>

						<div class="newAdminInput">
							<button type="submit" class="btn btn-info ml-0">Add Contact</button>
						</div>

					{!! Form::close() !!}

				</div>

			</div>

		</div>

	@endsection