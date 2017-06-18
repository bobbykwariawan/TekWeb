<?php
session_start();
require '../config/db-config.php';
require '../config/constant-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_id = $_SESSION["id"];
  if(isset($_POST["vote"])){

    $sql = "SELECT value FROM poll_table WHERE poll_id =  '$post_id'";
    $result = $conn->query($sql);
    $prev_val = $result->fetch_array();

    $prev_val = explode(";",$prev_val[0]);   
    
    $post_val = $_POST["optradio"];

    for($i=0;$i<count($post_val);$i++) {
      $post_val[$i] = $post_val[$i]+$prev_val[$i];
    }

    $post_value = implode(";",$post_val);
    $sql = "SELECT user_id FROM user_table WHERE user_name =  '$_SESSION[username]'";
    $result = $conn->query($sql);
    $user_id = $result->fetch_array();   

    $sql = "UPDATE poll_table 
            SET value = '$post_value'
            WHERE poll_id = '$post_id'";

    $sql2 = "INSERT INTO participate_table (poll_id, user_id) 
            VALUES ('$post_id', '$user_id[0]')";


    if ($conn->query($sql) === TRUE) {
      if ($conn->query($sql2) === TRUE) { 
        $_SESSION["voteAlert"] = TRUE;
        header('Location: '.URL.'post.php?id='.$post_id, TRUE, 302);
      }
      else{
      echo "Error: " . $sql . "<br>" . $conn->error;
      } 
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } 

  else if(isset($_POST["comment"])){
    $comment = $_POST["comments"];
    $sql = "INSERT INTO comment_table (poll_id, comment_by, comment) 
            VALUES  ($post_id, $_SESSION[user_id], '$comment') ";
    if ($conn->query($sql) === TRUE) {
      header('Location: '.URL.'post.php?id='.$post_id, TRUE, 302);
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  else if(isset($_POST["delete"])){
    $sql = "UPDATE poll_table
            SET status = 2
            WHERE poll_id = $post_id"; 
    if ($conn->query($sql) === TRUE) {
      header('Location: '.URL.'index.php', TRUE, 302);
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  else if(isset($_POST["close"])){
    $sql = "UPDATE poll_table
            SET status = 1
            WHERE poll_id = $post_id"; 
    if ($conn->query($sql) === TRUE) {
      header('Location: '.URL.'index.php', TRUE, 302);
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  else if(isset($_POST["edit"])){
    if (isset($_SESSION["post_id"])){
      $_SESSION['edit']=TRUE;
      header('Location: '.URL.'editpost.php', TRUE, 302);
    }
  }

  else if(isset($_POST["deletecomment"])){

    $comment_id = $_POST["deletecomment"];
    $sql = "UPDATE comment_table
            SET status = 0
            WHERE comment_id = $comment_id";
    if ($conn->query($sql) === TRUE) {
      header('Location: '.URL.'post.php?id='.$post_id, TRUE, 302);
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  else if(isset($_POST["reportcomment"])){
    $comment_id = $_POST["reportcomment"];
    $reason = $_POST["reason".$comment_id];
    $sql = "INSERT INTO reportcomment_table (comment_id, report_by, reason)
            VALUES ($comment_id, $_SESSION[user_id], '$reason')";
    if ($conn->query($sql) === TRUE) {
      $_SESSION["reportAlert"]=TRUE;
      header('Location: '.URL.'post.php?id='.$post_id, TRUE, 302);
      }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  else if(isset($_POST["reportpoll"])){
    $reason = $_POST["reasons"];
    $sql = "INSERT INTO reportpoll_table (poll_id, report_by, reason)
            VALUES ($post_id, $_SESSION[user_id], '$reason')";
    if ($conn->query($sql) === TRUE) {
      $_SESSION["reportAlert"]=TRUE;
      header('Location: '.URL.'post.php?id='.$post_id, TRUE, 302);
      }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  $conn->close();
}
?>