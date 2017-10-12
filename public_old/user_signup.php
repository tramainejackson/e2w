<?php require_once("../include/sessions.php"); ?>
<?php require_once("../include/court.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php require_once("../include/PHPMailer/class.phpmailer.php"); ?>
<?php require_once("../include/PHPMailer/class.smtp.php"); ?>
<?php
	if(isset($_POST["submit"])) {
		$firstName = cleanValues($_POST["first_name"]);
		$lastName = cleanValues($_POST["last_name"]);
		$email = checkNewEmail($_POST["email"]);
		$names = checkNewName($firstName, $lastName);
		$package = cleanValues($_POST["group"]);
		$locationID = $_POST["trip_id"];
		$location = find_event_by_id($locationID);
		$date = date("Y/m/d");
		
		if($email == 1 || $email == 2 || is_numeric($names)) {
			redirect_to(str_ireplace(" ", "_", strtolower($location["trip_location"])) . $location["trip_year"] . ".php");
		} else {
			$query  = "INSERT INTO distribution_list (first_name, last_name, email_address, ";
			$query .= "package, trip_location, signup_date) ";
			$query .= "VALUES ('".$firstName."', '".$lastName."', '".$email."', ";
			$query .= "'".$package."', '".$locationID."', '".$date."');";
			$admin_set = mysqli_query($connect, $query);
			confirm_query($admin_set);
			if($admin_set) {
				$userID = find_last_inserted_id();
				$to = $email;
				$admin = "tramaine.jackson@eastcoast2westcoast.com";
				$subject = $location["trip_location"] . " Registration";
				$message  = "<div>";
				$message .= "<img style='width:550px;height:150px;' src='https://www.eastcoast2westcoast.com/e2w/public/images/E2W%20Header.png'/>";
				$message .= "<p style='color:black;'>Thanks, for registering for the ".$location['trip_location']." Vacation. We will be sending email with any new information to keep you updated as closely as possible with any changes. Here is the information that we have listed for you:</p>"; 
				$message .= "<p style='color:black;margin:7px 0px 1px;'><strong>Email:</strong> ".$email."</p>";
				$message .= "<p style='color:black;margin:1px 0px;'><strong>Name:</strong> ".$firstName." ".$lastName."</p>";
				$message .= "<p style='color:black;margin:1px 0px 7px;'><strong>Group:</strong> ".$package."</p>";
				$message .= "<p style='color:black;'>You can start your monthly payments now by selecting the 'Start Paying Now' button below which will enroll you in a monthly payment plan through PayPal for a ".$package.".</p>";
				$message .= "<button style='display:flex;border:none;background:none;'><a style='text-decoration:none;padding:5%;background:darkgray;border:outset 2px;border-radius: 5px;' href='https://www.eastcoast2westcoast.com/e2w/public/".str_ireplace(" ", "_", strtolower($location["trip_location"])).$location["trip_year"].".php?package=".str_ireplace(" ", "", strtolower($package))."&tag=".$userID."'>Start Paying Now</a></button>";
				$message .= "<p style='color:black;'>If any of the information is incorrect, please email us at administrator@eastcoast2westcoast.com.</p><p style='color:black;'>Thank you and have a nice day.</p>";
				$message .= "</div>";
				$message2 = "A new user has just registered for the ".$location["trip_location"]." Vacation. See below: <br/><strong>Name:</strong> ".$firstName." ".$lastName."<br/><strong>Email:</strong> ".$email;
				$email_message = wordwrap($message, 70, "\r\n");
				$email_message2 = wordwrap($message2, 70, "\r\n");
				$email_headers = "MIME-Version: 1.0" . "\r\n";
				$email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$email_headers .= "From: Eastcoast to Westcoast Admin<administrator@eastcoast2westcoast.com>" . "\r\n";
				
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->isHTML();
				$mail->Host = "mbox.freehostia.com";
				$mail->Port = 465;
				$mail->SMPTAuth = true;
				$mail->username = "tramaine.jackson@eastcoast2westcoast.com";
				$mail->password = "yahooo02";
				
				$mail->setFrom($admin, "Tramaine Jackson E2W");
				$mail->addAddress($to, $firstName." ".$lastName);
				$mail->Subject  = $subject;
				$mail->msgHTML($message);
				
				if(!$result = $mail->Send()) {
					echo "Makes it here 3";
					echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
					$_SESSION["message"] .= "Good Job";
					echo "Makes it here too";
				}
				// mail($to, $subject, $email_message, $email_headers);
				// mail($admin, $subject, $email_message2, $email_headers);
				
				mysqli_close($connect);

				$_SESSION["message"] .= "<li class='okItem'>Thanks, for registering for the " .$location["trip_location"]. ". We will be sending email with any new information to keep you updated as closely as possible with any changes. ";
				$_SESSION["message"] .= "Here is the information that we have listed for you:<br/><br/><strong>Email:</strong> ".$email."<br/><strong>Name:</strong> ".$firstName." ".$lastName."<br/>";
				$_SESSION["message"] .= "If any of the information is incorrect, please email us at administrator@eastcoast2westcoast.com.<br/><br/>Thank you and have a nice day.</li>";
				redirect_to(str_ireplace(" ", "_", strtolower($location["trip_location"])) . $location["trip_year"]. ".php");
			} else {
				$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or new user has not been added successfully.</li>";
				redirect_to(str_ireplace(" ", "_", strtolower($location["trip_location"])) . $location["trip_year"] . ".php");
			}
		}
	} else {
		$_SESSION["errors"] .= "<li class='errorItem'>User not logged in or new user has not been added successfully.</li>";
		redirect_to(str_ireplace(" ", "_", strtolower($location["trip_location"])) . $location["trip_year"] . ".php");
	}
?>