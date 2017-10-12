<?php require_once("../include/sessions.php"); ?>
<?php require_once("../include/court.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$userID = $_POST["user_id"]);
		$firstName = cleanValues($_POST["first_name"]);
		$lastName = cleanValues($_POST["last_name"]);
		$username = checkNewUsername($_POST["username"]) == false ? "Error" : checkNewUsername($_POST["username"]);
		$password = checkNewPassword($_POST["password"]);
		$hashed_password = $password != false ? createPassword($password) : "Error";
		$active = $_POST["active"];
		
		if($hashed_password != "Error" && $username != "Error") {
			$query  = "UPDATE admin_users ";
			$query .= "SET first_name = '".$firstName."', ";
			$query .= "last_name = '".$lastName."', ";
			$query .= "username = '".$username."', ";
			$query .= "password = '".$hashed_password."', ";
			$query .= "active = '".$active ."' ";
			$query .= "WHERE user_id = '".$userID ."', ";
			
		}	
		
		mysqli_query($connect, $query);
		$_SESSION["message"] .= "<li class='okItem'>Users Updated Successfully</li>";
		redirect_to("e2w_admin.php");
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or new user has not been updated successfully.</li>";
		redirect_to("e2w_admin.php");
	}
?>