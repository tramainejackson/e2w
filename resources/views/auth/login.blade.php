@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		@include('modals.questions')
		@include('modals.suggestions')
		<div id="main_content" class="container-fluid">	
			@if(session('status'))
				<h2 class="flashMessage">{{ session('status') }}</h2>
			@endif

			<div class="row d-none d-xl-flex">
				<div id="header" class="col-12 col-sm-12 main_content_class">
					<p>East Coast West Coast Travel</p>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="panel panel-default">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8 col-sm-8 ml-auto">
							<div class="panel-heading">
								<h2 class="underline text-white">Login</h2>
							</div>
							<div class="panel-body rounded">
								<form class="form-horizontal" method="POST" action="{{ route('login') }}">
									{{ csrf_field() }}

									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="col-md-4 control-label">E-Mail Address</label>

										<div class="col-md-6">
											<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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

									<div class="form-group">
										<div class="col-md-8 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Login
											</button>

											<a class="btn btn-link" href="{{ route('password.request') }}">
												Forgot Your Password?
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div id="" class="col-2 col-sm-2" style="">
							<div class="actionBtnDiv d-flex flex-column justify-content-center">
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a href="http://www.eastcoast2westcoast.com" id="home_btn" class="btn btn-lg actionBtns text-dark py-3" disabled="">Home</a>
								</div>
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a id="question_btn" class="btn btn-lg actionBtns py-3">Ask A Question</a>
								</div>
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a id="suggestion_btn" class="btn btn-lg actionBtns py-3">Suggestions</a>
								</div>
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a href="http://www.eastcoast2westcoast.com/contact_us" id="contact_us_btn" class="btn btn-lg actionBtns text-dark py-3">Contact Us</a>
								</div>
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a href="http://www.eastcoast2westcoast.com/about_us" id="about_us_btn" class="btn btn-lg actionBtns text-dark py-3">About Us</a>
								</div>
								<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
									<a href="#" id="admin_page_btn" class="btn btn-lg actionBtns text-dark py-3" disabled="">Admin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row d-xl-none">
				@include('layouts.mobile_nav')

				<div class="col-12 p-0">
					<h2 class="text-black text-center m-0 p-5" style="background:linear-gradient(#f2f2f2, #f2f2f2, #f2f2f2, rgba(0, 0, 0, 0)); font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Login</b></</h2>
				</div>
				<div class="col">
					<div class="panel-body rounded">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Login
									</button>

									<a class="btn btn-link" href="{{ route('password.request') }}">
										Forgot Your Password?
									</a>
								</div>
							</div>
						</form>
				</div>
			</div>				
		</div>
@endsection
