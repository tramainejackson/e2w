@extends('admin.layouts.app')

	@section('content')
		<div id="pictures_page_header" class="">
			<h1 class="pageTopicHeader">Trip Pictures</h1>
		</div>
		<div class="row d-xl-none">
			<div class="col text-center py-4">
				<a href="/pictures/create" class="btn btn-success">Add New Pictures</a>
			</div>
		</div>
		<div class="row d-xl-none">
			<div class="col-12">
				<div class="container-fluid">
					<div class="row">
						@foreach($getLocations as $location)
							@php $content1 = Storage::disk('local')->has($location->trip_photo); @endphp
							@php $getPictures = $location->pictures; @endphp
							<div class="col-12 col-sm-6">
								<div class="card my-2">
									<img src="{{ $content1 == true ? asset('storage/' . str_ireplace('public/', '', $location->trip_photo)) : '/images/skyline.jpg' }}" class="card-img-top" />
									<div class="card-header d-flex justify-content-around align-items-center" role="tab" id="heading{{ $loop->iteration }}">
										<h5 class="mb-0">
											<a class="collapsed" data-toggle="collapse" href="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">{{ $location->trip_location }}</a>
										</h5>
										<a href="/pictures/{{$location->id}}/edit" class="btn btn-primary ml-3">Edit</a>
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
											<p class="text-muted">{{ $location->trip_location }} Total Pictures: <i>{{ $getPictures->count() }}</i></p>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="row d-none d-xl-flex">
			<div class="col">
				@foreach($getLocations as $location)
					@php $getAllPictures = $location->pictures; @endphp
					<div class="currentPicturesDiv">
						<div class="text-white d-flex align-items-center">
							<h2 class="display-3">{{ $location->trip_location }}</h2>
							@if($getAllPictures->count() > 0)
								<a href="/pictures/{{$location->id}}/edit" class="btn btn-primary btn-lg ml-3">Edit</a>
							@endif
						</div>
						@if($getAllPictures->count() > 0)
							<div class="">
								<span class="text-light"><i>Total Pictures:</i> {{ $getAllPictures->count() }}</span>
							</div>
						@endif
						<div class="container-fluid">
							<div class="row">
								@if($getAllPictures->count() < 1)
									<div class="col">
										<div class="noPicturesDiv">
											<p class="noValueMessage text-light">There have been no pictures added yet for this location.&nbsp;<a href="{{ route('pictures.create') }}">Add New Pictures Now</a></p>
										</div>
									</div>
								@else
									@foreach($getAllPictures as $picture)
										@php $content = Storage::disk('local')->has($picture->picture_name); @endphp
										<div class="col-3">
											<div class="card my-2">
												<img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/no_image_lg.png' }}" class="card-img-top" style="" />
												<div class="card-footer">
													<span class="text-center">{{ $picture->picture_caption != null ? $picture->picture_caption : 'No Caption Added Yet' }}</span>
												</div>
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
						@if(!$loop->last)
							<div class="divider"></div>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	@endsection