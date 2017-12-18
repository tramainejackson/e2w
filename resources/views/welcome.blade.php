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
			@if(session('status'))
				<h2 class="flashMessage">{{ session('status') }}</h2>
			@endif
			
			<div class="row d-none d-xl-flex">
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
								@php $content = Storage::disk('local')->has($trip->trip_photo); @endphp
								@php $tripsActivities = $trip->activities; @endphp
								<div id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_link' }}" class="whats_next_w upcomingTrip">	
									<div class="individualEvent eventDiv" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background:url({{ $content == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }})">
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
								@php $content = Storage::disk('local')->has($trip->trip_photo); @endphp
								@php $tripsActivities = $trip->activities; @endphp
								<div id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_link"; ?>" class="whats_next_w">
									<div class="individualEvent eventDiv" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background-image:url({{ $content == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }})">
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
					@include('layouts.nav')
				</div>
			</div>
			<div class="row d-xl-none">
				@include('layouts.mobile_nav')
				
				<div id="carousel_controls" class="carousel slide w-100" data-ride="carousel">	
					<div class="carousel-inner">
						@foreach($activeTrips as $trip)
							@php $content = Storage::disk('local')->has($trip->trip_photo); @endphp
							@php $tripsActivities = $trip->activities; @endphp
							
							<div id="" class="carousel-item{{ $loop->first ? ' active' : ''}}">	
								<div class="carouselImage" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background:linear-gradient(#f2f2f2, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url({{ $content == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }});">
									<div class="carousel-caption">
										<h1 class="center white-text" style="margin-top: 0; padding-top: 50px;">{{ ucwords($trip->trip_location) }}</h1>
										<h3 class="center white-text">{{ $trip->trip_month . " ". $trip->trip_year }}</h3>

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
										<div class="carousel-fixed-item center">
											<a href="/location/{{ $trip->id }}" class="btn btn-secondary">Click For More Information</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					@if($activeTrips->count() > 1)
						<a class="carousel-control-next" href="#carousel_controls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<a class="carousel-control-prev" href="#carousel_controls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
					@endif
				</div>
			</div>
		</div>
	@endsection