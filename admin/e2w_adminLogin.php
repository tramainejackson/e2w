<?php
	$pin = isset($_POST['pin']) ? md5($_POST['pin']) : "";
	$username = isset($_POST['username']) ? md5($_POST['username']) : "";
	if(($pin == "dd35fa3a0675c7b01c2a7e3979a70ed8") && ($username == "6b62199a0347b81ad90ecb763b9b9b3a" || $username == "ddcc4aadf313bfa5ce293d4be4a079bd" || $username == "60e8c535fa34ce89e1b06c43695c0191"))
	{
		setCookie("admin", $username);
	}
		else
	{
		echo "Wrong password";
	}
?>