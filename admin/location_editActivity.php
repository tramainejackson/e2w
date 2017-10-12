<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$location = find_event_by_id($_POST["trip_id"]);
		$activityID = $_POST["activity_id"];
		$activityDate = $_POST["activity_date"];
		$tripActivity = cleanValues($_POST["trip_event"]);
		$activityLocation = cleanValues($_POST["activity_location"]);
		$showActivity = $_POST["show_activity"];
		$date = date("Y-m-d");
		
		for($i=0; $i < count($tripActivity); $i++) {
			if($tripActivity[$i] != "") {
				$query  = "UPDATE trip_activities ";
				$query .= "SET trip_event = '".$tripActivity[$i]."', ";
				$query .= "activity_date = '".$activityDate[$i]."', ";
				$query .= "activity_location = '".$activityLocation[$i]."', ";
				$query .= "show_activity = '".$showActivity[$i]."', ";
				$query .= "user_updated = '".$_SESSION["loggedIn"]."' ";
				$query .= "WHERE activity_id = '".$activityID[$i]."';";
				mysqli_query($connect, $query);
			}
		}
		
		$_SESSION["message"] .= "<li class='okItem'>Activities Updated Successfully</li>";
		redirect_to("locations.php?trip_activities=true&all_activities=".htmlentities($location["trip_location"]));
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or activities not updated.</li>";
		redirect_to("locations.php?trip_activities=true");
	}
?>