<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$location = find_event_by_name($_POST["trip_name_activities"]);
		$tripActivity = cleanValues($_POST["trip_event"]);
		$activityDate = $_POST["activity_date"];
		$activityLocation = cleanValues($_POST["activity_location"]);
		$date = date("Y-m-d");
		
		for($i=0; $i < count($tripActivity); $i++) {
			if($tripActivity[$i] != "") {
				$query  = "INSERT INTO trip_activities (trip_id, trip_event, activity_date, ";
				$query .= "activity_location, user_updated) ";
				$query .= "VALUES('".$location["trip_id"]."', '".$tripActivity[$i]."', '".$activityDate[$i]."', ";
				$query .= "'".$activityLocation[$i]."', '".$_SESSION["loggedIn"]."');";
				mysqli_query($connect, $query);
			}
		}
		
		$_SESSION["message"] .= "New Activities Added Successfully";
		redirect_to("locations.php?trip_activities=true&all_activities=".htmlentities($location["trip_location"]));
	} else {
		$_SESSION["errors"] .= "User not logged in or new activities not added.";
		redirect_to("locations.php?trip_activities=true");
	}
?>