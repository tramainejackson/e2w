@extends('layouts.app')

	@section('content')

		<div class="col-12 p-0">
			<h2 class="white-text text-center m-0 p-5" style="font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e;"><b>Login</b></h2>
		</div>

		<div class="col-12 col-sm-8 ml-auto">

			<div class="panel-heading d-none">
				<h2 class="underline text-white">Login</h2>
			</div>

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

		{{--<div id="" class="col-2 col-sm-2" style="">--}}
			{{--<div class="actionBtnDiv d-flex flex-column justify-content-center">--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="http://www.eastcoast2westcoast.com" id="home_btn" class="btn btn-lg actionBtns text-dark py-3" disabled="">Home</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a id="question_btn" class="btn btn-lg actionBtns py-3">Ask A Question</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a id="suggestion_btn" class="btn btn-lg actionBtns py-3">Suggestions</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="http://www.eastcoast2westcoast.com/contact_us" id="contact_us_btn" class="btn btn-lg actionBtns text-dark py-3">Contact Us</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="http://www.eastcoast2westcoast.com/about_us" id="about_us_btn" class="btn btn-lg actionBtns text-dark py-3">About Us</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="#" id="admin_page_btn" class="btn btn-lg actionBtns text-dark py-3" disabled="">Admin</a>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}

	@endsection
