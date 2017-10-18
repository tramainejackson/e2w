@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="admin_page">
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			
			@include('layouts.admin_nav')
			
			<div class="adminDiv" id="">
				<div id="pictures_page_header" class="">
					<h1 class="pageTopicHeader">Trip Pictures</h1>
				</div>
				@foreach($getLocations as $location)
					<div class="currentPicturesDiv">
						<div class="">
							<h2 class="">{{ $location->trip_location }}</h2>
						</div>
						<div class="locationPictures">
							@php $getAllPictures = \App\TripPictures::where('trip_id', $location->id)->get(); @endphp
							@if($getAllPictures->count() < 1)
								<div class="noPicturesDiv">
									<p class="noValueMessage">There have been no pictures added yet for this location.&nbsp;<a href="{{ route('pictures.create') }}">Add New Pictures Now</a></p>
								</div>
							@else
								@foreach($getAllPictures as $showAllPicture)
									<img src="/images/{{ $showAllPicture->picture_name }}" class="img-thumbnail" style="max-height:200px;" />
								@endforeach
							@endif
						</div>	
					</div>
				@endforeach
			</div>
		</div>
	@endsection