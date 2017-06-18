<?php 
require '../config/constant-config.php';
session_start();

// remove all session variables
session_unset();
// destroy the session 
session_destroy();
if(isset($_COOKIE["isLoggedIn"])){
	setcookie("isLoggedIn", "", time() - 3600);
	setcookie("isLoggedIn", "", time() - 3600, "/");
	setcookie("username", "", time() - 3600);
	setcookie("username", "", time() - 3600, "/");	
	setcookie("user_id", "", time() - 3600);
	setcookie("user_id", "", time() - 3600, "/");
	setcookie("admin", "", time() - 3600);
	setcookie("admin", "", time() - 3600, "/");
}
header('Location: '.URL.'login.php', TRUE, 302);
?>