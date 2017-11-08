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
		<div id="home_page" class="container-fluid">
			<div class="row">
				<div class="col-2 col-sm-2 pictures_east_and_west_btns">
					<p>Check out some of the pictures from where we've been. Click on the location of the pictures you want to see.</p>
					@foreach($trips as $trip)
						@if($trip->show_trip == "Y")
							<div class="">
								<button id="pictures_{{ $trip->id }}" class="pictureButton" onclick="getPictures({{ $trip->id }})">{{ $trip->trip_location }}</button>
							</div>
						@endif
					@endforeach
				</div>
				<div id="main_content" class="col-8 col-sm-8 main_content_class">	
					<div id="header">
						<p>East Coast West Coast Travel</p>
					</div>
					@if($activeTrips->count() > 0)
						<div class="upcomingVacations">
							<div class="upcomingVacationsHeader">
								<h3 class="">---- Upcoming Vacations ----</h3>
							</div>
							@foreach($activeTrips as $trip)
								@php $tripsActivities = $trip->activities; @endphp
								<div id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_link' }}" class="whats_next_w upcomingTrip">	
									<div class="individualEvent eventDiv" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background:url({{ $trip->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }})">
										<a href="/location/{{ $trip->id }}" class="w-100">
											<p class="event_header">{{ ucwords($trip->trip_location) }}</p>
											<p class="event_date">{{ $trip->trip_month . " ". $trip->trip_year }}</p>
											<p class="more_info">Click for more information</p>

											@if($tripsActivities->count() > 0)
												<table class="west_calendar">
													<tr>
														<th class="header_data" id="date_data">Date</th>
														<th class="header_data" id="middle_th_data">Location</th>
														<th class="header_data" id="event_data">Event</th>
													</tr>
													
													@foreach($tripsActivities as $activity)
														@if($activity->show_activity == "Y")									
															<tr>
																<td>{{ $activity->activity_date }}</td>
																<td class="middle_data">{{ $activity->activity_location }}</td>
																<td>{{ $activity->trip_event }}</td>
															</tr>
														@endif	
													@endforeach
												</table>
											@endif
										</a>
									</div>
								</div>
							@endforeach
						</div>
					@endif
					@if($inactiveTrips->count() > 0)
						<div class="pastVacations">
							<div class="upcomingVacationsHeader">
								<h3 class="">---- Completed Vacations ----</h3>
							</div>
							@foreach($inactiveTrips as $trip)
								@php $tripsActivities = $trip->activities; @endphp
								<div id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_link"; ?>" class="whats_next_w">
									<div class="individualEvent eventDiv" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background-image:url({{ $trip->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }})">
										<a href="#" class="w-100"  onclick="getPictures({{ $trip->id }})">
											<p class="event_header">{{ ucwords($trip->trip_location) }}</p>
											<p class="event_date">{{ $trip->trip_month . " ". $trip->trip_year }}</p>
											<p class="more_info">Click to view photos</p>

											@if($tripsActivities->count() > 0)
												<table class="west_calendar">
													<tr>
														<th class="header_data" id="date_data">Date</th>
														<th class="header_data" id="middle_th_data">Location</th>
														<th class="header_data" id="event_data">Event</th>
													</tr>
													
													@foreach($tripsActivities as $activity)
														@if($activity->show_activity == "Y")									
															<tr>
																<td>{{ $activity->activity_date }}</td>
																<td class="middle_data">{{ $activity->activity_location }}</td>
																<td>{{ $activity->trip_event }}</td>
															</tr>
														@endif
													@endforeach
												</table>
											@endif
										</a>
									</div>
								</div>
							@endforeach
						</div>
					@endif
				</div>
				<div id="" class="col-2 col-sm-2" style="position:fixed; right:0;">
					<div class="actionBtnDiv d-flex flex-column justify-content-center">
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="#" id="home_btn" class="btn btn-lg actionBtns text-dark py-3" disabled>Home</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<button id="question_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target="#questionModal">Ask A Question</button>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a id="suggestion_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target="#suggestionModal">Suggestions</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns text-dark py-3">Contact Us</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns text-dark py-3">About Us</a>
						</div>
						<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
							<a href="{{ route('login') }}" id="admin_page_btn" class="btn btn-lg actionBtns text-dark py-3">Admin</a>
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