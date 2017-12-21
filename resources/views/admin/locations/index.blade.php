@extends('admin.layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="location_page_header" class="">
			<h1 class="pageTopicHeader text-light">Trip Locations</h1>
		</div>
		<div class="newUserHeader">
			<h1 class="pageTopicHeader">Select A Trip</h1>
		</div>
		<div class="">
			<ul class="list-unstyled">
				@foreach($getLocations as $showLocations)
					<li>
						<div class="">
							<h2 class="text-light"><a href="/location/{{ $showLocations->id }}/edit" class="btn btn-primary mr-2">Edit</a>{{ $showLocations->trip_location }}</h2>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	@endsection