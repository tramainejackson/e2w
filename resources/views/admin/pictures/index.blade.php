@extends('admin.layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="pictures_page_header" class="">
			<h1 class="pageTopicHeader">Trip Pictures</h1>
		</div>
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
	@endsection