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
	<div id="main_content" class="container-fluid">	
		<div class="row">
			<div id="header" class="col-12 col-sm-12 main_content_class">
				<p>East Coast West Coast Travel</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="underline text-white">Reset Password</h2>
					</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
							{{ csrf_field() }}

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

									@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Reset Password
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
