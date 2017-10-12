<?php require_once("../include/initialize.php"); ?>
<?php require_once("../include/header.php"); ?>
<body>
	<?php 
		include('e2w_modals.php'); 
		include('east2west_contacts.html'); 
		include('east2west_about_us.html'); 
		include('question_suggestion_form.php'); 
	?>
	<?php $showLocation = find_event_by_name("Disney World"); ?>
	<?php showSessionMessage(); ?>
	<?php $plan; ?>
	<div id="action_btns">
		<button id="home_btn" class="actionBtns">Home</button>
		<button id="question_btn" class="actionBtns">Ask A Question</button>
		<button id="suggestion_btn" class="actionBtns">Suggestion</button>
		<button id="contact_us_btn" class="actionBtns">Contact Us</button>
		<button id="about_us_btn" class="actionBtns">About Us</button>
	</div>
	<div id="mobile_action_btns">
		<div class="">
			<a href="#">Menu</button>
		</div>
		<div class="mobileBtns">
			<button id="home_btn" class="actionBtns">Home</button>
			<button id="question_btn" class="actionBtns">Ask A Question</button>
			<button id="suggestion_btn" class="actionBtns">Suggestion</button>
			<button id="contact_us_btn" class="actionBtns">Contact Us</button>
			<button id="about_us_btn" class="actionBtns">About Us</button>
		</div>
	</div>
	<div id="disney_world" class="content_class">
		<?php if(!isset($_GET["tag"]) || !isset($_GET["package"])) { ?>
			<div class="content_info" style="background-image:url(images/<?php echo $showLocation["trip_photo"] != "" ? $showLocation["trip_photo"] : "skyline.jpg"; ?>)">
				<h1 class="vacation_header">Disney World</h1>
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
									<li><?php echo $showActivity["trip_event"] . " " . datetime_to_us($showActivity["activity_date"]); ?></li>
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
				<?php if($showLocation["inclusions"] != "") { ?>
					<div class="vacationCost">
						<h2 class="paymentHeaders">Trip Inclusions</h2>
						<ul class="termsInclusions" style="display:none;">
							<?php $inclusions = explode(";", $showLocation["inclusions"]) ?>
							<?php for($i=0; $i < count($inclusions); $i++) { ?>
								<?php if($inclusions[$i] != "") { ?>
									<li><?php echo trim($inclusions[$i]); ?></li>
								<?php } ?>
							<?php } ?>
						</ul>
						<button class="inclusionsBtn">Click Here To See What's All Included</button>
					</div>
				<?php } ?>
				<div id="page_terms_and_conditions">
					<p class="terms depositDate" id="">Deposit is Due No Later Than <span id="deposit_date"><?php echo $showLocation["deposit_date"] != null ? datetime_to_text($showLocation["deposit_date"]) : ""; ?></span></p>
					<p class="terms balanceDueDate" id="">Total Balance Must Be Paid In Full <span id="due_date"><?php echo $showLocation["due_date"] != null ? datetime_to_text($showLocation["due_date"]) : ""; ?></span></p>
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
					<form class="signupForm" id="" action="user_signup.php" method="POST" enctype="multipart/form-data">
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
								<td><label for="group"><strong>Group:</strong></label></td>
								<td>
									<select name="group">
										<option value="blank" disabled selected>Select A Group</option>
										<option value="Family of 2">Family of 2 : $125.00 USD - monthly</option>
										<option value="Family of 3">Family of 3 : $156.00 USD - monthly</option>
										<option value="Family of 4">Family of 4 : $190.00 USD - monthly</option>
										<option value="Family of 5">Family of 5 : $290.00 USD - monthly</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" name="submit" class="pageSubmit" value="Sign Me Up" /></td>
							</tr>
							<tr hidden>
								<input type="text" name="trip_id" class="" value="<?php echo $showLocation["trip_id"]; ?>" hidden />
							</tr>
						</table>
					</form>	
				</div>
				<div class="">
					<h2 class="orDivider">OR</h2>
				</div>
				<div class="paymentInstructions">
					<p>For everyone who has a PayPal account and would like to pay electronically, please send all payments to jacksond1961@yahoo.com by selecting the option to send money to friends and family.<a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
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
			</div>
		<?php } else { ?>
			<?php $eventUser = find_event_user("Disney World", $_GET["tag"]); ?>
			<?php if($eventUser["paid_in_full"] == "N") { ?>
			<?php 
				switch($eventUser["package"]) {
					case "Family of 2":
						$plan = "DISFM2";
						break;
					case "Family of 3":
						$plan = "DISFM3";
						break;
					case "Family of 4":
						$plan = "DISFM4";
						break;
					case "Family of 5":
						$plan = "DISFM5";
						break;
					default:
						$plan = "";
				}
			?>
				<div class="content_info" style="background-image:url(images/<?php echo $showLocation["trip_photo"] != "" ? $showLocation["trip_photo"] : "skyline.jpg"; ?>)">
					<div class="payPalDiv">
						<h1 class="vacation_header">Disney World</h1>
						<?php if(!isset($_GET["reoccuring"]) && !isset($_GET["onetime"])) { ?>
							<div class="signedUpContent">
								<div class="signedUpMessage">
									<p class="">Thanks for signing up to go to the Disney World vacation. This one will definently 
										be one to be remembered. Here is the information that we have for you when you signed up. If everything looks correct, 
										select subscribe and you will be redirected to PayPal and setup with monthly automatic payments. If anything has changed, 
										please feel free to email us at <a href="mailto:administrator@eastcoast2westcoast.com" class="">administrator@eastcoast2westcoast.com</a> with any changes we need to make.</p>
								</div>
								<div class="signedUpBio">
									<div class="">
										<span>Name: </span>
										<span><?php echo $eventUser["first_name"] . " " . $eventUser["last_name"]; ?></span>
									</div>
									<div class="">
										<span>Signed Up: </span>
										<span><?php echo datetime_to_text($eventUser["signup_date"]); ?></span>
									</div>
									<div class="">
										<span>Group: </span>
										<span><?php echo $eventUser["package"]; ?></span>
									</div>
								</div>
								<div class="">
									<a href="disney_world2017.php?package=<?php echo $_GET["package"];?>&tag=<?php echo $_GET["tag"];?>&onetime=true">One Time Payment</a>
								</div>
								<div class="">
									<a href="disney_world2017.php?package=<?php echo $_GET["package"];?>&tag=<?php echo $_GET["tag"];?>&reoccuring=true">Reoccuring Payments</a>
								</div>
							</div>
						<?php } else { ?>
							<?php if(isset($_GET["reoccuring"])) { ?>
								<div class="signedUpContent reoccuringDiv">
									<div class="">
										<h2 class="">Reoccuring Monthly Payments</h2>
									</div>
									<div class="payPalBtnDiv">
										<h3 class="">PayPal</h3>
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
											<input type="hidden" name="cmd" value="_s-xclick">
											<input type="hidden" name="hosted_button_id" value="EWVFTQAAEX3EJ">
											<table>
											<tr><td><input type="hidden" name="on0" value="Group">Group</td></tr><tr><td><select name="os0">
												<?php if($eventUser["package"] == "Family of 2") { ?>
													<option value="Family of 2" selected>Family of 2 : $125.00 USD - monthly</option>
												<?php } elseif($eventUser["package"] == "Family of 3") { ?>
													<option value="Family of 3" selected>Family of 3 : $156.00 USD - monthly</option>
												<?php } elseif($eventUser["package"] == "Family of 4") { ?>
													<option value="Family of 4" selected>Family of 4 : $190.00 USD - monthly</option>
												<?php } elseif($eventUser["package"] == "Family of 5") { ?>
													<option value="Family of 5" selected>Family of 5 : $290.00 USD - monthly</option>
												<?php } ?>
											</select> </td></tr>
											</table>
											<input type="hidden" name="currency_code" value="USD">
											<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
											<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</form>
									</div>
									<div class="ccBtnDiv">
										<h3 class="">Credit Card</h3>
										<div class="">
											<img src="images/credit_cards.png" class="" />
										</div>
										<div class="">
											<form action="swype.php" method="POST">
											  <script
												src="https://checkout.stripe.com/checkout.js" class="stripe-button"
												data-key="pk_test_zG95NHdlwkOpxsIzPXL6tojc"
												data-amount="<?php if($eventUser["package"] == "Family of 2"){ echo "12500"; }elseif($eventUser["package"] == "Family of 3"){ echo "15600"; }elseif($eventUser["package"] == "Family of 4"){ echo "19000"; }elseif($eventUser["package"] != "Family of 5"){ echo "29000"; }?>"
												data-name="E2W"
												data-description="<?php echo $eventUser["package"]; ?>"
												data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
												data-zip-code="true"
												data-label="<?php if($eventUser["reocurring_payments"] != "Y"){ echo "Make First Payment"; }else{ echo "Payments Already Started"; }?>"
												data-locale="auto">
											  </script>
											  <input hidden type="text" name="plan" class="" value="<?php echo $plan; ?>" />
											</form>	
										</div>
									</div>
									<div class="">
										<a href="disney_world2017.php?package=<?php echo $_GET["package"];?>&tag=<?php echo $_GET["tag"];?>&onetime=true">Switch To One Time Payment</a>
									</div>
								</div>
							<?php } elseif(isset($_GET["onetime"])) { ?>
								<div class="signedUpContent onetimeDiv">
									<div class="payPalBtnDiv">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
											<input type="hidden" name="cmd" value="_s-xclick">
											<input type="hidden" name="hosted_button_id" value="EWVFTQAAEX3EJ">
											<table>
											<tr><td><input type="hidden" name="on0" value="Group">Group</td></tr><tr><td><select name="os0">
												<?php if($_GET["package"] == "familyof2") { ?>
													<option value="Family of 2" selected>Family of 2 : $125.00 USD - monthly</option>
												<?php } elseif($_GET["package"] == "familyof3") { ?>
													<option value="Family of 3" selected>Family of 3 : $156.00 USD - monthly</option>
												<?php } elseif($_GET["package"] == "familyof4") { ?>
													<option value="Family of 4" selected>Family of 4 : $190.00 USD - monthly</option>
												<?php } elseif($_GET["package"] == "familyof5") { ?>
													<option value="Family of 5" selected>Family of 5 : $290.00 USD - monthly</option>
												<?php } ?>
											</select> </td></tr>
											</table>
											<input type="hidden" name="currency_code" value="USD">
											<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
											<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</form>
									</div>
									<div class="ccBtnDiv">
										<h3 class="">Credit Card</h3>
										<div class="">
											<img src="images/credit_cards.png" class="" />
										</div>
										<div class="">
											<form action="swype.php" method="POST">
											  <script
												src="https://checkout.stripe.com/checkout.js" class="stripe-button"
												data-key="pk_test_zG95NHdlwkOpxsIzPXL6tojc"
												data-amount="12500"
												data-name="E2W"
												data-description="Family of 3"
												data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
												data-zip-code="true"
												data-label="Sign Up For Monthly Payments"
												data-locale="auto">
											  </script>
											</form>	
										</div>
									</div>
									<div class="">
										<a href="disney_world2017.php?package=<?php echo $_GET["package"];?>&tag=<?php echo $_GET["tag"];?>&reoccuring=true">Switch To Reoccuring Payments</a>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="">
					<h1 class="">This page is no longer active</h1>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
	<div id="loading_image">
		<!--- <img src="/images/ajax-loader (1).gif"> --->
	</div>
	<?php require_once("../include/footer.php"); ?>
</body>
</html>