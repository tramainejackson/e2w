<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$location = cleanValues($_POST["trip_name"]);
		$checkLocation = find_event_by_name($location);
		$tripMonth = $_POST["trip_month"];
		$tripYear = $_POST["trip_year"];
		$showTrip = $_POST["show_trip"];
		$tripPhoto = "";

		if($_FILES["trip_photo"]["name"] != "") {
			$tripPhoto = checkNewPicture($_FILES["trip_photo"]);
			if(isset($tripPhoto["name"])) {
				$tripPhoto = $tripPhoto["name"];
			} else {
				$tripPhoto = "";
			}
		} else {
			$tripPhoto = "";
		}
		
		if(isset($checkLocation["trip_location"])) {
			$_SESSION["errors"] .= "New location not added. That trip name already exist.";
		} else {
			$query  = "INSERT INTO trip_location (trip_location, trip_month, trip_year, trip_photo, show_trip)  ";
			$query .= "VALUES('".$location."', '".$tripMonth."', '".$tripYear."', ";
			$query .= "'".$tripPhoto."', '".$showTrip."');";
			
			if(mysqli_query($connect, $query)) {
				$newPage = createNewLocationPage($location, $tripMonth, $tripYear, $tripPhoto);
				$_SESSION["message"] .= "New Location Added Successfully";
			}
		}
		
		redirect_to("locations.php?edit_trip=" . htmlspecialchars($location));
		
	} else {
		$_SESSION["errors"] .= "User not logged in or new location not been added.";
		redirect_to("locations.php?add_trip=true");
	}
?>