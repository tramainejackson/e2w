@extends('admin.layouts.app')

	@section('content')

		<div class="row" id="">

			<div id="pictures_page_header" class="col">
				<h1 class="pageTopicHeader">Add Pictures</h1>
			</div>

			<div class="col-12" id="">

				<form name="" id="add_picture_form" class="pictureForm" action="/pictures" method="POST" enctype="multipart/form-data">

					{{ method_field('POST') }}
					{{ csrf_field() }}


					<div class="noLocationSelected p-2" style="display:none">
						<p class="bg-warning text-monospace text-center py-2">PLEASE SELECT A TRIP TO ADD THE PICTURES TO</p>
					</div>

					<div class="addPictures form-row">

						<div class="md-form col-4" id="">
							<select name="trip_id" class="pictureSelect mdb-select" id="">

								<option value="blank" selected disabled>---- Select A Trip ----</option>

								@foreach($getLocations as $showLocations)
									<option value="{{ $showLocations->id }}">{{ $showLocations->trip_location }}</option>
								@endforeach

							</select>
						</div>

						{{-- Spacer --}}
						<div class="col-12" id=""></div>

						<div class="md-form col-4">
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
									<span>Choose file</span>
									<input id="upload_photo_input" type="file" name="upload_photo[]" multiple />
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload your file">
								</div>
							</div>
						</div>

						<div class="md-form col-12">
							<button type="submit" class="btn btn-info">Add Photos</button>
						</div>

						<div class="md-form col-12" id="">
							<span class="text-danger"> (Add up to 10 photos at a time)</span>
						</div>


					</div>

					<div class="uploadsView">
						<h2 class="text-light">Preview Uploads</h2>
					</div>
				</form>

			</div>

		</div>

	@endsection