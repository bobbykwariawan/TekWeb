<?php
  session_start();
  require 'config/db-config.php';
  require 'config/theme-config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Profile</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="script/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="script/jquery/jquery.min.js"></script>
  <script src="script/bootstrap/js/bootstrap.min.js"></script>
  <style>

    <?php if($theme==0){ ?>
    body{
      color: #515151; 
      font-size: 15px;   
    }

    footer{
      background-color: #f2f2f2;
      color: #515151;
      text-align: center;
      padding-top: 10px;
      height: 60px;    
      width:100%;
      border-style: solid;
      border-color: #cccccc;
      border-width: 1px;
      margin-top: 50px;
    }
    <?php } else{ ?>
    body{
      color: #aaaaaa; 
      background-color: #2b2b2b; 
      font-size: 15px;  
      } 

    footer{
      background-color:  #1f1f1f;
      color: #aaaaaa;
      text-align: center;
      padding-top: 10px;
      height: 60px;    
      width:100%;
      border-style: solid;
      border-color: black;
      border-width: 1px;
      margin-top: 50px;
    }

    .form-control{
      background-color: #2b2b2b;
      border-color: #4f4f4f;
      color: #efefef;
    }  
    .dropdown-menu{
      background-color:#2b2b2b;;
      border-color: black;
    }
    .dropdown-menu>li>a{
      color: white;
      border-color: black;
    }
    <?php } ?>

    .navbar-static-top{
      font: 20px Montserrat, sans-serif;
      font-size: 15px;
    }
    @media (max-width: 991px) {
      .navbar-header {
        float: none;
      }
      .navbar-toggle {
        display: block;
      }
      .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
      }
      .navbar-collapse.collapse {
        display: none!important;
      }
      .navbar-nav {
        float: none!important;
        margin: 7.5px -15px;
      }
      .navbar-nav>li {
        float: none;
      }
      .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .navbar-text {
        float: none;
        margin: 15px 0;
      }
      .navbar-collapse.collapse.in { 
        display: block!important;
      }
      .collapsing {
        overflow: hidden!important;
      }
    }
    .tab-content{
      margin-top: 10px;
    }
    <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION["user_id"] == $_GET["user"]) { } else{ ?>
    footer{
      bottom:0;
      position:fixed;
    }
    <?php } ?>
   
  </style>
