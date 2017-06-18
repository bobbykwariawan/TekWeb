<?php
	$db_servername = "mysql.idhostinger.com";
	$db_username = "u379777851_user";
	$db_password = "bobbybobbybobby";
	$db_name = "u379777851_poll";

	// Create connection
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>