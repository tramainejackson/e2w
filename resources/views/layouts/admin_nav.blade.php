<div id="navi">
	<ul id="navi_list">
		<li>
			<a href="locations.php?locations=false" id="" class="navi_option" <?php echo isset($_GET["edit_trip"]) || isset($_GET["locations"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Locations</a>
			<ul>
				<li><a href="locations.php?add_trip=true" <?php echo isset($_GET["add_trip"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add Trips</a></li>
				<li><a href="locations.php?trip_activities=true" <?php echo isset($_GET["trip_activities"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add/Edit Trip Events</a></li>				
				<li><a href="locations.php?add_person=true" <?php echo isset($_GET["add_person"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add/Edit Persons</a></li>
			</ul>
		</li>
		<li>
			<a href="pictures.php" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/pictures.php" && !isset($_GET["add_pictures"]) && !isset($_GET["remove_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Pictures</a>
			<ul>
				<li><a href="pictures.php?add_pictures=true" <?php echo isset($_GET["add_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add Pictures</a></li>
				<li><a href="pictures.php?remove_pictures=true" <?php echo isset($_GET["remove_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Remove Pictures</a></li>
			</ul>
		</li>
		<li>
			<a href="{{ route('admin.index') }}" id="" class="navi_option" <?php echo isset($_GET["admin"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Users</a>
			<ul>
				<li><a href="{{ route('admin.create') }}" <?php echo isset($_GET["add_users"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add New Admin</a></li>
				<li><a href="{{ route('admin.index') }}" <?php echo isset($_GET["edit_users"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Edit Admin</a></li>
			</ul>
		</li>
		<li><a href="{{ route('admin.questions') }}" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/questions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Questions</a></li>
		<li><a href="{{ route('admin.suggestions') }}" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/suggestions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Suggestions</a></li>
		<li><a href="e2w_adminLogout.php" class="navi_option">Log Out</a></li>
	</ul>
</div>