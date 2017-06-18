<?php
  require '../config/db-config.php';
  require '../config/constant-config.php';
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  	if(isset($_POST["updateavatar"])){
      if($_POST['avatar']==""){
        $_POST['avatar']='https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg';
      }
  		$sql = "UPDATE user_table
  				    SET avatar = '$_POST[avatar]'				
  				    WHERE user_id = $_SESSION[edit_user]";
  		if ($conn->query($sql) === TRUE) {
  			$_SESSION["updateAlert"]=TRUE;
  			header('Location: '.URL.'profile.php?user='.$_SESSION["edit_user"], TRUE, 302);
		  }
  		else{
  			echo "Error: " . $sql . "<br>" . $conn->error;
  		}
  	}

  	else if(isset($_POST["updatepass"])){
  		$sql = "SELECT * FROM user_table WHERE user_name = '$_SESSION[username]'";
  		$result = $conn->query($sql);
  		if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if(password_verify($_POST["currpass"], $row["password"])==1){
            $newpass = password_hash($_POST["newpass"], PASSWORD_DEFAULT);
      			$sql = "UPDATE user_table
    		  			    SET password = '$newpass'				
    		  		 	    WHERE user_id = $_SESSION[edit_user]";
    		  	if ($conn->query($sql) === TRUE) {
    	  			$_SESSION["updateAlert"]=TRUE;
    	  			header('Location: '.URL.'profile.php?user='.$_SESSION["edit_user"], TRUE, 302);
    	  		}	
    	  		else{
    	  			echo "Error: " . $sql . "<br>" . $conn->error;
    	  		}
          }
          else{
            $_SESSION["wrongAlert"] = TRUE;
            header('Location: '.URL.'profile.php?user='.$_SESSION["edit_user"], TRUE, 302);
          }
        }
	  	}
  	}
  	$conn->close();
  }
?>