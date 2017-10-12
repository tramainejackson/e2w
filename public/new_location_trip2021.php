<?php require_once("../include/sessions.php"); ?>
<?php require_once("../include/court.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php require_once("../include/header.php"); ?>
<body>
	<?php 
		include('e2w_modals.php'); 
		include('east2west_contacts.html'); 
		include('east2west_about_us.html'); 
		include('question_suggestion_form.php'); 
	?>
	<?php $showLocation = find_event_by_name("New Location Trip"); ?>
	<div id="action_btns">
		<button id="home_btn">Home</button>
		<button id="question_btn">Ask A Question</button>
		<button id="suggestion_btn">Suggestion</button>
		<button id="contact_us_btn">Contact Us</button>
		<button id="about_us_btn">About Us</button>
	</div>
	<div id="new_location_trip" class="content_class">
		<div class="content_info" style="background-image:url(images/<?php echo $showLocation["trip_photo"] != "" ? $showLocation["trip_photo"] : "skyline.jpg"; ?>)">
			<h1 class="vacation_header">New Location Trip</h1>
			<div class="vacationDescription">
				<?php if($showLocation["description"] != "") { ?>
					<h2 class="tripDescription"><?php echo $showLocation["description"]; ?></h2>
				<?php } else { ?>
					<h2 class="tripDescription">Your Trip Description Will Go Here</h2>
				<?php } ?>
			</div>
			<div class="vacationItenerary">
				<h2 class="vacationIteneraryHeader">Events For The Trip</h2>
				<ul class="termsItenery">
					<?php $getActivities = find_activities_by_trip_id($showLocation["trip_id"]) ?>
					<?php if(mysqli_num_rows($getActivities) >= 1) { ?>
						<?php while($showActivity = mysqli_fetch_assoc($getActivities)) { ?>
							<?php if($showActivity["show_activity"] == "Y") { ?>
								<li><?php echo $showActivity["trip_event"] . " " . $showActivity["activity_date"]; ?></li>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>	
						<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<div id="" class="vacationCost">
				<h2 class="paymentHeaders">Trip Cost</h2>
				<ul class="termsCost">
					<?php if($showLocation["cost"] != "") { ?>
						<?php $costOption = explode(";", $showLocation["cost"]) ?>
						<?php for($i=0; $i < count($costOption); $i++) { ?>
							<?php if($costOption[$i] != "") { ?>
								<li><?php echo trim($costOption[$i]); ?></li>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<div id="" class="vacationCost">
				<h2 class="paymentHeaders">Payment Options</h2>
				<ul class="termsPayment">
					<?php if($showLocation["payments"] != "") { ?>
						<?php $paymentOption = explode(";", $showLocation["payments"]) ?>
						<?php for($i=0; $i < count($paymentOption); $i++) { ?>
							<?php if($paymentOption[$i] != "") { ?>
								<li><?php echo trim($paymentOption[$i]); ?></li>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>	
						<li>Trip Payment schedule not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<p class="pageAddTerms">Click Here To See Terms And Conditions</p>
			<div id="page_terms_and_conditions">
				<p class="terms depositDate" id="">Deposit is Due No Later Than <span id="deposit_date"><?php echo $showLocation["deposit_date"] != null ? $showLocation["deposit_date"] : ""; ?></span></p>
				<p class="terms balanceDueDate" id="">Total Balance Must Be Paid In Full <span id="due_date"><?php echo $showLocation["due_date"] != null ? $showLocation["due_date"] : ""; ?></span></p>
				<?php if($showLocation["conditions"] != "") { ?>
					<?php $conditionOption = explode(";", $showLocation["conditions"]) ?>
					<?php for($i=0; $i < count($conditionOption); $i++) { ?>
						<?php if($conditionOption[$i] != "") { ?>
							<p class="terms"><?php echo trim($conditionOption[$i]); ?></p>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<?php if($showLocation["flyer_name"] != "") { ?>
					<p class="terms"><a href="../files/<?php echo $showLocation["flyer_name"]; ?>" title="Click here to open the Flyer" target="_blank">Click Here For A Printable Flyer</a></p>
				<?php } ?>
			</div>
		</div>	
		<div class="page_divider">
			<div class="page_signup_form">
				<form class="" action="user_signup.php" method="POST" enctype="multipart/form-data">
					<table class="formTable">
						<caption class="page_signup">Sign Up For Trip</caption>
						<tr>
							<td><label for="first_name"><strong>First Name:</strong></label></td>
							<td><input class="first_name_input" type="text" name="first_name" /></td>
						</tr>
						<tr>
							<td><label for="last_name"><strong>Last Name:</strong></label></td>
							<td><input class="last_name_input" type="text" name="last_name" /></td>
						</tr>
						<tr>
							<td><label for="email"><strong>Email:</strong></label></td>
							<td><input class="email_input" type="email" name="email" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="submit" class="pageSubmit" value="Send Me Info" /></td>
						</tr>
					</table>
					<input type="text" name="trip_id" class="" value="<?php echo $showLocation["trip_id"]; ?>" hidden />
					<div class="paymentInstructions">
						<p>For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family.<a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
					</div>
				</form>	
			</div>
			<div class="pageConfirmationTable">
				<?php $getEventUsers = find_event_users($showLocation["trip_location"]); ?>
				<div class="tripUsers">
					<table>
						<caption>See Whose Already Going</caption>
						<?php if(mysqli_num_rows($getEventUsers) >= 1) {  ?>
							<tr>
								<th>First</th>
								<th>Last</th>
							</tr>
							<?php while($user = mysqli_fetch_assoc($getEventUsers)) { ?>
								<tr>
									<td><?php echo $user["first_name"]; ?></td>
									<td><?php echo $user["last_name"]; ?></td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td colspan="2">No users have signed up for the trip yet</td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<!--- <div class="registrationForm">
				<p>Please provide just a little more information for us. We want to make sure that we get back to you with the best price available for you and your family.</p>
				<form name="registration_form" action="user_update.php" method="POST">
					<ul class="rf_ul">
						<li><label for="first_name" class="labelRF">First Name:</label><input type="text" name="first_name" id="RF_firstName" class="rfInput" disabled /></li>
						<li><label for="last_name" class="labelRF">Last Name:</label><input type="text" name="last_name" id="RF_lastName" class="rfInput" disabled /></li>
						<li><label for="email" class="labelRF">Email Address:</label><input type="text" name="email" id="RF_email" class="rfInput" disabled /></li>
						<li><label for="adults" class="labelRF">Number of Adults:</label><input type="number" name="adults" id="RF_numAdults" class="rfInput" min="0" max="10" /></li>
						<li class="li_numKids"><label for="children" class="labelRF">Number of Children:</label><input type="number" name="children" id="RF_numKids" class="rfInput" min="0" max="10" /></li>
						<li><label for="room_type" class="labelRF">Select A Room Type:</label>
							<select name="room_type" id="room_type_select">
								<option value="mermaid_suite">The Little Mermaid Standard Room</option>
								<option value="lion_king_suite">Lion King Family Suite</option>
								<option value="cars_suite">Cars Family Suite</option>
								<option value="finding_nemo_suite">Finding Nemo Family Suite</option>
							</select>
						</li>
					</ul>		
					<div id="bed_type_options">
						<h3 id="additional_options_header">Little Mermaid Room Option</h3>
						<input type="radio" name="bed_type" value="king" class="rfInputBeds" checked /><span>1 King Bed</span>
						<input type="radio" name="bed_type" value="doubles" class="rfInputBeds" /><span>2 Double Beds</span>
					</div>
				</form>
				<button class="confirm_registration">Send Information</button>
			</div>
		</div> --->
		<div id="loading_image">
			<img src="/images/ajax-loader (1).gif">
		</div>
		<?php require_once("../include/footer.php"); ?>
</body>
</html>