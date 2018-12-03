@extends('layouts.app')

	@section('content')

		<div class="col-12 col-sm-8 ml-auto">

			<div class="row">

				<div class="col-12 col-sm-12 d-none" class="navContent">
					<h2 class="underline white-text">Contact Us</h2>
				</div>

				<div class="col-12 p-0">
					<h2 class="white-text text-center m-0 p-5" style=" font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Contact Us</b></</h2>
				</div>

			</div>

			<div class="row align-items-stretch">

				<div class="col-11 col-sm-6 mb-2 mx-auto mx-sm-0">
					<div class="card mx-auto h-100" id="">

						<img class="card-img-top" src="/images/holly13.jpg" />

						<div class="card-body">
							<h4 class="card-title">Deborah Jackson</h4>
							<p class="contact_email">Email: <a href="mailto:jacksond1961@yahoo.com" class="">jacksond1961@yahoo.com</a></p>
						</div>

					</div>
				</div>

				<div class="col-11 col-sm-6 mb-2 mx-auto mx-sm-0">

					<div class="card mx-auto" id="">

						<img class="card-img-top" src="/images/RhondaLambert2.png" />

						<div class="card-body">
							<h4 class="card-title">Rhonda Lambert</h4>
							<p class="contact_email">Email: <a href="mailto:rhonda.lambert@sbcglobal.com" class="">rhonda.lambert@sbcglobal.com</a></p>
						</div>
					</div>

				</div>

			</div>

			<div class="row">
				
				<div class="col-10 col-sm-6 mx-auto my-4 rounded white ">

					<h2 class="text-center my-2">Send A Question</h2>

					<form id="question_form1" action="/questions" method="POST">

						{{ method_field('POST') }}
						{{ csrf_field() }}

						<div class="md-form">
							<input class="form-control" type="text" id="first_name" name="first_name" required />
							<label for="first_name">First Name:</label>
						</div>
						
						<div class="md-form">
							<input class="form-control" type="text" id="last_name" name="last_name" required />
							<label for="last_name">Last Name:</label>
						</div>
						
						<div class="md-form">
							<input class="form-control" type="email" id="email_address" name="email_address" required />
							<label for="email_address">Email Address:</label>
						</div>
						
						<div class="md-form">
							<textarea class="form-control md-textarea" id="question_text" name="question_text" rows="5" cols="15"required></textarea>
							<label for="question_text">Question:</label>
						</div>
						
						<div class="md-form">
							<input type="submit" id="submit_question" class="btn btn-info" onclick="sendQuestion();" value="Send" />
						</div>

					</form>

				</div>

			</div>

		</div>

		{{--<div id="" class="col-2 col-sm-2" style="">--}}
			{{--<div class="actionBtnDiv d-flex flex-column justify-content-center">--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="{{ route('welcome') }}" id="home_btn" class="btn btn-lg actionBtns py-3">Home</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<button id="question_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".questionModal">Ask A Question</button>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a id="suggestion_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".suggestionModal">Suggestions</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns py-3">Contact Us</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns py-3">About Us</a>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
					{{--<a href="{{ route('login') }}" id="admin_page_btn" class="btn btn-lg actionBtns py-3">Admin</a>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<div id="mobile_action_btns">--}}
				{{--<div class="mobileMenuBtn">--}}
					{{--<a href="#" class="mobileMenuLink">Menu</a>--}}
					{{--<img src="images/menu.png" class="menuImg" />--}}
				{{--</div>--}}
				{{--<div class="mobileBtns">--}}
					{{--<button id="home_btn_mobile" class="">Home</button>--}}
					{{--<button id="question_btn_mobile" class="">Ask A Question</button>--}}
					{{--<button id="suggestion_btn_mobile" class="">Suggestion</button>--}}
					{{--<button id="contact_us_btn_mobile" class="">Contact Us</button>--}}
					{{--<button id="about_us_btn_mobile" class="">About Us</button>--}}
					{{--<button id="photos_btn_mobile" class="">Photos</button>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}

	@endsection