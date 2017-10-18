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
			<?php if(isset($_GET["add_pictures"])) { ?>
				<div class="adminDiv container" id="">
					<form name="" id="add_picture_form" class="pictureForm" action="picture_add.php" method="POST" enctype="multipart/form-data" onsubmit="locationCheck();">
						<div id="pictures_page_header" class="">
							<h1 class="pageTopicHeader">Add Pictures</h1>
							<select name="trip_name_pictures" class="pictureSelect" id="select_trip_for_new_pictures">
								<option value="blank" selected disabled>--Select A Trip--</option>
								<?php while($showLocations = mysqli_fetch_assoc($getLocations)) { ?>
									<?php if(isset($_GET["location"]) && $_GET["location"] == $showLocations["trip_location"]) { ?>
										<option value="<?php echo $showLocations["trip_location"]; ?>" selected><?php echo $showLocations["trip_location"]; ?></option>
									<?php } else { ?>
										<option value="<?php echo $showLocations["trip_location"]; ?>"><?php echo $showLocations["trip_location"]; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class="addPictures">
							<input type="file" name="upload_photo[]" class="" multiple />
							<input type="submit" name="submit" name="add_pictures" class="" />
							<p class="addPicturesP"> (Add up to 10 photos at a time)</p>
						</div>
					</form>					
				</div>
			<?php } elseif(isset($_GET["remove_pictures"])) { ?>
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
			<?php } else { ?>
				<?php $getAllLocations = find_all_events(); ?>
				<div class="adminDiv container" id="">
					<form name="picture_update" class="pictureUpdate" action="picture_update.php" method="POST">
						<div id="pictures_page_header" class="">
							<h1 class="pageTopicHeader">Trip Pictures</h1>
							<select name="trip_name_pictures" class="pictureSelect" id="select_trip_for_pictures">
								<option value="blank" selected disabled>--Select A Trip--</option>
								<?php while($showLocations = mysqli_fetch_assoc($getLocations)) { ?>
									<?php if(isset($_GET["location"]) && $_GET["location"] == $showLocations["trip_location"]) { ?>
										<option value="<?php echo $showLocations["trip_location"]; ?>" selected><?php echo $showLocations["trip_location"]; ?></option>
									<?php } else { ?>
										<option value="<?php echo $showLocations["trip_location"]; ?>"><?php echo $showLocations["trip_location"]; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<input type="submit" name="submit" value="Update Captions" class="" />
						</div>
						<?php if(isset($_GET["location"])) { ?>
							<div class="currentPicturesDiv">
								<div class="locationPictures">
									<?php $getLocationID = find_event_by_name($_GET["location"]); ?>
									<?php $getAllPictures = find_all_pictures_by_id($getLocationID["trip_id"]); ?>
									<?php if(mysqli_num_rows($getAllPictures) < 1) { ?>
										<div class="noPicturesDiv">
											<p class="noValueMessage">There have been no pictures added yet for this location.&nbsp;<a href="pictures.php?add_pictures=true&location=<?php echo $_GET["location"]; ?>">Add New Pictures Now</a></p>
										</div>
									<?php } else { ?>
										<?php while($showAllPicture = mysqli_fetch_assoc($getAllPictures)) { ?>
											<div class="allPicturesDiv">
												<img src="../public/images/<?php echo $showAllPicture["picture_name"]; ?>" class="" />
												<input type="text" name="picture_caption[]" class="pictureCaption" value="<?php echo isset($showAllPicture["picture_caption"]) ? $showAllPicture["picture_caption"] : "" ?>" placeholder="Add Caption" maxlength="35" />
												<input type="number" name="picture_id[]" class="pictureID" value="<?php  echo $showAllPicture["picture_id"]?>" hidden />
											</div>
										<?php } ?>
									<?php } ?>	
								</div>	
							</div>
						<?php } ?>	
					</form>
				</div>
			<?php } ?>
		</div>
	@endsection