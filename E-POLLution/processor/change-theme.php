<?php 
session_start();
require '../config/db-config.php';
require '../config/constant-config.php';
require '../config/theme-config.php';
			
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE) {
	if($theme==0){
		$sql = "UPDATE user_table 
        		SET theme = 1
        		WHERE user_id = $_SESSION[user_id]";
       	if ($conn->query($sql) === TRUE) {
       		header('Location: '.$_SERVER["HTTP_REFERER"], TRUE, 302);
		}
		else{
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	else{
		$sql = "UPDATE user_table 
        		SET theme = 0
        		WHERE user_id = $_SESSION[user_id]";
       	if ($conn->query($sql) === TRUE) {
       		header('Location: '.$_SERVER["HTTP_REFERER"], TRUE, 302);
		}
		else{
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
}

else{
	if($theme==0){	
		$_SESSION["theme"]=1;
		header('Location: '.$_SERVER["HTTP_REFERER"], TRUE, 302);
	}
	else{	
		$_SESSION["theme"]=0;
		header('Location: '.$_SERVER["HTTP_REFERER"], TRUE, 302);
	}
}

?>