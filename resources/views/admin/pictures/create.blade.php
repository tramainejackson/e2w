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
				<form name="" id="add_picture_form" class="pictureForm" action="/pictures" method="POST" enctype="multipart/form-data">
				
					{{ method_field('POST') }}
					{{ csrf_field() }}
						
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Add Pictures</h1>
						<select name="trip_id" class="pictureSelect" id="select_trip_for_new_pictures">
							<option value="blank" selected disabled>---- Select A Trip ----</option>
							@foreach($getLocations as $showLocations)
								<option value="{{ $showLocations->id }}">{{ $showLocations->trip_location }}</option>
							@endforeach
						</select>
					</div>
					<div class="addPictures">
						<label class="custom-file d-block">
							<span class="custom-file-control" style=""></span>
							<input type="file" name="upload_photo[]" class="custom-file-input mx-auto" multiple />
						</label>
						<span class="text-danger text-center d-block"> (Add up to 10 photos at a time)</span>
					</div>
					<div class="uploadsView"></div>
					<div class="">
						<input type="submit" name="submit" name="add_pictures" class="" />
					</div>
				</form>					
			</div>
		</div>
	@endsection