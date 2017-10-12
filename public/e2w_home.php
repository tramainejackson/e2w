<?php 
	include ('redirect3.php');
	session_start();	
	include('court.php');
	$query = "SELECT * FROM travel_videos";
	$run_query = mysqli_query($connect, $query);
	$results = mysqli_fetch_assoc($run_query);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>E->W</title></title>
	<meta charset="UTF-8"/><meta name="keywords" content="Travel, Family Traveling, East to West Travel, EastCoast2WestCoast"/>
	<meta name="description" content="Cruise, New Orleans Vacation, Motown Show, Jamaica Travel, Bahamas Travel"/>
	<meta name="description" content="I want to travel but don't know where"/>
	<meta name="viewport" content="width=device-width, intial-scale=1.0"/>
	<meta name="author" content="Guru"/>
	<link rel="stylesheet" type="text/css" href="/css/e2w_2.css"/>
	<link rel="stylesheet" type="text/css" href="/css/IE10_e2w.css"/>	
	<!--[if lte IE 9]> <link rel="stylesheet" type="text/css" href="/css/IE9_e2w.css"/> <![endif]-->
</head>
<body>
<div id="home_page" class="container">
	<?php include("e2w_modals.php"); include("east2west_contacts.html"); include("east2west_about_us.html"); include("question_suggestion_form.php"); ?>
	<div class="pictures_east_and_west_btns">
		<p>Check out some of the pictures from where we've been. Click on the location of the pictures you want to see.</p>
		<button id="bahamas" class="picture_button">Bahamas</button>
		<button id="bermuda" class="picture_button">Bermuda</button>
		<button id="cali" class="picture_button">California</button>
		<button id="caribbean" class="picture_button">Caribbean</button>
		<button id="jamaica" class="picture_button">Jamaica</button>
		<button id="las_vegas" class="picture_button">Las Vegas</button>
		<button id="new_york" class="picture_button">Motown</button>
		<button id="new_orleans" class="picture_button">New Orleans</button>
		<button id="st_louis" class="picture_button">St.Louis</button>
	</div>
	<div id="action_btns">
		<button id="home_btn" class="actionBtns" disabled>Home</button>
		<button id="question_btn" class="actionBtns">Ask A Question</button>
		<button id="suggestion_btn" class="actionBtns">Suggestions</button>
		<button id="contact_us_btn" class="actionBtns">Contact Us</button>
		<button id="about_us_btn" class="actionBtns">About Us</button>
		<button id="mobile_menu_btn"></button>
	</div>
	<div id="main_content" class="main_content_class">	
		<div id="header">
			<p>East Coast West Coast Travel</p>
		</div>		
		<div id="disney_event_link" class="whats_next_w">	
			<div id="disney_event">
				<div class="event_skirt"></div>
				<p class="event_header">Disney World</p>
				<p class="event_date">July 2017</p>
				<p class="more_info">Click for more information</p>
				<table class="west_calendar">
					<tr>
						<th class="header_data" id="date_data">Date</th>
						<th class="header_data" id="middle_th_data">Location</th>
						<th class="header_data" id="event_data">Event</th>
					</tr>
					
					<tr>
						<td>July 13</td>
						<td class="middle_data">Orlando, FL</td>
						<td>Magic Kingdom</td>
					</tr>

					<tr>
						<td>July 14</td>
						<td class="middle_data">Orlando, FL</td>
						<td>Epcot Center</td>
					</tr>	

					<tr>
						<td>Jule 15</td>
						<td class="middle_data">Orlando, FL</td>
						<td>Animal Kingdom</td>
					</tr>	
					
					<tr>
						<td>July 16</td>
						<td class="middle_data">Orlando, FL</td>
						<td>Hollywood Studios</td>
					</tr>				
				</table>
			</div>
		</div>	
		<div id="cruise_event_link" class="whats_next_w">
			<div class="event_overlay">
				<h1 class="status_complete">COMPLETED</h1>
				<a id="caribbean_pics_link">Photos and Videos Coming Soon</a>
				<!---<a id="cali_video_link" href="/videos/<?php echo $results['video_link']; ?>" target="_blank">Click here to see the Price Is Right Video</a> --->
			</div>
			<div id="cruise_event">
			<p class="event_header">Caribbean Cruise</p>
			<p class="event_date">February 2016</p>
			<p class="more_info">Click for more information</p>
				<table class="west_calendar">
					<tr>
						<th class="header_data" id="date_data">Date</th>
						<th class="header_data" id="middle_th_data">Location</th>
						<th class="header_data" id="event_data">Event</th>
					</tr>
					
					<tr>
						<td>2/20/2016</td>
						<td class="middle_data">Miami, FL</td>
						<td>Arrival</td>
					</tr>

					<tr>
						<td>2/21/2016</td>
						<td class="middle_data">Half Moon Cay, Bahamas</td>
						<td>See Itinerary</td>
					</tr>	

					<tr>
						<td>2/22/2016</td>
						<td class="middle_data">The Friendly Ocean</td>
						<td>Fun Day At Sea</td>
					</tr>	
					
					<tr>
						<td>2/23/2016</td>
						<td class="middle_data">St.Thomas, USVI</td>
						<td>See Itinerary</td>
					</tr>

					<tr>
						<td>2/24/2016</td>
						<td class="middle_data">San Juan, Puerto Rico</td>
						<td>See Itinerary</td>
					</tr>

					<tr>
						<td>2/25/2016</td>
						<td class="middle_data">Grand Turk</td>
						<td>See Itinerary</td>
					</tr>

					<tr>
						<td>2/26/2016</td>
						<td class="middle_data">The Friendly Ocean</td>
						<td>Fun Day At Sea</td>
					</tr>		

					<tr>
						<td>2/27/2016</td>
						<td class="middle_data">Miami, FL</td>
						<td>Departure</td>
					</tr>				
				</table>
			</div>			
		</div>
		<div class="whats_next_w">
			<div class="event_overlay">
				<h1 class="status_complete">COMPLETED</h1>
				<a id="cali_pics_link">Click here to see the recent photo's</a>
				<a id="cali_video_link" href="/videos/<?php echo $results['video_link']; ?>" target="_blank">Click here to see the Price Is Right Video</a>
			</div>
			<div id="cali_event">
				<p class="event_header">Hollywood</p>
				<p class="event_date">April 2015</p>
				<p class="more_info">Click for more information</p>
					<table class="west_calendar">
						<tr>
							<th class="header_data" id="date_data">Date</th>
							<th class="header_data" id="middle_th_data">Location</th>
							<th class="header_data" id="event_data">Event</th>
						</tr>
						
						<tr>
							<td>4/09/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>Arrival</td>
						</tr>

						<tr>
							<td>4/10/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>The Price is Right</td>
						</tr>	

						<tr>
							<td>4/11/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>Hollywood Tour</td>
						</tr>	
						
						<tr>
							<td>4/12/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>Explore on Your Own</td>
						</tr>

						<tr>
							<td>4/13/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>Universal Studios</td>
						</tr>				
						
						<tr>
							<td>4/14/2015</td>
							<td class="middle_data">Los Angeles, California</td>
							<td>Departure</td>
						</tr>				
					</table>	
			</div>			
		</div>
	</div>
	<video id="price_is_right" poster="/images/the_price_is_right.jpg" controls>
	  <source src="/videos/<?php echo $results['video_link']; ?>" type="video/mp4">
	</video>
	<footer>
		<p id="footer_title" class="footerItem"><b>Title: </b>E > W Travel</p>
		<p id="footer_creator" class="footerItem"><b>Creator: </b>Tramaine Jackson</p>
		<p id="footer_date" class="footerItem"><b>Created Date: </b>July 2014</p>
	</footer>
</div>	
<script src="/scripts/jquery-2.1.3.min.js"></script>
<script src="/scripts/eastwest_2.js"></script>
<script>
//Show video when page loads
	(function showVideo()
	{
		if(document.cookie)
		{
			setTimeout (function()
			{
				$("#price_is_right").show().appendTo(".maine_modal");
				$("p.modal_title").text("Check out our winner from The Price is Right. CONGRATS Sylvia!!!");
				$(".maine_overlay").fadeIn();
				$(".maine_modal").css({"top":"-50%"});
				$(".maine_modal").animate({top:"30%"});
				$(".maine_modal").animate({top:"8%"}, "slow").show();
			}, 1000);
		}
		else
		{
			$("#price_is_right").detach();
		}
	})();
</script>
</body>	
</html>