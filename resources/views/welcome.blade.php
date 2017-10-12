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
	@endsection

	@section('content')
			<div id="home_page" class="container-fluid">
				<div class="pictures_east_and_west_btns">
					<p>Check out some of the pictures from where we've been. Click on the location of the pictures you want to see.</p>
					@foreach($trips as $trip)
						@if($trip->show_trip == "Y")
							<div class="picturesBtnLinks">
								<a href="index.php?view_gallery=<?php echo strtolower(str_ireplace(" ", "_", $trip->trip_location)); ?>" id="<?php echo strtolower(str_ireplace(" ", "_", $trip->trip_location)); ?>" class="pictureButton"><?php echo $trip->trip_location; ?></a>
							</div>
						@endif
					@endforeach
				</div>
				<div class="row">
					<div id="main_content" class="col main_content_class">	
						<div id="header">
							<p>East Coast West Coast Travel</p>
						</div>
						<div id="action_btns">
							<button id="home_btn" class="actionBtns" disabled>Home</button>
							<button id="question_btn" class="actionBtns">Ask A Question</button>
							<button id="suggestion_btn" class="actionBtns">Suggestions</button>
							<button id="contact_us_btn" class="actionBtns">Contact Us</button>
							<button id="about_us_btn" class="actionBtns">About Us</button>
							<button id="admin_page_btn" class="actionBtns">Admin</button>
						</div>
						<div id="mobile_action_btns">
							<div class="mobileMenuBtn">
								<a href="#" class="mobileMenuLink">Menu</a>
								<img src="images/menu.png" class="menuImg" />
							</div>
							<div class="mobileBtns">
								<button id="home_btn_mobile" class="actionBtnsMobile">Home</button>
								<button id="question_btn_mobile" class="actionBtnsMobile">Ask A Question</button>
								<button id="suggestion_btn_mobile" class="actionBtnsMobile">Suggestion</button>
								<button id="contact_us_btn_mobile" class="actionBtnsMobile">Contact Us</button>
								<button id="about_us_btn_mobile" class="actionBtnsMobile">About Us</button>
								<button id="photos_btn_mobile" class="actionBtnsMobile">Photos</button>
							</div>
						</div>
						<div class="upcomingVacationsHeader">
							<h3 class="">---- Upcoming Vacations ----</h3>
						</div>
						@foreach($trips as $trip)
							@if($trip->show_trip == "Y" && $trip->trip_complete == "N")
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
							@elseif($trip->show_trip == "Y" && $trip->trip_complete == "Y")
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
							@endif
						@endforeach
					</div>
					
				</div>
			</div>
	@endsection