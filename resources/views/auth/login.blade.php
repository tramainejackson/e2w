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
			<div id="" class="col-2 col-sm-2" style="">
				<div class="actionBtnDiv d-flex flex-column justify-content-center">
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a href="{{ route('welcome') }}" id="home_btn" class="btn btn-lg actionBtns py-3" disabled>Home</a>
					</div>
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a id="question_btn" class="btn btn-lg actionBtns py-3">Ask A Question</a>
					</div>
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a id="suggestion_btn" class="btn btn-lg actionBtns py-3">Suggestions</a>
					</div>
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns py-3">Contact Us</a>
					</div>
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns py-3">About Us</a>
					</div>
					<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
						<a id="admin_page_btn" class="btn btn-lg actionBtns py-3">Admin</a>
					</div>
				</div>
				<div id="mobile_action_btns">
					<div class="mobileMenuBtn">
						<a href="#" class="mobileMenuLink">Menu</a>
						<img src="images/menu.png" class="menuImg" />
					</div>
					<div class="mobileBtns">
						<button id="home_btn_mobile" class="">Home</button>
						<button id="question_btn_mobile" class="">Ask A Question</button>
						<button id="suggestion_btn_mobile" class="">Suggestion</button>
						<button id="contact_us_btn_mobile" class="">Contact Us</button>
						<button id="about_us_btn_mobile" class="">About Us</button>
						<button id="photos_btn_mobile" class="">Photos</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
