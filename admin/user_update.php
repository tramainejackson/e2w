<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$userID = $_POST["current_username"];
		$currentInformation = find_admin_by_id($userID);
		$firstName = cleanValues($_POST["first_name"]);
		$lastName = cleanValues($_POST["last_name"]);
		$username = trim(strtolower($_POST["username"]));
		$password = $_POST["password"];
		$active = $_POST["active"];
		
		//Check current username and password for changes
		if($currentInformation["username"] != $username) {
			$username = checkNewUsername($username);
			if($username == false) {
				$username = $currentInformation["username"];
				$_SESSION["errors"] .= "<li class='errorItem'>Username was not changed</li>";
			}
		}
		if($password != "") {
			$password = checkNewPassword($password);
			if($password != false) {
				$hashed_password = createPassword($password);
			} else {
				$_SESSION["errors"] .= "<li class='errorItem'>Password was not changed</li>";
			}
		}
		
		if(isset($hashed_password)) {
			$query  = "UPDATE admin_users ";
			$query .= "SET first_name = '".$firstName."', ";
			$query .= "last_name = '".$lastName."', ";
			$query .= "username = '".$username."', ";
			$query .= "password = '".$hashed_password."', ";
			$query .= "active = '".$active ."' ";
			$query .= "WHERE user_id = '".$userID ."';";
			
			mysqli_query($connect, $query);
			
		} elseif(!isset($hashed_password)) {
			$query  = "UPDATE admin_users ";
			$query .= "SET first_name = '".$firstName."', ";
			$query .= "last_name = '".$lastName."', ";
			$query .= "username = '".$username."', ";
			$query .= "active = '".$active ."' ";
			$query .= "WHERE user_id = '".$userID ."';";
			
			mysqli_query($connect, $query);
		}
		
		mysqli_close($connect);
		
		if(!isset($hashed_password) && ($currentInformation["username"] == $username)) {
			$_SESSION["message"] .= "<li class='okItem'>Users Updated Successfully</li>";
			redirect_to("e2w_admin.php");		
		} elseif(isset($hashed_password) || ($currentInformation["username"] != $username)) {
			$_SESSION["message"] .= "<li class='okItem'>Please login with your new Username / Password combination</li>";
			$_SESSION["message"] .= "<li class='okItem'>Users Updated Successfully</li>";
			redirect_to("e2w_adminLogout.php");
		}
	} else {
		mysqli_close($connect);
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or new user has not been updated successfully.</li>";
		redirect_to("e2w_admin.php");
	}
?>