</head>
<body>



  <?php if($theme==0){ ?>
  <nav class="navbar navbar-default navbar-static-top">
  <?php }
  else{ ?>
  <nav class="navbar navbar-inverse navbar-static-top">
  <?php } ?>
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
          <span class="sr-only">Toggle navigation</span> 
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
        <a class="navbar-brand" href="home.php">E-POLLution</a>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav">
          <li>
            <a href="home.php#about"><span class="glyphicon glyphicon-briefcase"></span> About Us</a>
          </li>
          <li>
            <a href="index.php"><span class="glyphicon glyphicon-list"></span> Browse Poll</a>
          </li>
          <?php
            if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE) {
              $mypoll = 'index.php?user='.$_SESSION['user_id'];
              $myprofile = 'profile.php?user='.$_SESSION['user_id'];
          ?>
          <li>
            <a href="createpost.php"><span class="glyphicon glyphicon-plus"></span> Create Poll</a>
          </li>
          <li class="dropdown hidden-lg">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i>  <?php echo $_SESSION["username"]; ?><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if($_SESSION["admin"]==TRUE){ ?>
              <li>
                <a href="userlist.php"><i class="glyphicon glyphicon-user"></i> User List</a>
              </li>
              <li>
                <a href="reportlist.php"><i class="glyphicon glyphicon-list-alt"></i> Report List</a>
              </li>
              <?php } ?>
              <li>
                <a href="<?=$mypoll?>"><i class="glyphicon glyphicon-list"></i> My Poll</a>
              </li>
              <li>
                <a href="<?=$myprofile?>"><i class="glyphicon glyphicon-cog"></i> My Profile</a>
              </li>
              <li>
                <a href="processor/logout-user.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
              </li>
            </ul>
          </li>
          <?php
            }
            else{
          ?>
          <li class="dropdown hidden-lg">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> Guest <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li>
                <a href="login.php"><i class="glyphicon glyphicon-log-in"></i> Login</a>
              </li>
              <li>
                <a href="register.php"><i class="glyphicon glyphicon-pencil"></i> Register</a>
              </li>
            </ul>
          </li>
          <?php
            }
          ?>
        </ul>
        <?php
          if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE) {
        ?>
        <ul class="nav navbar-nav navbar-right visible-lg">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION["username"]; ?>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if($_SESSION["admin"]==TRUE){ ?>
              <li>
                <a href="userlist.php"><i class="glyphicon glyphicon-user"></i> User List</a>
              </li>
              <li>
                <a href="reportlist.php"><i class="glyphicon glyphicon-list-alt"></i> Report List</a>
              </li>
              <?php } ?>
              <li>
                <a href="<?=$mypoll?>"><i class="glyphicon glyphicon-list"></i> My Poll</a>
              </li>
              <li>
                <a href="<?=$myprofile?>"><i class="glyphicon glyphicon-cog"></i> My Profile</a>
              </li>
              <li>
                <a href="processor/logout-user.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <?php
          } 
          else{
        ?>
        <ul class="nav navbar-nav navbar-right visible-lg">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> Guest <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li>
                <a href="login.php"><i class="glyphicon glyphicon-log-in"></i> Login</a>
              </li>
              <li>
                <a href="register.php"><i class="glyphicon glyphicon-pencil"></i> Register</a>
              </li>
            </ul>
          </li>
        </ul>
        <?php
          }
        ?>
        <form action="index.php" class="navbar-form navbar-right form visible-lg" method="get">
          <div class="input-group search-container">
            <input class="form-control search-bar" name="search" placeholder="Search Poll" type="text" value=""> 
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
        <form action="index.php" class="navbar-form form hidden-lg" method="get">
          <div class="input-group search-container">
            <input class="form-control search-bar" name="search" placeholder="Search Poll" type="text" value=""> 
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>

  <?php if (isset($_SESSION['updateAlert']) && $_SESSION['updateAlert'] == TRUE) { ?>

  <div class="container">
    <div class="alert alert-success alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p><strong>Update profile Success!</strong></p>
    </div>
  </div>

  <?php  } else if(isset($_SESSION['wrongAlert']) && $_SESSION['wrongAlert'] == TRUE){ ?>

  <div class="container">
    <div class="alert alert-danger alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p><strong>Wrong Password!</strong></p>
    </div>
  </div>

  <?php } ?>


  <?php 
  $user = $_GET["user"];
  $_SESSION["edit_user"] = $user; 
  $sql = "SELECT * FROM user_table WHERE user_id = $user";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){

      $sql = "SELECT COUNT(*) FROM poll_table WHERE post_by = $row[user_id]";
      $result2 = $conn->query($sql);
      $poll = $result2->fetch_array();

      $sql = "SELECT COUNT(*) FROM comment_table WHERE comment_by = $row[user_id]";
      $result3 = $conn->query($sql);
      $comment = $result3->fetch_array();
      
      $sql = "SELECT COUNT(*) FROM participate_table WHERE user_id = $row[user_id]";
      $result4 = $conn->query($sql);
      $vote = $result4->fetch_array();


      $sql = "SELECT COUNT(*) FROM reportcomment_table WHERE comment_id IN (SELECT comment_id FROM comment_table WHERE comment_by = $row[user_id])";
      $result5 = $conn->query($sql);
      $report = $result5->fetch_array();

      if($row["privilege"]==0){
        $row["privilege"] = 'User';
      }
      else{
        $row["privilege"] = 'Admin';
      } ?>


  <div class="container">
    <h2 style="margin-bottom: 20px;"><strong class="text-default"><?=$row["user_name"]?></strong></h2>
    <h4><a href="index.php?user=<?=$row["user_id"]?>">Browse this user's poll</a></h4>
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-sm-2">
        <img class="avatar" src="<?=$row['avatar']?>" width="150px">
      </div>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-sm-2">User ID:</div>
          <div class="col-sm-10"><?=$row["user_id"]?></div>
          <div class="col-sm-2">User Class:</div>
          <div class="col-sm-10"><?=$row["privilege"]?></div>
          <div class="col-sm-2">User Created on:</div>
          <div class="col-sm-10"><?=$row["create_on"]?></div>
          <div class="col-sm-2">Total Poll:</div>
          <div class="col-sm-10"><?=$poll[0]?></div>
          <div class="col-sm-2">Total Vote:</div>
          <div class="col-sm-10"><?=$vote[0]?></div>
          <div class="col-sm-2">Total Comment:</div>
          <div class="col-sm-10"><?=$comment[0]?></div>
          <?php if(isset($_SESSION["isLoggedIn"]) && $_SESSION["admin"]==TRUE){ ?>
          <div class="col-sm-2">Reported:</div>
          <div class="col-sm-10"><?=$report[0]?></div>
          <?php } ?>
        </div>
      </div>
    </div>

  <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION["user_id"] == $_GET["user"]) { ?>

    <form method="post" action="processor/update-user.php">
      <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="active" role="presentation">
          <a aria-controls="profile" aria-expanded="false" data-toggle="tab" href="#avatar-change" id="avatar-change-tab" role="tab">Avatar</a>
        </li>
        <li role="presentation">
          <a aria-controls="profile" aria-expanded="true" data-toggle="tab" href="#password-change" id="password-change-tab" role="tab">Password</a>
        </li>
      </ul>

      <div class="tab-content">

        <div aria-labelledby="avatar-change-tab" class="tab-pane fade active in" id="avatar-change" role="tabpanel">
          <div class="row">
            <div class="form-group col-md-4">
              <label class="control-label" for="current_avatar">Avatar</label>
              <input class="form-control" id="avatar" name="avatar" placeholder="Place image link here." type="text" value="<?=$row['avatar']?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <input class="btn btn-primary" name="updateavatar" type="submit" value="Update">
            </div>
          </div>
        </div>


        <div aria-labelledby="password-change-tab" class="tab-pane fade" id="password-change" role="tabpanel">
          <div class="row">
            <div class="form-group col-md-4">
              <div class="form-group">
                <label class="control-label" for="current_password">Current Password</label> 
                <input class="form-control" id="current_password" name="currpass" placeholder="Current password" title="" type="password" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <div class="form-group">
                <label class="control-label" for="new_password">New Password</label> 
                <input class="form-control" id="new_password" name="newpass" placeholder="New password (Min 9 char)" type="password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <div class="form-group">
                <label class="control-label" for="password_confirm">Repeat New Password</label> 
                <input class="form-control" id="password_confirm" name="passcon" placeholder="New password (confirm)" type="password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <input class="btn btn-primary" id="update" name="updatepass" type="submit" value="Update">
            </div>
          </div>
        </div>
      </div>
    </form>
    <hr>
  <?php }
    else { 
    } ?>
  </div>

  <?php } 
  } else{
    echo 'No Result';
    }?>

  <footer>
    <a href="processor/change-theme.php">Change Theme</a><br>
    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017
  </footer>

  <?php
    if (isset($_SESSION["updateAlert"])){
      unset($_SESSION["updateAlert"]);
    }
    if (isset($_SESSION["wrongAlert"])){
      unset($_SESSION["wrongAlert"]);
    }
  ?>

  <script>

    $(function(){
      $(document).ready(function(){
        if($('#avatar').val()=='https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg'){
          $('#avatar').val('');
        }
      });
    });
    $(function(){
      $('#update').click(function(event){
        var curpass = $('#current_password').val();
        var newpass = $('#new_password').val();
        var conpass = $('#password_confirm').val();
        if(newpass != conpass){
          alert("Password and Confirm Password didn't match!");
          event.preventDefault();
          $('#new_password').val('');
          $('#password_confirm').val('');
          $('#current_password').val('');
        }
        else if(curpass==''){
          alert("Invalid Current Password!")
          $('#new_password').val('');
          $('#password_confirm').val('');
          $('#current_password').val('');
          event.preventDefault();
        }
        else if(newpass.length < 8 || conpass.length < 8){
          alert("Password too short! (Min 9 char)");
          $('#new_password').val('');
          $('#password_confirm').val('');
          $('#current_password').val('');
          event.preventDefault();
        }
        else if(curpass == newpass){
          alert("Current Password has the same value as New Password!")
          $('#new_password').val('');
          $('#password_confirm').val('');
          $('#current_password').val('');
          event.preventDefault();
        }
        else{
          $('#update').submit();
        }
      });
    });
  </script>
</body>
</html>