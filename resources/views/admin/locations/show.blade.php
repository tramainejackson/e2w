@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
		<style>
			/*Smartphones portrait*/
			@media only screen and (max-width:575px) {
				div#app {
					background: initial;
				}
				div#app:after {
					content: "";
					background:linear-gradient(#f2f2f2, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url({{ $tripLocation->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $tripLocation->trip_photo)) : '/images/skyline.jpg' }});
					background-size: cover;
					background-position: center center;
					background-repeat: no-repeat;
					position: fixed;
					top: 0;
					bottom: 0;
					right: 0;
					left: 0;
					z-index: -1;
				}
			}
		</style>
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div class="d-none d-xl-flex">
			<div class="showTrip" style="background-image:url({{ $tripLocation->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $tripLocation->trip_photo)) : '/images/skyline.jpg' }})">
				<div class="container-fluid text-light position-relative" style="z-index:1;">
					<div class="row">
						<div class="col">
							<h1 class="vacation_header display-2">
								{{ $tripLocation->trip_location }}
								<a href="/" class="float-right btn btn-lg btn-secondary mt-4 mr-3">Home Page</a>
							</h1>
							@if($tripLocation->flyer_name != "")
								<a href="{{ asset('storage/' . str_ireplace('public/', '', $tripLocation->flyer_name)) }}" class="btn btn-primary" download="{{ str_ireplace(' ', '_', ucwords($tripLocation->trip_location)) . '_Flyer' }}">Download Flyer</a>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="vacationDescription my-4">
								<h2 class="tripDescription">{{ $tripLocation->description != null ? $tripLocation->description : 'No description for the trip has been added yet.' }}</h2>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="vacationItenerary">
											<h2 class="vacationIteneraryHeader text-center">Events For The Trip</h2>
											<ul class="termsItenery list-unstyled text-center">
												@php $getActivities = $tripLocation->activities; @endphp
												@if($getActivities->count() > 0)
													@foreach($getActivities as $showActivity)
														@if($showActivity->show_activity == "Y")
															<li>{{ $showActivity->trip_event . " " . $showActivity->activity_date }}</li>
														@endif
													@endforeach
												@else
													<li>Trip Itenerary not added yet</li>
												@endif
											</ul>
										</div>
									</div>
									<div class="col">
										<div id="" class="vacationCost">
											<h2 class="paymentHeaders text-center">Trip Cost</h2>
											<ul class="termsCost list-unstyled text-center">
												@if($tripLocation->cost != null)
													@php $costOption = explode("; ", $tripLocation->cost); @endphp
													@for($i=0; $i < count($costOption); $i++)
														@if($costOption[$i] != "")
															<li>{{ trim($costOption[$i]) }}</li>
														@endif
													@endfor
												@else
													<li>Trip Itenerary not added yet</li>
												@endif
											</ul>
										</div>
									</div>
									<div class="col">
										<div id="" class="vacationCost">
											<h2 class="paymentHeaders text-center">Payment Options</h2>
											<ul class="termsPayment list-unstyled text-center">
												@if($tripLocation->payments != null)
													@php $paymentOption = explode("; ", $tripLocation->payments); @endphp
													@for($i=0; $i < count($paymentOption); $i++)
														@if($paymentOption[$i] != "")
															<li>{{ trim($paymentOption[$i]) }}</li>
														@endif
													@endfor
												@else	
													<li>Trip Payment schedule not added yet</li>
												@endif
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="container">
								<div class="row">
									<div class="col">
										<div id="page_terms_and_conditions">
											@php 
												$depositDate = explode('-', $tripLocation->deposit_date);
											@endphp
											<p class="terms depositDate text-center" id="">Deposit is Due No Later Than <span class="text-warning">{{ $tripLocation->deposit_date!= null ? $depositDate[1] . "/" . $depositDate[2] . "/" . $depositDate[0] : 'TBA' }}</span></p>
										</div>
									</div>
									<div class="col">
										<div id="page_terms_and_conditions">
											@php
												$dueDate = explode('-', $tripLocation->due_date);
											@endphp
											<p class="terms balanceDueDate text-center" id="">Total Balance Must Be Paid In Full <span class="text-warning">{{ $tripLocation->due_date != null ? $dueDate[1] . "/" . $dueDate[2] . "/" . $dueDate[0] : 'TBA' }}</span></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@if($tripLocation->conditions != null)
						@php $conditionOption = explode("; ", $tripLocation->conditions); @endphp
						<div class="row w-75 mx-auto progress-bar progress-bar-striped bg-warning py-5 rounded">
							<div class="col-12">
								<h2 class="text-center">Terms and Conditions</h2>
							</div>
							<div class="col">
								@for($i=0; $i < count($conditionOption); $i++)
									@if($conditionOption[$i] != null)
										<p class="terms">{{ trim($conditionOption[$i]) }}</p>
									@endif
								@endfor
							</div>
						</div>
					@endif
				</div>
				<div class="divider"></div>
				<div class="container-fluid position-relative pt-2 pb-4 mt-5" style="z-index:1;">
					<div class="row">
						<div class="page_signup_form col-3 py-1">
							<h3 class="text-center text-light">Sign Me Up</h3>
							<form class="signupForm" id="" action="/participants" method="POST" enctype="multipart/form-data">
							
								{{ method_field('POST') }}
								{{ csrf_field() }}
							
								<table class="table">
									<tr>
										<td>
											<div class="form-group">
												<label for="first_name" class="text-light">First Name:</label>
												<input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" />
												
												@if($errors->has('first_name'))
													<span class="text-danger">First name cannot empty or more than 50 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label for="last_name" class="text-light">Last Name:</label>
												<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" />
												
												@if ($errors->has('last_name'))
													<span class="text-danger">Last name cannot empty or more than 50 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label for="email" class="text-light">Email:</label>
												<input class="form-control" type="email" name="email" value="{{ old('email') }}" />
												
												@if($errors->has('email'))
													<span class="text-danger">Email address cannot empty or more than 100 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2"><input type="submit" name="submit" class="pageSubmit btn btn-success" value="Send Me Info" /></td>
									</tr>
								</table>
								<input type="text" name="trip_id" class="" value="{{ $tripLocation->id }}" hidden />
								<div class="paymentInstructions text-light">
									<p class="m-0 py-3">For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family. <a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
								</div>
							</form>	
						</div>
						<div class="pageConfirmationTable col-6 py-1">
							@php $getEventUsers = $tripLocation->participants; @endphp
							<div class="">
								<h3 class="text-center text-light">See Who's Already Going</h3>
								<table class="table table-striped table-dark table-hover text-center">
									@if($getEventUsers->count() >= 1)
										<tr>
											<th>First</th>
											<th>Last</th>
										</tr>
										@foreach($getEventUsers as $user)
											<tr>
												<td>{{ $user->first_name }}</td>
												<td>{{ $user->last_name }}</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="2" class="text-light">No users have signed up for the trip yet</td>
										</tr>
									@endif
								</table>
							</div>
						</div>
					</div>
					<div id="loading_image">
						<img src="/images/ajax-loader (1).gif">
					</div>
				</div>
			</div>
		</div>
		
		<!-- Mobile version -->
		<div class="d-xl-none">
			<div class="showTripMobile" style="">
			
			@include('layouts.mobile_nav')
				
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 pt-2 pb-4" style="background: linear-gradient(rgb(242, 242, 242), rgb(242, 242, 242), rgb(242, 242, 242), rgba(0, 0, 0, 0))">
							<h2 class="tripDescription text-center">{{ $tripLocation->trip_location }}</h2>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="vacationDescription mt-5">
								<h2 class="tripDescription pt-3">{{ $tripLocation->description != null ? $tripLocation->description : 'No description for the trip has been added yet.' }}</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col d-flex full-height align-items-center justify-content-center flex-column mobileLocationFlexShow">
							<h2 class="paymentHeaders text-left align-self-start">Events</h2>
							<ul class="termsItenery list-unstyled text-center">
								@php $getActivities = $tripLocation->activities; @endphp
								@if($getActivities->count() > 0)
									@foreach($getActivities as $showActivity)
										@if($showActivity->show_activity == "Y")
											<li>{{ $showActivity->trip_event . " " . $showActivity->activity_date }}</li>
										@endif
									@endforeach
								@else
									<li>Trip Itenerary not added yet</li>
								@endif
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col d-flex full-height align-items-center justify-content-center flex-column mobileLocationFlexShow">
							<h2 class="paymentHeaders text-left align-self-start">Trip Cost</h2>
							<ul class="termsCost list-unstyled text-center">
								@if($tripLocation->cost != null)
									@php $costOption = explode("; ", $tripLocation->cost); @endphp
									@for($i=0; $i < count($costOption); $i++)
										@if($costOption[$i] != "")
											<li>{{ trim($costOption[$i]) }}</li>
										@endif
									@endfor
								@else
									<li>Trip Itenerary not added yet</li>
								@endif
							</ul>
							<ul class="termsPayment list-unstyled text-center">
								@if($tripLocation->payments != null)
									@php $paymentOption = explode("; ", $tripLocation->payments); @endphp
									@for($i=0; $i < count($paymentOption); $i++)
										@if($paymentOption[$i] != "")
											<li>{{ trim($paymentOption[$i]) }}</li>
										@endif
									@endfor
								@else	
									<li>Trip Payment schedule not added yet</li>
								@endif
								@php 
									$depositDate = explode('-', $tripLocation->deposit_date); 
									$dueDate = explode('-', $tripLocation->due_date);
								@endphp
								<li class="text-center" id="">Deposit is Due No Later Than <span class="">{{ $tripLocation->deposit_date!= null ? $depositDate[1] . "/" . $depositDate[2] . "/" . $depositDate[0] : 'TBA' }}</span></li>
								<li class="text-center" id="">Total Balance Must Be Paid In Full <span class="">{{ $tripLocation->due_date != null ? $dueDate[1] . "/" . $dueDate[2] . "/" . $dueDate[0] : 'TBA' }}</span></li>
							</ul>
						</div>
					</div>
					<div class="row full-height align-items-center justify-content-center">
						<div class="col d-flex full-height align-items-center justify-content-center flex-column">
							<h3 class="text-center text-light">Sign Me Up</h3>
							<form class="signupForm" id="" action="/participants" method="POST" enctype="multipart/form-data">
							
								{{ method_field('POST') }}
								{{ csrf_field() }}
							
								<table class="table">
									<tr>
										<td>
											<div class="form-group">
												<label for="first_name" class="text-light">First Name:</label>
												<input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" />
												
												@if($errors->has('first_name'))
													<span class="text-danger">First name cannot empty or more than 50 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label for="last_name" class="text-light">Last Name:</label>
												<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" />
												
												@if ($errors->has('last_name'))
													<span class="text-danger">Last name cannot empty or more than 50 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label for="email" class="text-light">Email:</label>
												<input class="form-control" type="email" name="email" value="{{ old('email') }}" />
												
												@if($errors->has('email'))
													<span class="text-danger">Email address cannot empty or more than 100 characters</span>
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2"><input type="submit" name="submit" class="pageSubmit btn btn-success" value="Send Me Info" /></td>
									</tr>
								</table>
								<input type="text" name="trip_id" class="" value="{{ $tripLocation->id }}" hidden />
								<div class="paymentInstructions text-light">
									<p class="m-0 py-3">For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family. <a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
								</div>
							</form>	
						</div>
					</div>
					<div class="row">
						<div class="col">
							<button class="btn btn-info round mb-3 mx-auto d-block" type="button" data-toggle="collapse" data-target="#signed_up" aria-expanded="false" aria-controls="signed_up">See Who's Already Going</button>
							
							<div class="collapse" id="signed_up">
								<table class="table table-striped table-dark table-hover text-center">
									@if($getEventUsers->count() >= 1)
										<tr>
											<th>First</th>
											<th>Last</th>
										</tr>
										@foreach($getEventUsers as $user)
											<tr>
												<td>{{ $user->first_name }}</td>
												<td>{{ $user->last_name }}</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="2" class="text-light">No users have signed up for the trip yet</td>
										</tr>
									@endif
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection