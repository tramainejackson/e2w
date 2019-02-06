@extends('layouts.app')
	@section('styles')
		<style>
			/*Smartphones portrait*/
			@media only screen and (max-width:1024px) {
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

	@section('content')

		<div class="showTrip d-none d-xl-flex col-12 px-0" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $tripLocation->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $tripLocation->trip_photo)) : '/images/skyline.jpg' }})">

			<div class="col rgba-stylish-strong">

				<div class="container-fluid text-light position-relative" style="z-index:1;">

					<div class="row">

						<div class="col">

                            <h1 class="text-center display-2 locationName">{{ $tripLocation->trip_location }}</h1>

                            {{--Display is absolute--}}
							@if($tripLocation->flyer_name != "")
								<a href="{{ asset('storage/' . str_ireplace('public/', '', $tripLocation->flyer_name)) }}" class="btn btn-primary locationFlyer position-absolute" download="{{ str_ireplace(' ', '_', ucwords($tripLocation->trip_location)) . '_Flyer' }}" style="top:20px;">Download Flyer</a>
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

                            <div class="vacationItenerary">
                                <h2 class="vacationIteneraryHeader text-center">Events For The Trip</h2>
                                <ul class="termsItenery list-unstyled text-center">

                                    @if($tripLocation->activities->count() > 0)

                                        @foreach($tripLocation->activities as $showActivity)
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

                                    @if($tripLocation->costs->package != null)
                                        <li>{{ $tripLocation->costs->package }}</li>
                                    @elseif($tripLocation->costs->per_adult != null ||
                                        $tripLocation->costs->per_child != null ||
                                        $tripLocation->costs->single_occupancy != null ||
                                        $tripLocation->costs->double_occupancy != null ||
                                        $tripLocation->costs->triple_occupancy != null)
                                        <li>{{ $tripLocation->costs->per_adult }}</li>
                                        <li>{{ $tripLocation->costs->per_child }}</li>
                                        <li>{{ $tripLocation->costs->single_occupancy }}</li>
                                        <li>{{ $tripLocation->costs->double_occupancy }}</li>
                                        <li>{{ $tripLocation->costs->triple_occupancy }}</li>
                                    @else
                                        <li>Trip costs not added yet</li>
                                    @endif

                                </ul>
                            </div>

                        </div>

                        <div class="col">

                            <div id="" class="vacationCost">
                                <h2 class="paymentHeaders text-center">Payment Options</h2>
                                <ul class="termsPayment list-unstyled text-center">
                                    @if($tripLocation->payment_options != null)

                                        @foreach($tripLocation->payment_options as $payment_option)
                                            <li>{{ $payment_option->payment_description }}</li>
                                        @endforeach

                                    @else
                                        <li>Trip Payment schedule not added yet</li>
                                    @endif
                                </ul>
                            </div>

                        </div>

					</div>

					<div class="row">

						<div class="col">

							<div class="container">

								<div class="row">

									<div class="col">
										<div id="page_terms_and_conditions">
											<p class="terms depositDate text-center" id="">Deposit is Due No Later Than <span class="text-warning">{{ $tripLocation->deposit_date != null ? $tripLocation->deposit_date->format('m/d/Y') : 'TBA' }}</span></p>
										</div>
									</div>

									<div class="col">
										<div id="page_terms_and_conditions">
											<p class="terms balanceDueDate text-center" id="">Total Balance Must Be Paid In Full <span class="text-warning">{{ $tripLocation->due_date != null ? $tripLocation->due_date->format('m/d/Y') : 'TBA' }}</span></p>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					@if($tripLocation->conditions != null)

						<div class="row mx-auto progress-bar progress-bar-striped bg-light black-text py-5 rounded">

							<div class="col-12">
								<h2 class="text-center">Terms and Conditions</h2>
							</div>

							<div class="col-12">

								@if($tripLocation->conditions->isNotEmpty())

									@foreach($tripLocation->conditions as $conditionOption)
										<p class="terms">{{ $conditionOption->description }}</p>
									@endforeach

								@else
									<p class="terms">Terms and Conditions not added yet</p>
								@endif

							</div>

						</div>

					@endif

				</div>
				
				<!-- Add a divider/spacer -->
				<div class="divider"></div>
				
				<!-- Sign up for this trip form -->
				<div class="container-fluid position-relative pt-2 pb-4 mt-5" style="z-index:1;">
					<div class="row">

						<div class="page_signup_form col-4 py-1 mx-auto">

							<h3 class="text-center text-light">Sign Me Up</h3>

							<form class="signupForm" id="" action="/participants" method="POST" enctype="multipart/form-data">
							
								{{ method_field('POST') }}
								{{ csrf_field() }}
							
								<table class="table">

									<tr>
										<td>
											<div class="form-group">
												<label for="first_name" class="text-light">First Name:</label>
												<input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" />
												
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
												<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
												
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
												<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" />
												
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
				</div>
			</div>
		</div>
		
		<!-- Mobile version -->
		<div class="d-xl-none">
			<div class="showTripMobile" style="">
			
			@include('layouts.mobile_nav')
				
				<div class="container-fluid" style="font-size:150%;">
					<div class="row">
						<div class="col-12 pt-2 pb-4" style="background: linear-gradient(rgb(242, 242, 242), rgb(242, 242, 242), rgb(242, 242, 242), rgba(0, 0, 0, 0))">
							<h2 class="tripDescription text-center">{{ $tripLocation->trip_location }}</h2>
						</div>
					</div>
					<div class="row">
						<div class="col d-flex full-height align-items-center justify-content-center flex-column mobileLocationFlexShow">
							<h2 class="paymentHeaders text-left align-self-start">Description</h2>
							<p class="text-center">{{ $tripLocation->description != null ? $tripLocation->description : 'No description for the trip has been added yet.' }}</p>
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

							<form class="signupForm w-100" id="" action="/participants" method="POST" enctype="multipart/form-data">
							
								{{ method_field('POST') }}
								{{ csrf_field() }}
							
								<table class="table">

									<tr>
										<td>
											<div class="form-group">
												<label for="first_name" class="text-light">First Name:</label>
												<input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" />
												
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
												<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
												
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
												<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" />
												
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

							</form>

							<div class="paymentInstructions text-light">
								<p class="m-0 py-3">For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family. <a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
	@endsection