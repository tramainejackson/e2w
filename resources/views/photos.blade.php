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

	@section('content')
			
		<div class="col-12 white-text text-center m-0 p-5 d-xl-none">
			<h2 class="" style=" font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Trip Photos</b></h2>
		</div>

		<div class="col-12 underline d-none d-xl-block p-5 text-center">
			<h2 class="display-3">Trip Photos</h2>
		</div>

		<div class="col-12">

			<div class="container-fluid">

				<div class="row">

					@foreach($trips as $trip)

						@php $content1 = Storage::disk('local')->has($trip->trip_photo); @endphp
						@php $getPictures = $trip->pictures; @endphp

						<div class="col-12 col-sm-6 col-lg-3">

							<div class="card my-2">

								<img src="{{ $content1 == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}" class="card-img-top" href="" aria-expanded="false" />

								<div class="card-header" role="tab" id="">
									<h5 class="mb-0">
										<a class="" href="/pictures/{{ $trip->id }}" aria-expanded="false">{{ $trip->trip_location }}</a>
									</h5>
								</div>

								{{--<div class="card-body">--}}

									{{--<div class="row location_photos">--}}

										{{--<div class="col-auto" id="">--}}

											{{--@foreach($getPictures as $picture)--}}
												{{--@php $content = Storage::disk('local')->has($picture->picture_name); @endphp--}}

												{{--<figure class="col-md-4">--}}
													{{--<!--Large image-->--}}
													{{--<a href="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="col-6" title="{{ $picture->picture_caption }}" data-size="1600x{{ $picture->lg_height }}">--}}
														{{--<!-- Thumbnail-->--}}
														{{--<img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="img-thumbnail" />--}}
													{{--</a>--}}
												{{--</figure>--}}

											{{--@endforeach--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}

								<div class="card-footer">
									<p class="text-muted"> Total Pictures: <i>{{ $getPictures->count() }}</i></p>
								</div>

							</div>

						</div>

					@endforeach

				</div>

			</div>

		</div>

	@endsection