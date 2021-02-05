@extends('layouts.app')

	@if($activeTrips->count() < 1)
		@section('styles')
			<style type="text/css">
				.navbar, .top-nav-collapse {
					background-color: #4285f4;
				}
			</style>
		@endsection
	@endif

	@section('content')

		<div class="col-12 px-0{{ $activeTrips->count() < 1 ? ' mt-5' : '' }}" id="">

			@if($activeTrips->count() > 0)

				<div id="home_carousel" class="carousel slide carousel-fade full-height" data-ride="carousel" data-interval="false">

					<!--Indicators-->
					<ol class="carousel-indicators">

						@for($x=0; $x < $activeTrips->count(); $x++)

							<li data-target="#home_carousel" data-slide-to="{{ $x }}" class="active"></li>

						@endfor
					</ol>
					<!--/.Indicators-->

					<div class="carousel-inner full-height" role="listbox">

						@foreach($activeTrips as $trip)

							@php $tripMonth = DB::table('vacation_month')->select('month_name')->where('month_id', $trip->trip_month)->first(); @endphp

							<div class="carousel-item{{ $loop->first ? ' active' : '' }}" style="background-image: url('{{ $trip->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
								<!--Mask-->
								<div class="view full-height">
									<div class="full-bg-img flex-center mask rgba-stylish-strong white-text">

										<ul class="animated fadeInUp col-md-12 list-unstyled list-inline">
											<li>
												<h1 class="font-weight-bold text-uppercase display-3">{{ ucwords($trip->trip_location) }}</h1>
											</li>
											<li>
												<h1 class="font-weight-bold text-uppercase py-4 h1">{{ $tripMonth->month_name . " ". $trip->trip_year }}</h1>
											</li>
											<li>
												<a href="{{ route('location.show', $trip->id) }}" class="btn btn-primary btn-rounded btn-lg">Click for more information</a>
											</li>
										</ul>
									</div>
								</div>
								<!--/.Mask-->
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
							<div class="col-lg-5{{ $loop->iteration % 2 == 0 ? ' order-0 order-lg-1' : '' }}">

								<!-- Featured image -->
								<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
									<img class="img-fluid" src="{{ Storage::disk('local')->has($trip->trip_photo) ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}" alt="Sample image">
								</div>

							</div>
							<!-- Grid column -->

							<!-- Grid column -->
							<div class="col-lg-7">

								<!-- Post title -->
								<h3 class="font-weight-bold pb-1 mb-0"><strong>{{ ucwords($trip->trip_location) }}</strong></h3>

								<!-- Sub title -->
								<h4 class="font-weight-bold pt-1 mb-3 h4"><strong>{{ ucwords($tripMonth->month_name) . ' ' . $trip->trip_year }}</strong></h4>

								<!-- Excerpt -->
								<p>{{ $trip->description }}</p>

								<!-- Read more button -->
								<a class="btn btn-success btn-md" href="location/{{$trip->id}}">View More</a>

							</div>
							<!-- Grid column -->
						</div>
					@endforeach

					<!-- See All Trips Button -->
					<div class="row">
						<div class="col-12 col-md-6 mx-auto mb-5" id="">
							<a href="#" class="btn btn-lg btn-rounded btn-pink btn-block">See All Trips</a>
						</div>
					</div>
					<!-- See All Trips Button -->
				</div>
			@endif
		</div>
	@endsection