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
		
		<form name="" id="add_picture_form" class="pictureForm" action="/pictures" method="POST" enctype="multipart/form-data">
		
			{{ method_field('POST') }}
			{{ csrf_field() }}
				
			<div id="pictures_page_header" class="">
				<h1 class="pageTopicHeader">Add Pictures</h1>
			</div>
			<div class="noLocationSelected p-2" style="display:none">
				<p class="bg-secondary text-danger text-center">PLEASE SELECT A TRIP TO ADD THE PICTURES TO</p>
			</div>
			<div class="addPictures">
				<select name="trip_id" class="pictureSelect p-1 m-0 mb-1 w-100" id="">
					<option value="blank" selected disabled>---- Select A Trip ----</option>
					@foreach($getLocations as $showLocations)
						<option value="{{ $showLocations->id }}">{{ $showLocations->trip_location }}</option>
					@endforeach
				</select>
				<label class="custom-file d-block">
					<span class="custom-file-control" style=""></span>
					<input type="file" name="upload_photo[]" id="upload_photo_input" class="custom-file-input mx-auto" multiple />
				</label>
				<span class="text-danger text-center d-block"> (Add up to 10 photos at a time)</span>
				<div class="d-block">
					<input type="submit" value="Add Photos" name="add_pictures" value="" class="btn btn-lg" />
				</div>
			</div>
			<div class="uploadsView">
				<h2 class="text-light">Preview Uploads</h2>
			</div>
		</form>
	@endsection