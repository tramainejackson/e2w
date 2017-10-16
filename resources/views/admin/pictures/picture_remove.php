<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$currentTripInfo = find_event_by_name($_POST["trip_name_pictures"]);
		$pictureID = $_POST["remove_id"];
		$tripID = $currentTripInfo["trip_id"];
		
		for($i=0; $i < count($pictureID); $i++) {
			$pictureName = find_picture_name_by_id($pictureID[$i]);
			
			$query  = "DELETE FROM trip_pictures ";
			$query .= "WHERE trip_id = '".$tripID."' ";
			$query .= "AND picture_id = '".$pictureID[$i]."' ";
			mysqli_query($connect, $query);
			
			if(file_exists("../public/images/".$pictureName["picture_name"])) {
				unlink("../public/images/".$pictureName["picture_name"]);
				$_SESSION["message"] .= "<li class=''>Picture Removed Successfully (".$pictureName["picture_name"].")</li>";
			} else {
				$_SESSION["errors"] .= "<li class=''>Image was not found in directory (".$pictureName["picture_name"].")</li>";
			}
		}
		
		redirect_to("pictures.php?remove_pictures=true&location=".$currentTripInfo["trip_location"]);
		
	} else {
		$_SESSION["errors"] .= "User not logged in or pictures were not removed";
		redirect_to("pictures.php?remove_pictures=true&location=".$currentTripInfo["trip_location"]);
	}
	
?>