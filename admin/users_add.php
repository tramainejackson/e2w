<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$firstName = cleanValues($_POST["first_name"]);
		$lastName = cleanValues($_POST["last_name"]);
		$username = $_POST["username"];
		$password = $_POST["password"];
		$active = isset($_POST["active"]) ? $_POST["active"] : "N";
		
		//Check current username and password for changes
		if($username != "") {
			$username = checkNewUsername($username);
			if($username == false) {
				$_SESSION["errors"] .= "<li class='errorItem'>Admin not added</li>";
			} else {
				$dupeCheck = find_admin_by_username($username);
				if($dupeCheck != null) {
					$_SESSION["errors"] .= "<li class='errorItem'>That username is already in use</li>";
					$username = null;
				}
			}
		}
		
		echo "SET = " . isset($dupeCheck);
		if($password != "") {
			$password = checkNewPassword($password);
			if($password != false) {
				$hashed_password = createPassword($password);
			}
		}
		
		if(isset($hashed_password) && isset($dupeCheck)) {
			$query  = "INSERT INTO admin_users (first_name, last_name, username, ";
			$query .= "password, active, created_by) ";
			$query .= "VALUES ('".$firstName."', '".$lastName."', '".$username."', ";
			$query .= "'".$hashed_password."', '".$active."', '".$_SESSION["loggedIn"]."');";
			
			mysqli_query($connect, $query);
			
			$_SESSION["message"] .= "<li class='okItem'>New Users Added Successfully</li>";
		} elseif(!isset($hashed_password) || !isset($username)) {
			$_SESSION["errors"] .= "<li class='errorItem'>Admin not added</li>";
		}
		
		redirect_to("e2w_admin.php?admin=false");
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or new user has not been added successfully.</li>";
		redirect_to("e2w_admin.php?admin=false");
	}
?>