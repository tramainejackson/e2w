<div id="navi">
	<ul id="navi_list">
		<li>
			<a href="{{ route('location.index') }}" id="" class="navi_option" <?php echo isset($_GET["edit_trip"]) || isset($_GET["locations"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Locations</a>
			<ul>
				<li><a href="{{ route('location.create') }}" <?php echo isset($_GET["add_trip"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add Trips</a></li>
				<li><a href="{{ route('location.index') }}" <?php echo isset($_GET["trip_activities"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Edit Trip Events</a></li>				
			</ul>
		</li>
		<li>
			<a href="{{ route('pictures.index') }}" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/pictures.php" && !isset($_GET["add_pictures"]) && !isset($_GET["remove_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Pictures</a>
			<ul>
				<li><a href="{{ route('pictures.create') }}" <?php echo isset($_GET["add_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add Pictures</a></li>
				<li><a href="{{ route('pictures.index') }}" <?php echo isset($_GET["remove_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Remove Pictures</a></li>
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
		<li>
			<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
			
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</li>
	</ul>
</div>