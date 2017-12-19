@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
		<style>
			/*Smartphones portrait*/
			@media only screen and (max-width:575px) {
				div#app {
					background: initial;
				}
			}
		</style>
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="home_page" class="container-fluid">	
			<div class="row d-xl-none">
				@include('layouts.mobile_nav')
			
				<div class="col-12 p-0">
					<h2 class="text-black text-center m-0 p-5" style="background:linear-gradient(#f2f2f2, #f2f2f2, #f2f2f2, rgba(0, 0, 0, 0)); font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Trip Photos</b></h2>
				</div>
				
				<div class="col-12">
					<div class="container-fluid">
						<div class="row">
							@foreach($trips as $trip)
								@php $content1 = Storage::disk('local')->has($trip->trip_photo); @endphp
								@php $getPictures = $trip->pictures; @endphp
								<div class="col-12 col-sm-6">
									<div class="card my-2">
										<img src="{{ $content1 == true ? asset('storage/' . str_ireplace('public/', '', $trip->trip_photo)) : '/images/skyline.jpg' }}" class="card-img-top" />
										<div class="card-header" role="tab" id="heading{{ $loop->iteration }}">
											<h5 class="mb-0">
												<a class="collapsed" data-toggle="collapse" href="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">{{ $trip->trip_location }}</a>
											</h5>
										</div>
										<div id="collapse{{ $loop->iteration }}" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
											<div class="card-body">
												<div class="row location_photos">
													@foreach($getPictures as $picture)
														@php $content = Storage::disk('local')->has($picture->picture_name); @endphp
														
														<a href="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="col-6" title="{{ $picture->picture_caption }}"><img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="img-thumbnail" /></a>
													@endforeach
												</div>
											</div>
											<div class="card-footer">
												<p class="text-muted">{{ $trip->trip_location }} Total Pictures: <i>{{ $getPictures->count() }}</i></p>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection