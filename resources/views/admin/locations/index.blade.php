@extends('layouts.app')

	@section('title', 'Edit Trip - Eastcoast2Westcoast')

	@section('content')

		<div id="" class="">

			<div class="newUserHeader">
				<h1 class="pageTopicHeader">Select A Trip</h1>
			</div>

			<div class="row" id="">
				<div class="col-12 py-4 pl-0">
					<a href="{{ route('location.create') }}" class="btn btn-success">Add New Trip</a>
				</div>
			</div>

			<div class="">
				<ul class="list-unstyled">
					@foreach($getLocations as $showLocations)
						<li>
							<div class="">
								<h2 class=""><a href="/location/{{ $showLocations->id }}/edit" class="btn btn-primary mr-2">Edit</a>{{ $showLocations->trip_location }}</h2>
							</div>
						</li>
					@endforeach
				</ul>

			</div>

		</div>

	@endsection