<?php
	require_once("../include/court.php");
	$date = date("Y/m/d");
	$date1 = date("m/d/Y");

	if (isset($_POST['next_location']))
	{
		if($_POST['next_location'] == "Other")
		{
			$other = $_POST['next_location'];
			$suggestion = trim($_POST['other_location']);
			$suggestion = mysqli_real_escape_string($connect, $suggestion);
			$insert_query  = "INSERT INTO travel_suggestions ";
			$insert_query .= "(option_suggestion, comment_suggestion, date_suggestion) ";
			$insert_query .= "VALUE('$other', '$suggestion', '$date')";
			mysqli_query($connect, $insert_query) or die ("The suggestion was not received, please try again later.");
		}
		
		elseif($_POST['next_location'] != "Other")
		{
			$nextLocation = $_POST['next_location'];
			$insert_query2  = "INSERT INTO travel_suggestions ";
			$insert_query2 .= "(option_suggestion, date_suggestion) ";
			$insert_query2 .= "VALUE('$nextLocation', '$date')";
			mysqli_query($connect, $insert_query2) or die ("The suggestion was not received, please try again.");
		}
		else
		{
			echo "Your option didn't match any of the listed options. Please try again.";
		}

	}
	
	$getLocations = mysqli_query($connect, "SELECT option_suggestion FROM travel_suggestions GROUP BY option_suggestion;");
	$getTotalRows = mysqli_query($connect, "SELECT * FROM travel_suggestions;");
	$totalRows = mysqli_num_rows($getTotalRows);
	
	echo "<div id=suggestion_results>";
	echo "<h2>Suggestion Results as of ".$date1."</h2>";
	while($showLocations = mysqli_fetch_assoc($getLocations))
	{
		$getRows = mysqli_query($connect, "SELECT * FROM travel_suggestions WHERE option_suggestion='$showLocations[option_suggestion]'");
		$total = mysqli_num_rows($getRows);
		echo "<p>" . $showLocations['option_suggestion'] . " ..............." . round(($total/$totalRows) * 100) . "%</p>";
	}
	echo "</div>";

	mysqli_close($connect);				
?>