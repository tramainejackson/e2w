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
	<?php $showLocation = find_event_by_name("Testing Trip"); ?>
	<div id="action_btns">
		<button id="home_btn">Home</button>
		<button id="question_btn">Ask A Question</button>
		<button id="suggestion_btn">Suggestion</button>
		<button id="contact_us_btn">Contact Us</button>
		<button id="about_us_btn">About Us</button>
	</div>
	<div id="Testing Trip" class="trip_information">
		<div class="content_info" style="background-image:url(images/<?php echo $showLocation["trip_photo"]; ?>)">
			<h1 class="vacation_header">Testing Trip</h1>
			<div class="vacation_itenerary">
				<h2 class="vacation_itenerary_header">What's Included</h2>
				<ul class="termsItenery">
					<?php $getTerms = find_location_terms($showLocation["trip_id"]); ?>
					<?php if(mysqli_num_rows($getTerms) >= 1) { ?>
						<?php while($showTerms = mysqli_fetch_assoc($getTerms)) { ?>
							<?php if($showLocation["term_type"] == "itenerary") { ?>
								<li><?php echo $showTerms["term_content"]; ?></li>
							<?php } ?>	
						<?php } ?>
					<?php } else { ?>	
							<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<div id="" class="tripCost">
				<h2 class="paymentHeaders">Trip Cost</h2>
				<ul class="termsCost">
					<?php if(mysqli_num_rows($getTerms) >= 1) { ?>
						<?php while($showTerms = mysqli_fetch_assoc($getTerms)) { ?>
							<?php if($showLocation["term_type"] == "cost") { ?>
								<li><?php echo $showTerms["term_content"]; ?></li>
							<?php } ?>	
						<?php } ?>
					<?php } else { ?>	
							<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<div id="" class="tripCost">
				<h2 class="paymentHeaders">Payment Options</h2>
				<ul class="termsPayment">
					<?php if(mysqli_num_rows($getTerms) >= 1) { ?>
						<?php while($showTerms = mysqli_fetch_assoc($getTerms)) { ?>
							<?php if($showLocation["term_type"] == "payment") { ?>
								<li><?php echo $showTerms["term_content"]; ?></li>
							<?php } ?>	
						<?php } ?>
					<?php } else { ?>	
							<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
			</div>
			<p class="pageAddTerms">Click Here To See Terms And Conditions</p>
			<div id="page_terms_and_conditions">
				<p class="terms depositDate" id=""><b>Deposit is Due No Later Than <span id="deposit_date"><?php echo $showLocation["deposit_date"] != null ? $showLocation["deposit_date"] : ""; ?></span></b></p>
				<p class="terms balanceDueDate" id=""><b>Total Balance Must Be Paid In Full <span id="due_date"><?php echo $showLocation["due_date"] != null ? $showLocation["due_date"] : ""; ?></span></b></p>
				<ul class="termsConditions">
					<?php if(mysqli_num_rows($getTerms) >= 1) { ?>
						<?php while($showTerms = mysqli_fetch_assoc($getTerms)) { ?>
							<?php if($showLocation["term_type"] == "condition") { ?>
								<li><?php echo $showTerms["term_content"]; ?></li>
							<?php } ?>	
						<?php } ?>
					<?php } else { ?>	
							<li>Trip Itenerary not added yet</li>
					<?php } ?>
				</ul>
				<p class="terms"><a href="/files/<?php echo $showLocation["flyer_name"]; ?>" title="Click here to open the Flyer" target="_blank">Click Here For A Printable Flyer</a></p>
			</div>
		</div>	
		<div class="page_divider">
			<div class="page_signup_form">
				<p class="page_signup">Sign Up For Trip</p>
				<form class="" action="user_signup.php" method="POST" enctype="multipart/form-data">
					<table class="page_form_table">
						<tr><td><label for="first_name"><strong>First Name:</strong></label></td><td><input class="first_name_input" type="text" name="first_name" /></td></tr>
						<tr><td><label for="last_name"><strong>Last Name:</strong></label></td><td><input class="last_name_input" type="text" name="last_name" /></td></tr>
						<tr><td><label for="email"><strong>Email:</strong></label></td><td><input class="email_input" type="email" name="email" /></td></tr>
					</table>
					<button class="pageSubmit">Add Me To Email List</button>
					<button class="pagePayBtn showPayInstructions">Pay For Trip with PayPal</button>
					<div class="paymentInstructions">
						<p>Please send all payments to jacksond1961@yahoo.com. <br/><a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
					</div>
				</form>	
			</div>
			<div class="pageConfirmationTable">
				<?php $getEventUsers = find_event_users($showLocation["trip_location"]); ?>
				<div class="tripUsers">
					<table>
						<tr>
							<th colspan="2">Name</th>
							<th colspan="2">Contact Info</th>
							<th>Additional</th>
						</tr>
						<tr>
							<th>First</th>
							<th>Last</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Notes</th>
						</tr>
						<?php while($user = mysqli_fetch_assoc($getEventUsers)) { ?>
							<?php if(mysqli_num_rows($getEventUsers) >= 1) { ?>
								<tr>
									<td><?php echo $user["first_name"]; ?></td>
									<td><?php echo $user["last_name"]; ?></td>
									<td><?php echo $user["email_address"]; ?></td>
									<td><?php echo $user["phone"]; ?></td>
									<td><?php echo $user["notes"]; ?></td>
								</tr>
							<?php } else { ?>
								<tr>
									<td>No users have signed up for the trip yet</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</table>
				</div>
			</div>
			<div class="registrationForm">
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
		</div>
		<div id="loading_image">
			<img src="/images/ajax-loader (1).gif">
		</div>
		<?php require_once("../include/footer.php"); ?>
</body>
</html>