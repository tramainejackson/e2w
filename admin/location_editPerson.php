<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$eventID = cleanValues($_POST["event_id"]);
		$userID = cleanValues($_POST["user_id"]);
		$location = find_event_by_id($eventID); 
		$firstName = cleanValues($_POST["first_name"]);
		$lastName = cleanValues($_POST["last_name"]);
		$email = cleanValues($_POST["email"]);
		$phone = cleanValues($_POST["phone"]);
		$notes = cleanValues($_POST["notes"]);
		$pif = cleanValues($_POST["paid_in_full"]);
		$date = date("Y-m-d");
		
		for($i=0; $i < count($userID); $i++) {
			$pif[$i] = isset($pif[$i]) ? $pif[$i] : "N";
			if($userID[$i] != "") {
				$query  = "UPDATE distribution_list ";
				$query .= "SET first_name = '".$firstName[$i]."', ";
				$query .= "last_name = '".$lastName[$i]."', ";
				$query .= "email_address = '".$email[$i]."', ";
				$query .= "phone = '".$phone[$i]."', ";
				$query .= "notes = '".$notes[$i]."', ";
				$query .= "paid_in_full = '".$pif[$i]."', ";
				$query .= "user_updated = '".$_SESSION["loggedIn"]."' ";
				$query .= "WHERE user_id = '".$userID[$i]."';";
				mysqli_query($connect, $query);
			}
		}
		
		$_SESSION["message"] .= "<li class='okItem'>Users Updated Successfully</li>";
		redirect_to("locations.php?add_person=true&event_users=".htmlentities($location["trip_location"]));
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or users not updated.</li>";
		redirect_to("locations.php?add_person=true");
	}
?>