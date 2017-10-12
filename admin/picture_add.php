<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$currentTripInfo = find_event_by_name($_POST["trip_name_pictures"]);
		$tripID = $currentTripInfo["trip_id"];
		$newPictures = $_FILES["upload_photo"]["name"] !=  "" ? reArrayFiles($_FILES) : "";
		// echo"<pre>";
		// print_r($_POST);
		// echo"</pre>";
		// echo"<pre>";
		// print_r($_FILES);
		// echo"</pre>";
		
		for($i=0; $i < count($newPictures["upload_photo"]); $i++) {
			$newPicture = checkNewPicture($newPictures["upload_photo"][$i]);

			if($newPicture["name"] != "") {
				$query  = "INSERT INTO trip_pictures ";
				$query .= "(trip_id, picture_name) ";
				$query .= "VALUES ('".$tripID."', '".$newPicture["name"]."');";
				mysqli_query($connect, $query);
				
				$_SESSION["message"] .= "<li class='okMsg'>".$newPicture["name"] . " added successfully</li>";
			}
		}
		
		redirect_to("pictures.php?location=" . $currentTripInfo["trip_location"]);
		
	} else {
		$_SESSION["errors"] .= "User not logged in or pictures were not removed";
		redirect_to("pictures.php?location=" . $_POST["trip_name_pictures"]);
	}
	
?>