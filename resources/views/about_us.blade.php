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
			
			<div class="row d-none d-xl-flex align-items-strecth">
				<div id="header" class="col-12 col-sm-12 main_content_class">
					<p>East Coast West Coast Travel</p>
				</div>
				<div class="col-8 col-sm-8 ml-auto align-self-center">
					<h2 class="underline text-white">About Us</h2>
					<p id="about_us_div" class="rounded">
						Here at EastCoast to WestCoast Travel, we have the ultimate family oriented experience because that's how we got started.  A group of friends decided that we wanted to travel and see the world. And who better to do that with than the closest people to you. So tell a brother, sister, cousin, friend, co-worker or whoever you think you would have the most fun with. And we're never short of activities. Check out the upcoming trips we have on the East and West coast and see what activites we have planned for each trip. Don't forget to sign up for the one you would be most interested in. Hope you decide to come along for the ride.
					</p>
				</div>
				<div id="" class="col-2 col-sm-2" style="">
					<div class="actionBtnDiv d-flex flex-column justify-content-center">
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('welcome') }}" id="home_btn" class="btn btn-lg actionBtns py-3 text-dark" disabled>Home</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<button id="question_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".questionModal">Ask A Question</button>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a id="suggestion_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".suggestionModal">Suggestions</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns py-3 text-dark">Contact Us</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns py-3 text-dark">About Us</a>
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
			
			<div class="row d-xl-none">
			@include('layouts.mobile_nav')
			
				<div class="col-12 p-0">
					<h2 class="text-black text-center m-0 p-5" style="background:linear-gradient(#f2f2f2, #f2f2f2, #f2f2f2, rgba(0, 0, 0, 0)); font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>About Us</b></h2>
				</div>
				<div class="col">
					<p id="" class="bg-light text-black p-5 m-5 rounded">
						Here at EastCoast to WestCoast Travel, we have the ultimate family oriented experience because that's how we got started.  A group of friends decided that we wanted to travel and see the world. And who better to do that with than the closest people to you. So tell a brother, sister, cousin, friend, co-worker or whoever you think you would have the most fun with. And we're never short of activities. Check out the upcoming trips we have on the East and West coast and see what activites we have planned for each trip. Don't forget to sign up for the one you would be most interested in. Hope you decide to come along for the ride.
					</p>
				</div>
			</div>
		</div>
	@endsection