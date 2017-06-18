<?php
  session_start();
  require 'config/db-config.php';
  require 'config/theme-config.php';
  if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE) {
    header('Location: '.'home.php', TRUE, 302);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="script/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="script/jquery/jquery.min.js"></script>
  <script src="script/bootstrap/js/bootstrap.min.js"></script>
  <style>
    <?php if($theme==0){ ?>
    body{
      color: #707070; 
      font-size: 15px;   
    }

    footer{
      background-color: #f2f2f2;
      color: #515151;
      text-align: center;
      padding-top: 10px;
      height: 60px;  
      width:100%;
      margin-top :37px;
      border-style: solid;
      border-color: #cccccc;
      border-width: 1px;
    }
    <?php } else{ ?>
    body{
      color: #aaaaaa;
      background-color: #2b2b2b; 
      font-size: 15px;  
      } 

    footer{
      background-color: #0f0e0e;
      color: #aaaaaa;
      text-align: center;
      padding-top: 10px;
      height: 60px;  
      width:100%;
      margin-top :37px;
      border-style: solid;
      border-color: black;
      border-width: 1px;
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
  
  <div class="container">
    <h1>Register</h1>
    <form method="post" action="processor/register-user.php">
      <div class="row">
        <div class="form-group col-md-5">
          <div class="form-group">
            <label class="control-label" for="username">Username</label> 
            <input class="form-control" id="username" name="username" placeholder="Username" type="text" value="">
            <div class="alert alert-danger alert-dismissable fade in error" id="username_error">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Username</strong> is not valid.
            </div>
            <?php
              if (isset($_SESSION['takenuserAlert']) && $_SESSION['takenuserAlert'] == TRUE) {
            ?>
              <div class="alert alert-danger alert-dismissable fade in" id="username_taken">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Username</strong> already taken.
              </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-5">
          <div class="form-group">
            <label class="control-label" for="email">Email address</label> 
            <input class="form-control" id="email" name="email" placeholder="Email address" type="text" value="">
            <div class="alert alert-danger alert-dismissable fade in error" id="email_error">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Email</strong> is not valid.
            </div>
            <?php
              if (isset($_SESSION['takenemailAlert']) && $_SESSION['takenemailAlert'] == TRUE) {
            ?>
            <div class="alert alert-danger alert-dismissable fade in" id="email_taken">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Email</strong> already taken.
              </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-5">
          <div class="form-group">
            <label class="control-label" for="password">Password</label> 
            <input class="form-control" id="password" name="password" placeholder="Password (Min 9 Char)" type="password" value="">
            <div class="alert alert-danger alert-dismissable fade in error" id="password_error">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Password</strong> and <strong>Confirm Password</strong> didn't match.
            </div> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-5">
          <div class="form-group">
            <label class="control-label" for="password_confirm">Password (confirm)</label> 
            <input class="form-control" id="password_confirm" name="password_confirm" placeholder="Password (confirm)" type="password" value="">
            <div class="alert alert-danger alert-dismissable fade in error" id="cpassword_error">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Password</strong> and <strong>Confirm Password</strong> didn't match.
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <input class="btn btn-primary submit" type="submit" name="Submit" value="Submit">
          &nbsp;
          <input class="btn btn-warning clear" type="button" value="Clear">
        </div>
        <div class="col-md-1">
          
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4">
         Already have an account? Click <a href="login.php">here</a> to login.
        </div>
      </div>
    </form>
  </div>

  <footer>
    <a href="processor/change-theme.php">Change Theme</a><br>
    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017
  </footer>
  
  <?php
    if (isset($_SESSION["takenuserAlert"])){
      unset($_SESSION["takenuserAlert"]);
    }
    if (isset($_SESSION["takenemailAlert"])){
      unset($_SESSION["takenemailAlert"]);
    }
  ?>
  <script>


    function checkUsername(user){
      var userRegex = /^[a-z0-9]+$/i;
      if(!userRegex.test(user)){
        return false;
      }
      else{
        return true;
      }
    }

    function checkEmail(email) {
      var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        
        if (!emailRegex.test(email)) {
        return false;
      }
      else{
        return true;
      }      
    }

    function checkPassword(password, confirmPassword) {
      if (password != confirmPassword) {
        return false;
      }
      else{
        return true;
      }
      
    }

    $(function(){
      $(document).ready(function(){
        $('.error').hide();
        $('.form-control').val('');
      });
    });

    $(function(){
      $('.clear').click(function(){
          $('.error').hide();
          $('.form-control').val('');
        });
    });

    $(function(){
      $('.submit').click(function(event){
        var user = $('#username').val();
        var email = $('#email').val();
        var pass = $('#password').val();
        var cpass =$('#password_confirm').val();
        var allow = false;     
        if($('#password').val().length > 8){
          if(checkUsername(user) == false){
            $('#username_error').show();
          }

          else{
            $('#username_error').hide();
          }

          if(checkEmail(email) == false || email == ""){
            $('#email_error').show();
          }

          else{
            $('#email_error').hide();
          }

          if(checkPassword(pass, cpass) == false || pass == ""){
            $('#password_error').show();
            $('#cpassword_error').show();
          }

          else{
            $('#password_error').hide();
            $('#cpassword_error').hide();
          }

          if(checkUsername(user) == true && checkPassword(pass, cpass) == true && checkEmail(email) == true){
            allow = true;
          }

          if(allow == false){
            event.preventDefault();
          }

          else{
            $('.submit').submit();
          }
        }
        else{
          alert("Password too short! (Min 9 char)");
          $('#password').val('');
          $('#password_confirm').val('');
          event.preventDefault();
        }
      });
    });

  </script>
</body>
</html>
