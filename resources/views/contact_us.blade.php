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
			
			<div class="row">
				<div id="header" class="col-12 col-sm-12 main_content_class">
					<p>East Coast West Coast Travel</p>
				</div>
			</div>
			<div class="row">
				<div class="col-8 col-sm-8 ml-auto">
					<div class="row d-flex">
						<div class="col-12 col-sm-12" class="navContent">
							<h2 class="underline text-white">Contact Us</h2>
						</div>
						<div class="col-5 col-sm-5 align-self-stretch">
							<div class="card" id="">
								<img class="card-img-top" src="/images/holly13.jpg" />
								<div class="card-body">
									<p class="contact_name">Name: Deborah Jackson</p>
								</div>
								<div class="card-footer text-center">
									<p class="contact_email">Email: <a href="mailto:jacksond1961@yahoo.com" class="">jacksond1961@yahoo.com</a></p>
								</div>
							</div>
						</div>
						<div class="col-5 col-sm-5">
							<div class="card" id="">
								<img class="card-img-top" src="/images/RhondaLambert2.png" />
								<div class="card-body">
									<p class="contact_name">Name: Rhonda Lambert</p>
								</div>
								<div class="card-footer text-center">
									<p class="contact_email">Email: <a href="mailto:rhonda.lambert@sbcglobal.com" class="">rhonda.lambert@sbcglobal.com</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="" class="col-2 col-sm-2" style="">
					<div class="actionBtnDiv d-flex flex-column justify-content-center">
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('welcome') }}" id="home_btn" class="btn btn-lg actionBtns py-3" disabled>Home</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<button id="question_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".questionModal">Ask A Question</button>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a id="suggestion_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".suggestionModal">Suggestions</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns py-3">Contact Us</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns py-3">About Us</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('login') }}" id="admin_page_btn" class="btn btn-lg actionBtns py-3">Admin</a>
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