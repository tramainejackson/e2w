@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div class="showTrip" style="background-image:url(/images/{{ $tripLocation->trip_photo != '' ? $tripLocation->trip_photo : 'skyline.jpg' }})">
			<div class="container-fluid text-light position-relative" style="z-index:1;">
				<div class="row">
					<div class="col">
						<h1 class="vacation_header display-2">{{ $tripLocation->trip_location }}</h1>
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
										<p class="terms depositDate text-center" id="">Deposit is Due No Later Than <span class="text-warning">{{ $tripLocation->deposit_date != null ? $tripLocation->deposit_date : 'TBA' }}</span></p>
									</div>
								</div>
								<div class="col">
									<div id="page_terms_and_conditions">
										<p class="terms balanceDueDate text-center" id="">Total Balance Must Be Paid In Full <span class="text-warning">{{ $tripLocation->due_date != null ? $tripLocation->due_date : 'TBA' }}</span></p>
										@if($tripLocation->conditions != null)
											@php $conditionOption = explode("; ", $tripLocation->conditions); @endphp
											@for($i=0; $i < count($conditionOption); $i++)
												@if($conditionOption[$i] != null)
													<p class="terms">{{ trim($conditionOption[$i]) }}</p>
												@endif
											@endfor
										@endif
										@if($tripLocation->flyer_name != "") { ?>
											<p class="terms"><a href="../files/{{ $tripLocation->flyer_name }}" title="Click here to open the Flyer" target="_blank">Click Here For A Printable Flyer</a></p>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="divider"></div>
			<div class="container-fluid position-relative pt-2 pb-4 mt-5" style="z-index:1;">
				<div class="row">
					<div class="page_signup_form col-3 py-1">
						<h3 class="text-center text-light">Sign Up</h3>
						<form class="signupForm" id="" action="user_signup.php" method="POST" enctype="multipart/form-data">
							<table class="formTable">
								<tr>
									<td><label for="first_name" class="text-light"><strong>First Name:</strong></label></td>
									<td><input class="first_name_input rounded" type="text" name="first_name" /></td>
								</tr>
								<tr>
									<td><label for="last_name" class="text-light"><strong>Last Name:</strong></label></td>
									<td><input class="last_name_input rounded" type="text" name="last_name" /></td>
								</tr>
								<tr>
									<td><label for="email" class="text-light"><strong>Email:</strong></label></td>
									<td><input class="email_input rounded" type="email" name="email" /></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" class="pageSubmit" value="Send Me Info" /></td>
								</tr>
							</table>
							<input type="text" name="trip_id" class="" value="{{ $tripLocation->trip_id }}" hidden />
							<div class="paymentInstructions text-light">
								<p class="m-0 py-3">For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family. <a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
							</div>
						</form>	
					</div>
					<div class="pageConfirmationTable col-6 py-1">
						@php $getEventUsers = $tripLocation->participants; @endphp
						<div class="tripUsers">
							<h3 class="text-center text-light">See Who's Already Going</h3>
							<table>
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
										<td colspan="2">No users have signed up for the trip yet</td>
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
	@endsection