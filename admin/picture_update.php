<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$currentTripInfo = find_event_by_name($_POST["trip_name_pictures"]);
		$tripID = $currentTripInfo["trip_id"];
		$pictureID = $_POST["picture_id"];
		$picture_caption = $_POST["picture_caption"];
		$updatedPicturesCount = 0;
		
		for($i=0; $i < count($pictureID); $i++) {
			if($picture_caption[$i] != "") {
				$query  = "UPDATE trip_pictures ";
				$query .= "SET picture_caption = '".$picture_caption[$i]."' ";
				$query .= "WHERE picture_id = '".$pictureID[$i]."';";
				mysqli_query($connect, $query);
				
				$updatedPicturesCount++;
			}
		}
		
		$_SESSION["message"] .= "<li class='okMsg'>".$updatedPicturesCount . " pictures updated successfully</li>";
		redirect_to("pictures.php?location=".$currentTripInfo["trip_location"]);
		
	} else {
		$_SESSION["errors"] .= "0 pictures were updated";
		redirect_to("pictures.php?location=" . $_POST["trip_name_pictures"]);
	}
	
?>