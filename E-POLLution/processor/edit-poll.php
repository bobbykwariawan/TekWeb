<?php
  require '../config/db-config.php';
  require '../config/constant-config.php';
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") { 	
    
	if(isset($_POST["update"])){
		$post_name = $_POST["poll_name"];
	    $post_quest = $_POST["poll_question"];
	    $post_option = $_POST["option"];
	    $post_opt = implode(";",$post_option);
		$sql = "UPDATE poll_table 
				SET poll_name = '$post_name', poll_question = '$post_quest', poll_option = '$post_opt'
				WHERE poll_id = $_SESSION[post_id]";

		if ($conn->query($sql) === TRUE) {
			header('Location: '.URL.'post.php?id='.$_SESSION["post_id"], TRUE, 302);
		}
		else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	else if(isset($_POST["back"])){
		header('Location: '.URL.'post.php?id='.$_SESSION["post_id"], TRUE, 302);
	}
	$conn->close();
}
?>