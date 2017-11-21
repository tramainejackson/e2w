@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="admin_page">
			@if(session('status'))
				<h2 class="flashMessage">{{ session('status') }}</h2>
			@endif
			
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			
			@include('layouts.admin_nav')
			
			<div class="adminDiv" id="">
				<form name="" id="add_picture_form" class="pictureForm" action="/pictures" method="POST" enctype="multipart/form-data">
				
					{{ method_field('POST') }}
					{{ csrf_field() }}
						
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Add Pictures</h1>
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
							<input type="submit" name="submit" name="add_pictures" class="btn btn-lg" />
						</div>
					</div>
					<div class="uploadsView">
						<h2 class="text-light">Preview Uploads</h2>
					</div>
				</form>					
			</div>
		</div>
	@endsection