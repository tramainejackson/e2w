@extends('layouts.app')

	@section('content')

		<div class="col-12 p-5 mt-5 text-center">
			<h2 class="display-3 font-weight-bold">Contact Us</h2>
		</div>

		<div class="col-12 mx-auto">

			<div class="row justify-content-center mb-3">

				<div class="col-11 col-sm-6 col-lg-4 col-xl-4 mb-2 mx-auto mx-sm-0">
					<div class="card mx-auto h-100" id="">

						<img class="card-img-top" src="/images/holly13.jpg" />

						<div class="card-body">
							<h4 class="card-title">Deborah Jackson</h4>
							<p class="contact_email">Email: <a href="mailto:jacksond1961@yahoo.com" class="">jacksond1961@yahoo.com</a></p>
						</div>

					</div>
				</div>

				<div class="col-11 col-sm-6 col-lg-4 col-xl-4 mb-2 mx-auto mx-sm-0">

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
							<input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required  {{ $errors->first('email_address') ? 'first_name' : '' }}/>

							@if($errors->has('first_name'))
								<span class="text-danger">{{ $errors->first('first_name') }}</span>
							@endif

							<label for="first_name">First Name:</label>
						</div>
						
						<div class="md-form">
							<input class="form-control" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required  {{ $errors->first('email_address') ? 'last_name' : '' }}/>

							@if($errors->has('last_name'))
								<span class="text-danger">{{ $errors->first('last_name') }}</span>
							@endif

							<label for="last_name">Last Name:</label>
						</div>
						
						<div class="md-form">
							<input class="form-control" type="email" id="email_address" name="email_address" value="{{ old('email_address') }}" required  {{ $errors->first('email_address') ? 'autofocus' : '' }}/>

							@if($errors->has('email_address'))
								<span class="text-danger">{{ $errors->first('email_address') }}</span>
							@endif

							<label for="email_address">Email Address:</label>
						</div>
						
						<div class="md-form">
							<textarea class="form-control md-textarea" id="question_text" name="question_text" rows="5" cols="15" required {{ $errors->first('question_text') ? 'autofocus' : '' }}>{{ old('question_text') }}</textarea>

							@if($errors->has('question_text'))
								<span class="text-danger">{{ $errors->first('question_text') }}</span>
							@endif

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