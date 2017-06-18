<?php
require '../config/db-config.php';
require '../config/constant-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username_post = $_POST["username"];
  $password_post = $_POST["password"];

  $sql = "SELECT * FROM user_table WHERE user_name = '$username_post'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if(password_verify($password_post, $row["password"])==1){
      // save user info to session
        session_start();
        $_SESSION["isLoggedIn"] = TRUE;
        $_SESSION["username"] = $row["user_name"];
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["admin"] = $row["privilege"];
        if(isset($_POST["remember"])){
          setcookie('isLoggedIn', $_SESSION["isLoggedIn"], time() + (86400 * 30), "/");
          setcookie('username', $_SESSION["username"], time() + (86400 * 30), "/");
          setcookie('user_id', $_SESSION["user_id"], time() + (86400 * 30), "/");
          setcookie('admin', $_SESSION["admin"], time() + (86400 * 30), "/");
        }
        if(isset($_SESSION["lastPage"])){
          header('Location: '.$_SESSION["lastPage"], TRUE, 302);
        }
        else{
          header('Location: '.URL.'home.php', TRUE, 302);
        }
      }
      else {
        session_start();
        $_SESSION["wrongAlert"] = TRUE;
        header('Location: '.URL.'login.php', TRUE, 302);
      }
    }
  } 
  else {
    session_start();
    $_SESSION["wrongAlert"] = TRUE;
    header('Location: '.URL.'login.php', TRUE, 302);
  }
  $conn->close();
}
?>