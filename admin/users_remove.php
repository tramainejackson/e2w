<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<?php
	if(isset($_POST["submit"])) {
		$userID = $_POST["user_id"]);
		
		$query  = "DELETE FROM admin_users ";
		$query .= "WHERE user_id = '".$userID."';";
		
		mysqli_query($connect, $query);
		$_SESSION["message"] .= "<li class='okItem'>User Removed Successfully</li>";
		redirect_to("e2w_admin.php");
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or user not removed successfully.</li>";
		redirect_to("e2w_admin.php");
	}
?>