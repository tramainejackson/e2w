@extends('layouts.app')

	@section('content')

		<div class="col-12 white-text text-center m-0 p-5 d-xl-none">
			<h2 class="" style="font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e;"><b>Login</b></h2>
		</div>

		<div class="col-12 underline d-none d-xl-block p-5 text-center">
			<h2 class="display-3">Login</h2>
		</div>

		<div class="col-12 col-sm-auto mx-auto">

			<div class="panel-body rounded">

				<form class="form-horizontal" method="POST" action="{{ route('login') }}">

					{{ csrf_field() }}

					<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">

						<input id="email" type="email" class="form-control white-text" name="email" value="{{ old('email') }}" required autofocus>

						<label for="email" class="">E-Mail Address</label>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif

					</div>

					<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">

						<input id="password" type="password" class="form-control white-text" name="password" required>

						<label for="password" class="col-md-4 control-label">Password</label>

						@if ($errors->has('password'))
							<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
						@endif

					</div>

					<!-- Need to fix remember me link -->
					<!-- <div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
								</label>
							</div>
						</div>
					</div> -->

					<div class="md-form">

						<button type="submit" class="btn btn-primary mx-0">Login</button>

						<a class="btn btn-link white mx-0" href="{{ route('password.request') }}">Forgot Your Password?</a>

					</div>

				</form>

			</div>

		</div>

	@endsection
