<?php require_once("../include/initialize.php"); ?><?php	if(isset($_POST["submit"])) {		$pin = $_POST["pin"];		$username = $_POST["username"];		if($login = attempt_admin_login($username, $pin)) {			redirect_to("e2w_admin.php?admin=false");		}	}?><!DOCTYPE html><html lang="en-US"><head>	<title>E->W</title></title>	<link rel="stylesheet" type="text/css" href="../public/css/e2w_2.css"/>	<link rel="stylesheet" type="text/css" href="../public/css/e2w_IE10.css"/>	<!--[if lte IE 9]> <script>window.open("../public/oldBrowser/index.php", "_self");</script> <![endif]-->	<script src="../public/scripts/jquery-2.1.3.min.js"></script>	<script src="../public/scripts/eastwest_2.js"></script>	</head><body id="admin_page_login"><script>document.getElementById('admin_page_login').style.minHeight = window.innerHeight+"px";</script>	<?php include("../public/e2w_modals.php"); ?>	<?php showSessionMessage(); ?>	<h1 id="admin_header">East Coast West Coast Travel</h1>	<div id="admin_login">		<div>			<h2 id="login_div_header">Administrator Login</h2>		</div>		<form id="admin_form" method="POST" action="index.php">			<ul>				<li><input type="text" class="adminPin" name="username" placeholder="Username" /></li>				<li><input type="password" class="adminPin" name="pin" placeholder="Pin" /></li>			</ul>			<input type="submit" name="submit" id="admin_login_btn" value="Log In" />		</form>	</div></body></html>