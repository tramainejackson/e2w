<?php
	include('court.php');
	$first_name = ucfirst(strtolower($_POST['first_name']));
	$last_name = ucfirst(strtolower($_POST['last_name']));
	$email_address = $_POST['email'];
	$to = $email_address;
	$admin = "jacksond1961@yahoo.com";
	$subject = "Cruise Trip Registration";
	$message = "Thanks for registering for the Cruise Vacation. We will be sending email with any new information to keep you updated as closely as possible with any changes. Here is the information that we have listed for you:<br/><br/><strong>Email:</strong> ".$email_address."<br/><strong>Name:</strong> ".$first_name." ".$last_name."<br/><br/>If any of the information is incorrect or if you have any questions, please email us at administrator@eastcoast2westcoast.com.<br/><br/>Thank you and have a nice day.";
	$message2 = "A new user has just registered for the Cruise Vacation. See below: <br/><strong>Name:</strong> ".$first_name." ".$last_name."<br/><strong>Email:</strong> ".$email_address;
	$email_message = wordwrap($message, 70, "\r\n");
	$email_message2 = wordwrap($message2, 70, "\r\n");
	$email_headers = "MIME-Version: 1.0" . "\r\n";
	$email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$email_headers .= 'From: Admin<administrator@eastcoast2westcoast.com>' . "\r\n";
	$date = date("Y/m/d");
	$trip_location = 2;
	
	$cruise_insert = "INSERT INTO `debjac6_db`.`distribution_list` (`user_id`, `first_name`, `last_name`, `email_address`, `signup_date`, `trip_location`)
					 VALUES('', '$first_name', '$last_name', '$email_address', '$date', '$trip_location');";
	echo "<div id=confirmation_form><p>Hey ".$first_name.", thanks for signing up for the Cruise.</p>";
	echo "<p>You will receive all notifications regarding this trip going forward.</p>";
	echo "<p>Email Provided: ".$email_address."</p>";
	echo "</div>";
	mysqli_query($connect, $cruise_insert) or die ("Unable to run distribution list query:" .mysqli_error($connect));
	$dbUser_id = mysqli_insert_id($connect);
	$cruisePayment_insert = "INSERT INTO `debjac6_db`.`cruise_payment` (`user_id`, `firstname`, `lastname`, `amt_paid`, `amt_outstanding`, `date_added`, `date_updated`)
							VALUES ('$dbUser_id', '$first_name', '$last_name', '$', '$', '$date', '$date')";								
	mysqli_query($connect, $cruisePayment_insert) or die ("Unable to run cruise payment query:" .mysqli_error($connect));
	mail($to, $subject, $email_message, $email_headers);
	mail($admin, $subject, $email_message2, $email_headers);
	mysqli_close($connect);
?>