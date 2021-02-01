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

	@section('scripts')
		<script type="text/javascript">
			if($('#home_carousel').parent().css('display') == 'block') {
                $('.page-footer').addClass('fixed-bottom');
            }
		</script>
	@endsection

	@section('content')

		<div class="col-12 d-none d-xl-block px-0" id="">

			@if($activeTrips->count() > 0)

				<div id="home_carousel" class="carousel slide carousel-fade" data-ride="carousel" style="">

					{{--<div class="upcomingVacationsHeader">--}}
						{{--<h3 class="">---- Upcoming Vacations ----</h3>--}}
					{{--</div>--}}

					<!--Indicators-->
					<ol class="carousel-indicators">

						@for($x=0; $x < $activeTrips->count(); $x++)

							<li data-target="#home_carousel" data-slide-to="{{ $x  }}" class="active"></li>

						@endfor
					</ol>
					<!--/.Indicators-->

					<div class="carousel-inner" role="listbox">

						@foreach($activeTrips as $trip)

							@php $tripMonth = DB::table('vacation_month')->select('month_name')->where('month_id', $trip->trip_month)->first(); @endphp

							<div class="carousel-item{{ $loop->first ? ' active' : '' }}" style="background-image: url({{ Storage::disk('local')->has($trip->trip_photo) ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}); background-repeat: no-repeat; background-size: cover; background-position: center center;">

								<div class="view" style="height:100%;">

									<div class="flex-center mask rgba-stylish-strong white-text text-center">

										<div class="" id="">

											<p class="event_header">{{ ucwords($trip->trip_location) }}</p>

											<p class="event_date">{{ $tripMonth->month_name . " ". $trip->trip_year }}</p>

											<a class="btn btn-info" href="location/{{$trip->id}}">Click for more information</a>

										</div>

									</div>

								</div>

							</div>

						@endforeach

					</div>

					<!--Controls-->
					<a class="carousel-control-prev" href="#home_carousel" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#home_carousel" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
					<!--/.Controls-->

				</div>

			@endif

			@if($inactiveTrips->count() > 0)

				<div class="container">

					<div class="row">
						<div class="col-auto mx-auto" id="">
							<h1 class="display-3 text-center my-5">Where we've been</h1>
						</div>
					</div>


					<div class="row">
						<div class="col-6 mx-auto" id="">
							<p class="text-center mb-5" style="font-size: 24px;">We get around quite a bit and have plenty more destinations in the works. Take a look at some of the places we've already been</p>
						</div>
					</div>

					@foreach($inactiveTrips as $trip)

						@php $tripMonth = DB::table('vacation_month')->select('month_name')->where('month_id', $trip->trip_month)->first(); @endphp

						@if(!$loop->first)
							<hr	class="my-5" />
						@endif

						<div class="row" id=""{{ $loop->last ? ' style=margin-bottom:9em;' : '' }}>
							<!-- Grid column -->
							<div class="col-lg-5{{ $loop->iteration % 2 == 0 ? ' order-1' : '' }}">

								<!-- Featured image -->
								<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
									<img class="img-fluid" src="{{ Storage::disk('local')->has($trip->trip_photo) ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}" alt="Sample image">
								</div>

							</div>
							<!-- Grid column -->

							<!-- Grid column -->
							<div class="col-lg-7">

								<!-- Post title -->
								<h3 class="font-weight-bold mb-3"><strong>{{ ucwords($trip->trip_location) }}</strong></h3>

								<!-- Excerpt -->
								<p>{{ $trip->description }}</p>

								<!-- Read more button -->
								<a class="btn btn-success btn-md" href="location/{{$trip->id}}">View More</a>

							</div>
							<!-- Grid column -->
						</div>

					@endforeach

				</div>

			@endif

		</div>

		<div class="col-12 px-0 d-xl-none">

			@if($activeTrips->count() > 0)

				<div id="carousel_controls" class="mobileCarousel carousel slide w-100" data-ride="carousel">

					<div class="carousel-inner">

						@foreach($activeTrips as $trip)

							@php $content = Storage::disk('local')->has($trip->trip_photo); @endphp
							@php $tripsActivities = $trip->activities; @endphp
							@php
								$tripMonth = DB::table('vacation_month')->select('month_name')->where('month_id', $trip->trip_month)->first();
							@endphp

							<div id="" class="carousel-item{{ $loop->first ? ' active' : ''}}">

								<div class="carouselImage" id="{{ str_ireplace(' ', '_', strtolower($trip->trip_location)) . '_event' }}" style="background:linear-gradient(#f2f2f2, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url({{ $content == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }});">

									<div class="d-flex align-items-center justify-content-center flex-column">

										<h1 class="text-center" style="margin-top: 0; padding-top: 50px;">{{ ucwords($trip->trip_location) }}</h1>
										<h3 class="text-center">{{ $tripMonth->month_name . " ". $trip->trip_year }}</h3>

										<p class="text-justify carouselTripDescription">{{ $trip->description }}</p>

										<div class="carousel-fixed-item mx-auto d-block pb-2">
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

			@else

				<div class="white text-black p-3 m-3 rounded">

					<h4 class="container p-2 h4">Thanks for checking in with us. We don't currently have any upcoming vacations but continue
						to check back because we can't sit still and will have something soon. In the meantime, feel free to check
						out where we've been, our photos, or contact us with anything you want to share with us.
					</h4>
				</div>

				<div class="row justify-content-around my-3" id="">

					<a href="/past" class="btn default-color col-5">Past Vacations</a>
					<a href="/photos" class="btn default-color col-5">Photos</a>
					<a href="/about_us" class="btn default-color col-5">About Us</a>
					<a href="/contact_us" class="btn default-color col-5">Contact Us</a>

				</div>

			@endif

		</div>

	@endsection