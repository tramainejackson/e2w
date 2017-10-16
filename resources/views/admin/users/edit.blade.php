@extends('layouts.app')
	@section('styles')
		<!-- Bootstrap core CSS -->
		<link href="/css/app.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="/css/e2w_2.css" rel="stylesheet">
	@endsection
	
	@section('scripts')
		<!-- Bootstrap core JS -->
		<script src="/js/app.js"></script>
		<script src="/js/eastwest_2.js"></script>
	@endsection

	@section('content')
		<div id="admin_page">
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
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
						<a href="e2w_admin.php?admin=false" id="" class="navi_option" <?php echo isset($_GET["admin"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Users</a>
						<ul>
							<li><a href="e2w_admin.php?add_users=true" <?php echo isset($_GET["add_users"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Add New Admin</a></li>
							<li><a href="e2w_admin.php?edit_users=true" <?php echo isset($_GET["edit_users"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Edit Admin</a></li>
						</ul>
					</li>
					<li><a href="questions.php" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/questions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Questions</a></li>
					<li><a href="suggestions.php" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/suggestions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Suggestions</a></li>
					<li><a href="e2w_adminLogout.php" class="navi_option">Log Out</a></li>
				</ul>
			</div>

			<?php $getAlluser = App\User::all(); ?>
			<?php if(isset($_GET["edit_users"])) { ?>
				<div class="adminDiv" id="all_users">
					<form name="update_user" class="" action="user_update.php" method="POST">
						<div id="pictures_page_header" class="">
							<h1 class="pageTopicHeader">Edit Admin</h1>
							<select name="current_username" class="userSelect" id="select_user_for_edit">
								<option value="blank" selected disabled>--Select A User--</option>
							</select>
							<input type="submit" name="submit" value="Update User" class="" />
						</div>
						<?php if(isset($_GET["user"])) { ?>
							<div class="newUser">
								<div class="editAdminInput">
									<span class="editAdminSpan">Firstname</span>
									<input type="text" name="first_name" class="" value="" placeholder="Firstname" />
								</div>
								<div class="editAdminInput">
									<span class="editAdminSpan">Lastname</span>
									<input type="text" name="last_name" class="" value="" placeholder="Lastname" />
								</div>
								<div class="editAdminInput">
									<span class="editAdminSpan">Username</span>
									<input type="text" name="username" class="" value="" placeholder="Username" />
								</div>
								<div class="editAdminInput">
									<span class="editAdminSpan">Password</span>
									<input type="text" name="password" class="" value="" placeholder="**********" />
								</div>
								<div class="editAdminInput">
									<span class="editAdminSpan">Active User</span>
									<select class="" name="active">
									</select>
								</div>
							</div>
						<?php } ?>
					</form>
				</div>
			<?php } elseif(isset($_GET["add_users"])) { ?>
				<div class="adminDiv" id="all_users">
					<div id="users_page_header" class="">
						<h1 class="pageTopicHeader">Add New Admins</h1>
					</div>
					<div class="newUser">
						<form name="new_admin_user" class="" action="users_add.php" method="POST">
							<div class="newAdminInput">
								<input type="text" name="first_name" class="" placeholder="Firstname" />
							</div>
							<div class="newAdminInput">
								<input type="text" name="last_name" class="" placeholder="Lastname" />
							</div>
							<div class="newAdminInput">
								<input type="text" name="username" class="" placeholder="Username" />
							</div>
							<div class="newAdminInput">
								<input type="text" name="password" class="" placeholder="Password" />
							</div>
							<div class="newAdminInput">
								<select class="" name="active">
									<option value="" selected disabled>---Make Account Active---</option>
									<option value="Y">Yes</option>
									<option value="N">No</option>
								</select>
							</div>
							<div class="newAdminInput">
								<input type="submit" name="submit" value="Add User" class="" />
							</div>
						</form>
					</div>
				</div>
			<?php } else { ?>
				<div class="adminDiv" id="all_users">
					<div id="users_page_header" class="">
						<h1 class="pageTopicHeader">All Admins</h1>
					</div>
					<div id="all_users">
						<ul>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	@endsection