@extends('layouts.app')
	@section('styles')
		<!-- Bootstrap core CSS -->
		<link href="/css/app.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="/css/e2w_2.css" rel="stylesheet">
	@endsection
	
	@section('scripts')
		<!-- Bootstrap core JS -->
		<script src="/js/app.js"></script>
		<script src="/js/eastwest_2.js"></script>
	@endsection

	@section('content')
			<div id="home_page" class="container-fluid">
				<div class="row">
					<div class="col-2 col-sm-2 pictures_east_and_west_btns">
						<p>Check out some of the pictures from where we've been. Click on the location of the pictures you want to see.</p>
						@foreach($trips as $trip)
							@if($trip->show_trip == "Y")
								<div class="picturesBtnLinks">
									<a href="index.php?view_gallery=<?php echo strtolower(str_ireplace(" ", "_", $trip->trip_location)); ?>" id="<?php echo strtolower(str_ireplace(" ", "_", $trip->trip_location)); ?>" class="pictureButton"><?php echo $trip->trip_location; ?></a>
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
									<div id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_link"; ?>" class="whats_next_w upcomingTrip">	
										<div class="individualEvent eventDiv" id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_event"; ?>" style="background-image:url(images/<?php echo $trip->trip_photo != "" ? $trip->trip_photo : "skyline.jpg"; ?>);">
											<a href="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . $trip->trip_year; ?>.php">
												<p class="event_header"><?php echo ucwords($trip->trip_location); ?></p>
												<p class="event_date"><?php echo $trip->trip_month . " ". $trip->trip_year; ?></p>
												<p class="more_info">Click for more information</p>
												<table class="west_calendar">
													<tr>
														<th class="header_data" id="date_data">Date</th>
														<th class="header_data" id="middle_th_data">Location</th>
														<th class="header_data" id="event_data">Event</th>
													</tr>
													@php $tripsActivities = App\TripActivities::where('trip_id', $trip->id)->get(); @endphp
													@if($tripsActivities->count() > 0)
														@foreach($tripsActivities as $activity)
															@if($activity->show_activity == "Y")									
																<tr>
																	<td><?php echo $activity->activity_date; ?></td>
																	<td class="middle_data"><?php echo $activity->activity_location; ?></td>
																	<td><?php echo $activity->trip_event; ?></td>
																</tr>
															@endif	
														@endforeach
													@else
														<tr>
															<td colspan="3">No Actitivies Added For This Trip Yet</td>
														</tr>
													@endif
												</table>
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
									<div id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_link"; ?>" class="whats_next_w">
										<div class="individualEvent eventDiv" id="<?php echo str_ireplace(" ", "_", strtolower($trip->trip_location)) . "_event"; ?>" style="background-image:url(images/<?php echo $trip->trip_photo; ?>);">
											<a href="index.php?view_gallery=<?php echo strtolower(str_ireplace(" ", "_", $trip->trip_location)); ?>">
												<p class="event_header"><?php echo ucwords($trip->trip_location); ?></p>
												<p class="event_date"><?php echo $trip->trip_month . " ". $trip->trip_year; ?></p>
												<p class="more_info">Click for more information</p>
												<table class="west_calendar">
													<tr>
														<th class="header_data" id="date_data">Date</th>
														<th class="header_data" id="middle_th_data">Location</th>
														<th class="header_data" id="event_data">Event</th>
													</tr>
													@php $tripsActivities = App\TripActivities::where('trip_id', $trip->id)->get(); @endphp
													@if($tripsActivities->count() > 0)
														@foreach($tripsActivities as $activity)
															@if($activity->show_activity == "Y")									
																<tr>
																	<td><?php echo $activity->activity_date; ?></td>
																	<td class="middle_data"><?php echo $activity->activity_location; ?></td>
																	<td><?php echo $activity->trip_event; ?></td>
																</tr>
															@endif
														@endforeach
													@else
														<tr>
															<td colspan="3">No Actitivies Added For This Trip Yet</td>
														</tr>
													@endif
												</table>
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
								<a id="home_btn" class="btn btn-lg actionBtns py-3" disabled>Home</a>
							</div>
							<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
								<a id="question_btn" class="btn btn-lg actionBtns py-3">Ask A Question</a>
							</div>
							<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
								<a id="suggestion_btn" class="btn btn-lg actionBtns py-3">Suggestions</a>
							</div>
							<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
								<a id="contact_us_btn" class="btn btn-lg actionBtns py-3">Contact Us</a>
							</div>
							<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
								<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns py-3">About Us</a>
							</div>
							<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
								<a id="admin_page_btn" class="btn btn-lg actionBtns py-3">Admin</a>
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