<?php
session_start();
require '../config/db-config.php';
require '../config/constant-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["comment"])){
		echo $_POST["comment"];
	}
}
