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
				<div id="location_page_header" class="">
					<h1 class="pageTopicHeader">Trip Locations</h1>
					
					<ul class="">
						@foreach($getLocations as $showLocations)
							<li>
								<div class="">
									<h2><a href="/location/{{ $showLocations->id }}/edit" class="btn btn-primary">Edit</a>{{ $showLocations->trip_location }}</h2>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	@endsection