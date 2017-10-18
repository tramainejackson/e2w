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
			
			<div class="adminDiv container" id="">
				<form name="" class="pictureForm" action="picture_remove.php" method="POST" onsubmit="locationCheck();">
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Remove Pictures</h1>
						<select name="trip_name_pictures" class="pictureSelect" id="select_trip_for_remove_pictures">
							<option value="blank" selected disabled>--Select A Trip--</option>
							<?php while($showLocations = mysqli_fetch_assoc($getLocations)) { ?>
								<?php if(isset($_GET["location"]) && $_GET["location"] == $showLocations["trip_location"]) { ?>
									<option value="<?php echo $showLocations["trip_location"]; ?>" selected><?php echo $showLocations["trip_location"]; ?></option>
								<?php } else { ?>
									<option value="<?php echo $showLocations["trip_location"]; ?>"><?php echo $showLocations["trip_location"]; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<input type="submit" name="submit" value="Remove Pictures" class="" />
					</div>
					<?php if(isset($_GET["location"])) { ?>
						<?php $eventID = find_event_by_name($_GET["location"]); ?>
						<?php $getAllPictures = find_all_pictures_by_id($eventID["trip_id"]); ?>
						<?php if(mysqli_num_rows($getAllPictures) < 1) { ?>
							<div class="noPicturesDiv">
								<p class="noValueMessage">There have been no pictures added yet for this location.&nbsp;<a href="pictures.php?add_pictures=true&location=<?php echo $_GET["location"]; ?>">Add New Pictures Now</a></p>
							</div>
						<?php } else { ?>
							<?php while($showAllPictures = mysqli_fetch_assoc($getAllPictures)) { ?>	
								<div class="removeIndPicture">
									<h3 class=""><?php echo $showAllPictures["picture_caption"] == "" ? "No Caption" : $showAllPictures["picture_caption"]; ?></h3>
									<input type="checkbox" name="remove_id[]" class="" value="<?php echo $showAllPictures["picture_id"]; ?>" />
									<img src="../public/images/<?php echo $showAllPictures["picture_name"]; ?>" class="" />
								</div>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</form>
			</div>
		</div>
	@endsection