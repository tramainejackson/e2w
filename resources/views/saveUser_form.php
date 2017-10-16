<?php
	require_once("../include/sessions.php");
	require_once("../include/court.php");
	$firstname = ucfirst(strtolower($_POST['firstname']));
	$lastname = ucfirst(strtolower($_POST['lastname']));
	$paid = $_POST['paid'];
	$outstanding = $_POST['outstanding'];
	$room_type = $_POST['room_type'];
	$notes = $_POST['notes'];
	$email = $_POST['email'];
	$user_id = $_POST['id'];
	$username = $_COOKIE['admin'];
	
	switch($username)
	{
		case "60e8c535fa34ce89e1b06c43695c0191":
			$username = "Deborah";
			break;
		case "6b62199a0347b81ad90ecb763b9b9b3a":
			$username = "RL";
			break;
		case "ddcc4aadf313bfa5ce293d4be4a079bd":
			$username = "Action";
			break;
		default:
			$username = "System";
			break;
	}
		
	if(isset($_POST['cruise']))
	{
		$query1_update  = "UPDATE cruise_payment ";
		$query1_update .= "SET firstname='$firstname', lastname='$lastname', amt_paid='$paid', amt_outstanding='$outstanding', room_type='$room_type', addt_notes='$notes', email='$email', user_updated='$username' ";
		$query1_update .= "WHERE user_id='$user_id'";
		
		$query2_update  = "UPDATE distribution_list ";
		$query2_update .= "SET first_name='$firstname', last_name='$lastname', email_address='$email', user_updated='$username' ";
		$query2_update .= "WHERE user_id='$user_id'";

		if((mysqli_query($connect, $query1_update)) && (mysqli_query($connect, $query2_update)))
		{
			echo "Record Updated Successfully";
		}	
		else
		{
			echo "Error: ".mysqli_error($connect);
		}	
	}
	
	if(isset($_POST['disney']))
	{
		$query3_update  = "UPDATE disney_payment ";
		$query3_update .= "SET firstname='$firstname', lastname='$lastname', amt_paid='$paid', amt_outstanding='$outstanding', room_type='$room_type', addt_notes='$notes', email='$email', user_updated='$username' ";
		$query3_update .= "WHERE user_id='$user_id'";
		
		$query4_update  = "UPDATE distribution_list ";
		$query4_update .= "SET first_name='$firstname', last_name='$lastname', email_address='$email', user_updated='$username' ";
		$query4_update .= "WHERE user_id = '$user_id'";
		
		if((mysqli_query($connect, $query3_update)) && (mysqli_query($connect, $query4_update)))
		{
			$_SESSION["message"] = "Record Updated Successfully";
		}	
		else
		{
			$_SESSION["errors"] = "Error: ".mysqli_error($connect);
		}
	}
?>