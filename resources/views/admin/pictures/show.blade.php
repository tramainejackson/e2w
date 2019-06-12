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

			.display-2 {
				color: whitesmoke;
			}
		}
	</style>
@endsection

@section('content')

	@if($getPictures->count() > 0)

		<div class="col-12 mt-5 mb-2">
			<h1 class="h1 display-2 d-inline-block pr-3" style="border-right: solid; border-bottom: solid; font-family: 'Playfair Display', serif;">{{ $trip->trip_location }} Photos</h1>
		</div>

		<div class="col-12">

			<div class="container">

				<div class="row">

					@php $content1 = Storage::disk('local')->has($trip->trip_photo); @endphp
					@php $getPictures = $trip->pictures; @endphp

					<div class="col-12">

						<div id="mdb-lightbox-ui"></div>

						<div class="mdb-lightbox no-margin">

							@foreach($getPictures as $picture)

								@php $content = Storage::disk('local')->has($picture->picture_name); @endphp

								<figure class="col-md-4">

									<!--Large image-->
									<a href="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="" title="{{ $picture->picture_caption }}" data-size="1600x{{ $picture->lg_height }}">

										<!-- Thumbnail-->
										<img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="img-thumbnail" />
									</a>
								</figure>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr>

		<div class="col-12 mt-5 mb-2">
			<h2 class="h2 text-center"">Photos From Other Vacations</h2>
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

								<div class="card-footer">
									<p class="text-muted"> Total Pictures: <i>{{ $getPictures->count() }}</i></p>
								</div>

							</div>

						</div>

					@endforeach

				</div>

			</div>

		</div>

	@else

		<div class="modal fade noContentReturned" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">{{ $trip->trip_location }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="trip_location_pictures">
							<h2>No pictures have been added yet for this trip</h2>
						</div>
					</div>
					<div class="modal-footer">
						<p class="additionalPictures">If you have any pictures or videos that you want posted, please send them to <a class="mailToLink" href="mailto:jacksond1961@yahoo.com?cc=rhonda.lambert@sbcglobal.com&subject=Trip%20Pictures">jacksond1961@yahoo.com</a></p>
					</div>
				</div>
			</div>
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

								<div class="card-footer">
									<p class="text-muted"> Total Pictures: <i>{{ $getPictures->count() }}</i></p>
								</div>

							</div>

						</div>

					@endforeach

				</div>

			</div>

		</div>

	@endif

@endsection