<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$location = find_event_by_name($_POST["trip_name_users"]);
		$user_names = checkNewName($_POST["first_name"], $_POST["last_name"]);
		$email = checkNewEmail($_POST["email"]);
		$phone = $_POST["phone"][0].$_POST["phone"][1].$_POST["phone"][2];
		$notes = cleanValues($_POST["notes"]);
		$date = date("Y-m-d");
		
		$query  = "INSERT INTO distribution_list (trip_location, first_name, last_name, ";
		$query .= "email_address, phone, notes, signup_date, user_updated)  ";
		$query .= "VALUES('".$location["trip_id"]."', '".$user_names[0]."', '".$user_names[1]."', ";
		$query .= "'".$email."', '".$phone."', '".$notes."', '".$date."', '".$_SESSION["loggedIn"]."');";;
		
		mysqli_query($connect, $query);
		$_SESSION["message"] .= "New Person Added Successfully";
		redirect_to("locations.php?add_person=true&event_users=".htmlentities($location["trip_location"]));
	} else {
		$_SESSION["errors"] .= "User not logged in or new person not been added.";
		redirect_to("locations.php?add_trip=true");
	}
?>