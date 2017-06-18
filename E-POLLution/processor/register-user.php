<?php
  require '../config/db-config.php';
  require '../config/constant-config.php';
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	$username_post = $_POST["username"];
  	$email_post = $_POST["email"];
  	$password_post = $_POST["password"];

    $sql = "SELECT * FROM user_table WHERE user_name = '$username_post'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $_SESSION['takenuserAlert'] = TRUE;
      $register = FALSE;
    }
    else{
      unset($_SESSION['takenuserAlert']);
      $register = TRUE;
      $sql = "SELECT * FROM user_table WHERE email = '$email_post'";
      $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            $_SESSION['takenemailAlert'] = TRUE;
            $register = FALSE;
          }
          else{
            unset($_SESSION['takenemailAlert']);
            $register = TRUE;
          }
    }

    if($register === TRUE){
       $password = password_hash($password_post, PASSWORD_DEFAULT) ;
       $sql = "INSERT INTO user_table (user_name, email, password)
               VALUES ('$username_post', '$email_post', '$password')";

       if ($conn->query($sql) === TRUE) {
         session_start();
         $_SESSION['registerAlert'] = TRUE;
         header('Location: '.URL.'home.php', TRUE, 302);
       } 
       else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }
      $conn->close();
    }
    else{
      header('Location: '.URL.'register.php', TRUE, 302);
    }
  }

?>