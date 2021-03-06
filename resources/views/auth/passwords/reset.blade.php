@extends('layouts.app')
	
	@section('content')

		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

		<div class="col-12 col-md-8 full-height d-flex align-items-center flex-column justify-content-center mb-md-n5 mx-auto" id="">
			<div class="col-12 underline p-5 text-center">
				<h2 class="display-3">Reset Password</h2>
			</div>

			<div class="col-12 col-md-10 col-lg-8 mx-auto">

				<div class="panel-body rounded p-3">

					<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">

						{{ csrf_field() }}

						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-12 control-label">E-Mail Address</label>

							<div class="col-12">
								<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-12 control-label">Password</label>

							<div class="col-12">
								<input id="password" type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label for="password-confirm" class="col-12 control-label">Confirm Password</label>
							<div class="col-12">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

								@if ($errors->has('password_confirmation'))
									<span class="help-block">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Reset Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection
