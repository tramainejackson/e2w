@extends('layouts.app')

	@section('content')

		<div class="col-12 p-5 text-center">
			<h2 class="display-3">Login</h2>
		</div>

		<div class="col-12 col-md-6 mx-auto">

			<div class="panel-body rounded p-3">

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

					<div class="md-form">

						<button type="submit" class="btn btn-primary mx-0">Login</button>

						<a class="btn btn-link white mx-0" href="{{ route('password.request') }}">Forgot Your Password?</a>
					</div>
				</form>
			</div>
		</div>

	@endsection
