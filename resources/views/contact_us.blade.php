@extends('layouts.app')

	@section('styles')
		<style>
			/*Smartphones portrait*/
			@media only screen and (max-width:575px) {
				div#app {
					background: initial;
				}

				div#app:after {
					content: "";
					position: fixed;
					background-image: url(/images/Jacksonville_Skyline_Night_Panorama_Digon3.jpg);
					background-size: cover;
					background-position: center center;
					background-repeat: no-repeat;
					top: 0;
					bottom: 0;
					left: 0;
					right: 0;
					z-index: -1;
				}
			}
		</style>
	@endsection

	@section('content')

		<div class="col-12 mx-auto">

			<div class="row">

				<div class="col-12 underline d-none d-xl-block p-5 text-center" class="">
					<h2 class="display-3">Contact Us</h2>
				</div>

				<div class="col-12 white-text text-center m-0 p-5 d-xl-none">
					<h2 class="" style=" font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Contact Us</b></</h2>
				</div>

			</div>

			<div class="row justify-content-center mb-3">

				<div class="col-11 col-sm-6 col-xl-4 mb-2 mx-auto mx-sm-0">
					<div class="card mx-auto h-100" id="">

						<img class="card-img-top" src="/images/holly13.jpg" />

						<div class="card-body">
							<h4 class="card-title">Deborah Jackson</h4>
							<p class="contact_email">Email: <a href="mailto:jacksond1961@yahoo.com" class="">jacksond1961@yahoo.com</a></p>
						</div>

					</div>
				</div>

				<div class="col-11 col-sm-6 col-xl-4 mb-2 mx-auto mx-sm-0">

					<div class="card mx-auto" id="">

						<img class="card-img-top" src="/images/RhondaLambert3.png" />

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

	@endsection