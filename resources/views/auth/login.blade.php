@extends('layouts.app')

	@section('content')

		<div class="col-12 col-md-8 align-items-center flex-column mb-md-n5 mx-auto" id="">

			<div class="col-12 p-2 p-sm-4 p-md-5 text-center">
				<h2 class="display-3">Login</h2>
			</div>

			<div class="col-12 col-md-10 col-lg-8 mx-auto">

				<div class="panel-body rounded p-3">

					<form class="form-horizontal" method="POST" action="{{ route('login') }}">

						{{ csrf_field() }}

						<div class="md-form">

							<input id="email" type="email" class="form-control white-text" name="email" value="{{ old('email') }}" required autofocus>

							<label for="email" class="">E-Mail Address</label>

							@if(session('errors'))
								<!--Username/Password Combination error message-->
								<div class="m-3">
									<span class="red-text">{{ session('errors') }}</span>
								</div>
							@endif
						</div>

						<div class="md-form">

							<input id="password" type="password" class="form-control white-text" name="password" required>

							<label for="password" class="col-md-4 control-label">Password</label>
						</div>

						<div class="md-form">

							<button type="submit" class="btn btn-primary mx-0">Login</button>

							<a class="btn btn-link white mx-0" href="{{ route('password.request') }}">Forgot Your Password?</a>
						</div>
					</form>
				</div>
			</div>
		</div>

	@endsection

	@section('scripts')
		<script type="text/javascript">
			$('footer').addClass('position-fixed w-100');
		</script>
	@endsection