<?php 
	session_start();
	if( isset( $_SESSION['counter'] ) )
	{
	  $_SESSION['counter'] += 1;
	}
	else
	{
	  $_SESSION['counter'] = 1;
	}
?>	
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>E->W</title></title>
	<meta charset="UTF-8"/><meta name="keywords" content="Travel, Family Traveling, East to West Travel, EastCoast2WestCoast"/>
	<meta name="description" content="Cruise, New Orleans Vacation, Motown Show, Jamaica Travel, Bahamas Travel"/>
	<meta name="description" content="I want to travel but don't know where"/>
	<meta name"viewport" content"width=device-width, intial-scale=1"/>
	<meta name="author" content="Guru"/>
	<link rel="stylesheet" type="text/css" href="/css/e2w_2.css"/>
	<link rel="stylesheet" type="text/css" href="/css/cruise_liner.css"/>
</head>
<body>
	<?php include('court.php'); include('e2w_modals.php'); include('east2west_contacts.html'); include('east2west_about_us.html'); include('question_suggestion_form.php'); ?>
	<div id="action_btns">
		<a href="index.php"><button id="home_btn">Home</button></a>
		<button id="question_btn">Ask A Question.</button>
		<button id="suggestion_btn">Suggestion</button>
		<button id="contact_us_btn">Contact Us</button>
		<button id="about_us_btn">About Us</button>
	</div>
	<div id="cruise_content" class="cruise_content_class">	
		<div id="cruise_content_info">
			<div id="cruise_background"></div>
			<h1>Cruise Extravaganza</h1>
			<div id="cruise_content_itinerary">
				<h2>Room Options:</h2>
					<ul>
						<li>Inside: $1,085 (per person)</li>
						<li>Ocean: $1,185 (per person)</li>
						<li>Balcony: $1,395 (per person)</li>
						<li>Includes taxes, port charges, roundtrip transfers in Miami, and estimated roundtrip air from PHL</li>
					</ul>
				<h2>Cruise Itinerary:</h2>
					<ul>
						<li>Day 1: Arrive at Miami, FL. Ship Departs at 4:00PM</li>
						<li>Day 2: Arrive at Half Moon Cay in the Bahamas at 9:00AM and departs at 5:00PM</li>
						<li>Day 3: Fun Day At Sea</li>
						<li>Day 4: Arrive at St.Thomas in the Virgin Islands at 10:00AM and departs at 6:00PM</li>
						<li>Day 5: Arrive at San Juan in Puerto Rico at 7:00AM and departs at 3:30PM</li>
						<li>Day 6: Arrive at Grand Turk in Turks and Caicos at 11:00 and departs at 5:30PM</li>
						<li>Day 7: Fun Day At Sea</li>
						<li>Day 8: Arrive back in Miami, FL at 8:00AM</li>
						<li><a href="/Files/Caribbean 2016 Cruise.pdf" title="Click here to open the Flyer" target="_blank">Click For Printable Flyer</a></li>
					</ul>	
				<p class="cruise_page_add_terms"><a href="#">See Terms and Conditions</a></p>	
			</div>
			<div id="cruise_page_terms_and_conditions">
				<p>Non-refundable deposit of $50.00 upon booking.</p>
				<p>Hotel rooms with doubles are limited on a first come, first serve basis. King rooms include a sofa bed. Travelers are responsible for gratuities and hotel incidentals.</p>
				<p>Airline tickets are non-refundable; Changes after ticketing will incur a change fee. Airline taxes and fees are subject to change and may require an increase in the final pricing.</p>
				<p>Non-refundable after final payment date, but may be transferrable. I will make every effort to transfer costs to avoid a personal loss in case of cancellation.</p>
				<p>Travel protection is available at an additional cost.</p>
				<p>Does not include the cost of local transportation to events.</p>
				<p>Game show is subject to change, based on availability of tickets.</p>
			</div>
		</div>	
		<div id="cruise_page_divider">
			<div id="cruise_page_divider_loader">
				<div class="cruise_page_signup_form">
					<p id="cruise_page_signup">Sign Up Form For Trip</p>
					<form id="cruiseSignUpForm" name="cruiseSignUpForm" method="POST">
						<table class="cruise_page_form_table">
							<tr><td><label for="first_name"><strong>First Name:</strong></label></td><td><input class="first_name_input" type="text" name="first_name" /></td></tr>
							<tr><td><label for="last_name"><strong>Last Name:</strong></label></td><td><input class="last_name_input" type="text" name="last_name" /></td></tr>
							<tr><td><label for="email"><strong>Email:</strong></label></td><td><input class="email_input" type="email" name="email" /></td></tr>
						</table>
						<button id="cruise_page_submit">Add Me To The Cruise Distribution List</button>
						<button id="cruise_page_pay_btn" class="show_pay_instructionsC">Pay for this Cruise Trip with PayPal</button>
						<div id="payment_instructions_cruise">
							<p>Please send all payments to jacksond1961@yahoo.com. <br/><a href="http://www.paypal.com" target="_blank">Click here</a> to go to the PayPal website.</p>
						</div>
					</form>	
				</div>
				<div class="cruise_page_confirmation_table">
					<?php
						$getCruiseInfo = mysqli_query($connect, "SELECT * FROM cruise_payment;");
						echo "<table id=cruise_page_distribution_list_confirmed>";	
						echo "<caption>Whose Going on the Cruise</caption>";								
						echo "<tr class=name_data_rows><th class=last_name_table_data>Last Name</th><th class=first_name_table_data>First Name</th></tr>";				
						while($row2 = mysqli_fetch_assoc($getCruiseInfo))
						{
							echo "<tr class=name_data_rows_cruise><td class=name_data>".$row2['lastname']."</td><td class=name_data>".$row2['firstname']."</td></tr>";
						}	
						echo "</table>";
					?>			
				</div>
			</div>	
		</div>
	</div>
	<footer>
		<p id=""><b>Title: </b>E > W Travel</p>
		<p id=""><b>Creator: </b>Tramaine Jackson</p>
		<p id=""><b>Created Date: </b>July 2014</p>
	</footer>
<script src="/scripts/jquery-2.1.3.min.js"></script>
<script src="/scripts/eastwest_2.js"></script>
</body>
</html>