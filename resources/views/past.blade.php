@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="home_page" class="container-fluid">
			<div class="row d-xl-none">
				@include('layouts.mobile_nav')
				
				<div id="carousel_controls" class="carousel slide w-100" data-ride="carousel">	
					<div class="carousel-inner">
						@if($inactiveTrips->count() > 0)
							@foreach($inactiveTrips as $trip)
								@php $content = Storage::disk('local')->has($trip->trip_photo); @endphp
								@php $tripsActivities = $trip->activities; @endphp
								
								<div id="" class="carousel-item{{ $loop->first ? ' active' : ''}}">	
									<div class="carouselImage" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background:linear-gradient(#f2f2f2, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url({{ $content == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }});">
										<div class="carousel-caption">
											<h1 class="center white-text" style="margin-top: 0; padding-top: 50px;">{{ ucwords($trip->trip_location) }}</h1>
											<h3 class="center white-text">{{ $trip->trip_month . " ". $trip->trip_year }}</h3>

											@if($tripsActivities->count() > 0)
												<table class="table table-hover">
													<thead class="thead-dark">
														<tr>
															<th>Date</th>
															<th>Location</th>
															<th>Event</th>
														</tr>
													<thead>
													
													<tbody>
														@foreach($tripsActivities as $activity)
															@if($activity->show_activity == "Y")									
																<tr>
																	<td>{{ $activity->activity_date }}</td>
																	<td>{{ $activity->activity_location }}</td>
																	<td>{{ $activity->trip_event }}</td>
																</tr>
															@endif
														@endforeach
													<tbody>
												</table>
											@else
												<div class="container">
													<div class="row">
														<div class="col">
															<p class="">No activities were added for this trip</p>
														</div>
													</div>
												</div>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
					<a class="carousel-control-prev" href="#carousel_controls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel_controls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	@endsection