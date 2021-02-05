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

					<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">

						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-12 control-label">E-Mail Address</label>

							<div class="col-12">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-12 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Send Password Reset Link</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection
