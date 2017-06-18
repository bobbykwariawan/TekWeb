<?php
session_start();
require '../config/db-config.php';
require '../config/constant-config.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_name = $_POST["poll_name"];
    $post_quest = $_POST["poll_question"];
    $post_option = $_POST["option"];
    $post_type = $_POST["poll_type"];
    $post_by = $_SESSION["user_id"];
    $post_value = array_fill_keys($post_option, 0);

    $post_val = implode(";",$post_value);
    $post_opt = implode(";",$post_option);

    $sql = "INSERT INTO poll_table (poll_name, poll_question, poll_option, value, type, post_by) 
            VALUES ('$post_name', '$post_quest', '$post_opt', '$post_val', '$post_type', '$post_by')";

    if ($conn->query($sql) === TRUE) {
      header('Location: '.URL.'index.php', TRUE, 302);
    } 
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }     
  }
  $conn->close();
?>