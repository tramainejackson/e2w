<?php require_once("../include/initialize.php"); ?>
<?php noLogin_verification(); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>E->W</title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/e2w_2.css"/>
</head>
<body>
	<div id="admin_page">
		<?php require_once("../public/e2w_modals.php"); ?>
		<?php showSessionMessage(); ?>
		<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
		<?php require_once("../include/navigation.php"); ?>
		<?php $getAlluser = find_all_users(); ?>
		<?php if(isset($_GET["edit_users"])) { ?>
			<div class="adminDiv" id="all_users">
				<form name="update_user" class="" action="user_update.php" method="POST">
					<div id="pictures_page_header" class="">
						<h1 class="pageTopicHeader">Edit Admin</h1>
						<select name="current_username" class="userSelect" id="select_user_for_edit">
							<option value="blank" selected disabled>--Select A User--</option>
							<?php while($showuser = mysqli_fetch_assoc($getAlluser)) { ?>
								<?php if(isset($_GET["user"]) && $_GET["user"] == ucfirst($showuser["first_name"]).ucfirst($showuser["last_name"])) { ?>
									<option value="<?php echo $showuser["user_id"]; ?>" selected><?php echo ucfirst($showuser["first_name"]) . "&nbsp;" . ucfirst($showuser["last_name"]) . "(" . $showuser["username"] . ")"; ?></option>
								<?php } else { ?>
									<option value="<?php echo $showuser["user_id"]; ?>"><?php echo ucfirst($showuser["first_name"]) . "&nbsp;" . ucfirst($showuser["last_name"]) . "(" . $showuser["username"] . ")"; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<input type="submit" name="submit" value="Update User" class="" />
					</div>
					<?php if(isset($_GET["user"])) { ?>
						<?php $userInfo = find_admin_by_id($_GET["id"]); ?>
						<div class="newUser">
							<div class="editAdminInput">
								<span class="editAdminSpan">Firstname</span>
								<input type="text" name="first_name" class="" value="<?php echo $userInfo["first_name"]; ?>" placeholder="Firstname" />
							</div>
							<div class="editAdminInput">
								<span class="editAdminSpan">Lastname</span>
								<input type="text" name="last_name" class="" value="<?php echo $userInfo["last_name"]; ?>" placeholder="Lastname" />
							</div>
							<div class="editAdminInput">
								<span class="editAdminSpan">Username</span>
								<input type="text" name="username" class="" value="<?php echo $userInfo["username"]; ?>" placeholder="Username" />
							</div>
							<div class="editAdminInput">
								<span class="editAdminSpan">Password</span>
								<input type="text" name="password" class="" value="" placeholder="**********" />
							</div>
							<div class="editAdminInput">
								<span class="editAdminSpan">Active User</span>
								<select class="" name="active">
									<?php if($userInfo["active"] == "Y") { ?>
										<option value="Y" selected>Yes</option>
										<option value="N">No</option>
									<?php } else { ?>
										<option value="Y">Yes</option>
										<option value="N" selected>No</option>
									<?php } ?>
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
						<?php while($showAlluser = mysqli_fetch_assoc($getAlluser)) { ?>
							<?php if($showAlluser["username"] == $_SESSION["loggedIn"]) { ?>
								<li><?php echo $showAlluser["username"]; ?><span>&nbsp;- currently logged in user</span></li>
							<?php } else { ?>	
								<li><?php echo $showAlluser["username"]; ?></li>
							<?php } ?>
						<?php } ?>	
					</ul>
				</div>
			</div>
		<?php } ?>
		<script src="../public/scripts/jquery-2.1.3.min.js"></script>
		<script src="../public/scripts/eastwest_2.js"></script>
	</div>
</body>
</html>