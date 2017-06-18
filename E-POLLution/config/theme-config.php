<?php			
	
	if(isset($_COOKIE["isLoggedIn"])){
		$_SESSION["isLoggedIn"] = TRUE;
	    $_SESSION["username"] = $_COOKIE["username"];
	    $_SESSION["user_id"] = $_COOKIE["user_id"];
	    $_SESSION["admin"] = $_COOKIE["admin"];
	}

	if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE) { 
	    $sql = "SELECT theme FROM user_table WHERE user_id = $_SESSION[user_id]";
	    $result = $conn->query($sql); 
	    $themes = $result->fetch_array();
	    $theme = $themes[0];
	}

	else{
		if(isset($_SESSION["theme"])){			
			$theme = $_SESSION["theme"];	

		}
		else{			
			$theme=0;
		}
	}
?>