<?php
	define("DB_SERVER", "127.0.0.1");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "root1");
	define("DB_NAME", "debjac6_db");
	
	//Create database connection
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	//Test if connection succeeded
	if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>