<?php
	require_once("../include/court.php");
	if(isset($_POST['question_text'])) {
		$first_name = ucfirst(trim($_POST['first_name']));
		$last_name = ucfirst(trim($_POST['last_name']));
		$email_address = ucfirst(trim($_POST['email_address']));
		$question = ucfirst(trim($_POST['question_text']));
		$first_name = mysqli_real_escape_string($connect, $first_name);
		$last_name = mysqli_real_escape_string($connect, $last_name);
		$email_address = mysqli_real_escape_string($connect, $email_address);
		$question = mysqli_real_escape_string($connect, $question);
		$to = $email_address;
		$admin = "jacksond1961@yahoo.com";
		$subject = "Question Confirmation";
		$message = "Hey".$first_name."<br/><br/>We have received your question and will get back to you as soon as possible. Please see your information below, <br/>";
		$message .= "<strong>First Name:</strong> ".$first_name."\n<strong>Last Name:</strong> ".$last_name."\n<strong>Email Address:</strong>".$email_address."<br/>";
		$message .= "<strong>Your question:</strong> ".$question."<br/><br/>If any of the information is incorrect, please email us at administrator@eastcoast2westcoast.com.<br/><br/>Thank you and have a nice day.";
		$email_message = wordwrap($message, 70, "\r\n");
		$message2 = "EastCoast2WestCoast has just received the following question:\n"; 
		$message2 .= "<strong>First Name:</strong> ".$first_name."\n<strong>Last Name:</strong> ".$last_name."\n<strong>Email Address:</strong>".$email_address."\n";
		$message2 .= "<strong>Question:</strong> ".$question.".";
		$email_message2 = wordwrap($message2, 70, "\r\n");
		$email_header = "MIME-Version: 1.0" . "\r\n";
		$email_header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$email_header .= "From: Admin<administrator@eastcoast2westcoast.com>";
		$date = date("Y/m/d");

		$insert_query = "INSERT INTO `debjac6_db`.`travel_questions` (`first_name`, `last_name`, `user_email`, `user_question`, `date_question`)
						VALUE('$first_name', '$last_name', '$email_address', '$question', '$date')";
						
		mysqli_query($connect, $insert_query) or die ("Unable to connect to send information to E > W " . mysqli_error($connect));
		echo "<div id=question_confirmation_form><p>";
		echo "<p>Thanks for your inquiry. Please check your email account for confirmation that we received your question and you should hear from us within a day or so.
				You also can send us an email at administrator@eastcoast2westcoast.com <br><br>
				<strong>Email Address:</strong> ".$email_address."<br/><strong>Question:</strong> ".$question."</p></div>";
		mail($to, $subject, $email_message, $email_header);
		mail($admin, $subject, $email_message2, $email_header);
		mysqli_close($connect);
	}
?>