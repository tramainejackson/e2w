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
				<form name="" id="add_picture_form" class="pictureForm" action="picture_add.php" method="POST" enctype="multipart/form-data" onsubmit="locationCheck();">
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Add Pictures</h1>
						<select name="trip_name_pictures" class="pictureSelect" id="select_trip_for_new_pictures">
							<option value="blank" selected disabled>--Select A Trip--</option>
							@foreach($getLocations as $showLocations)
								<?php if(isset($_GET["location"]) && $_GET["location"] == $showLocations["trip_location"]) { ?>
									<option value="<?php echo $showLocations["trip_location"]; ?>" selected><?php echo $showLocations["trip_location"]; ?></option>
								<?php } else { ?>
									<option value="<?php echo $showLocations["trip_location"]; ?>"><?php echo $showLocations["trip_location"]; ?></option>
								<?php } ?>
							@endforeach
						</select>
					</div>
					<div class="addPictures">
						<input type="file" name="upload_photo[]" class="" multiple />
						<input type="submit" name="submit" name="add_pictures" class="" />
						<p class="addPicturesP"> (Add up to 10 photos at a time)</p>
					</div>
				</form>					
			</div>
		</div>
	@endsection