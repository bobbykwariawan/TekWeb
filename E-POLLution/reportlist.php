<?php
  session_start();
  require 'config/db-config.php';
  require 'config/constant-config.php';
  require 'config/theme-config.php';
  if(isset($_SESSION['isLoggedIn'])){
    if($_SESSION["admin"]==TRUE){

    }
    else{
      header('Location: '.URL.'home.php', TRUE, 302);
    }
  }
  else{
    header('Location: '.URL.'home.php', TRUE, 302);
  }
  if(!isset($_GET["page"])){
    $_GET["page"]=1;
  }
  if(!isset($_GET["category"])){
    $_GET["category"]=0;
  }
  $next = $_GET["page"] + 1;
  $prev = $_GET["page"] - 1;
  $min = $_GET["page"]*9-9;
  $max = 9;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Report List</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="script/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="script/jquery/jquery.min.js"></script>
  <script src="script/bootstrap/js/bootstrap.min.js"></script> 
  <script src="script/jquery/jquery-latest.js"></script> 
  <script src="script/jquery/jquery.tablesorter.js"></script> 
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
      bottom:0;
      position:fixed;
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
      background-color:  #1f1f1f;
      color: #aaaaaa;
      text-align: center;
      padding-top: 10px;
      height: 60px;    
      width:100%;
      bottom:0;
      position:fixed;
      border-style: solid;
      border-color: black;
      border-width: 1px;
      margin-top: : 100px;
    }

    .form-control{
      background-color: #2b2b2b;
      border-color: #4f4f4f;
      color: #efefef;
    }
    .table ,.table-striped > thead > tr:nth-child(odd) > th, .table-striped > tbody > tr:nth-child(even) > td, .table-striped > tbody > tr:nth-child(even) > th {
      border-color: #4f4f4f;
      background-color: #222222;
    }
    .table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th {
      border-color: #4f4f4f;
      background-color: #2b2b2b;
    }
    .dropdown-menu{
      background-color:#2b2b2b;;
      border-color: black;
    }
    .dropdown-menu>li>a{
      color: white;
      border-color: black;
    }
    .navbar>ul>li{
      color:white;
    }
    .pagination>li>a {
      background-color: #2b2b2b;
      color: #fff;
      border-color: #0f0e0e;
    }
    .pagination li.disabled a{
      background-color: #2b2b2b;
      color: #fff;
      border-color: #0f0e0e;
    }
    .pagination li.disabled a{
      background-color: #2b2b2b;
      color: #fff;
      border-color: #0f0e0e;
    }
    .pagination li:hover.disabled a{
      background-color: #2b2b2b;
      color: #fff;
      border-color: #0f0e0e;
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
    <form method="get" action="reportlist.php">
      <div class="btn-group">
        <?php if($_GET["category"]==0){ ?> 
        <button type="submit" name="category" value="0" class="btn btn-primary" disabled>Poll</button>
        <button type="submit" name="category" value="1" class="btn btn-primary">Comment</button>
        <?php } else{ ?>
        <button type="submit" name="category" value="0" class="btn btn-primary">Poll</button>
        <button type="submit" name="category" value="1" class="btn btn-primary" disabled>Comment</button>
        <?php } ?>
      </div>
    </form> 
    <br>
    <div class="table-responsive">
      <table id="index" class="tablesorter table table-inverse table-bordered table-hover table-striped">
          <?php
            if(isset($_GET["category"]) && $_GET["category"]=="0"){
          ?>
          <thead>
          <tr>
            <th class="text-center" style="width:30px;">No</th>
            <th class="text-center" style="width:150px;">Report By</th>
            <th class="text-left" style="width:auto;">Poll Name</th>
            <th class="text-left" style="width:auto;">Reason</th>
            <th class="text-center" style="width:155px;">Report Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $sql = "SELECT COUNT(*) FROM reportpoll_table";
              $resultz = $conn->query($sql);
              $resultzz = $resultz->fetch_array();
              $count = ceil($resultzz[0]/9);

              $sql = "SELECT * FROM reportpoll_table ORDER BY report_date DESC LIMIT $min, $max";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                $num = 1 * $min + 1;
                while($row = $result->fetch_assoc()) {
                  $id = 'profile.php?user='.$row["report_by"];
                  $post = 'post.php?id='.$row["poll_id"];

                  $sql = "SELECT user_name FROM user_table WHERE user_id = '$row[report_by]'";
                  $result2 = $conn->query($sql);
                  $user = $result2->fetch_array();

                  $sql = "SELECT poll_name FROM poll_table WHERE poll_id = '$row[poll_id]'";
                  $result3 = $conn->query($sql);
                  $poll = $result3->fetch_array();

          ?>
          <tr>
            <td class="text-center"><?=$num?></td>
            <td class="text-center"><a href="<?=$id?>"><?=$user[0]?></a></td>
            <td class="text-left"><a href="<?=$post?>"><?=$poll[0]?></a></td>
            <td class="text-left"><?=$row["reason"]?></td>
            <td class="text-center"><?=$row["report_date"]?></td>

          </tr>
          <?php 
                $num++;
                } 
              }
              else {
                echo "Not Found";
              }
              $conn->close();
            }
            else if(isset($_GET["category"]) && $_GET["category"] == "1"){ ?>

        <thead>
          <tr>
            <th class="text-center" style="width:30px;">No</th>
            <th class="text-center" style="width:150px;">Report By</th>
            <th class="text-center" style="width:150px;">Report On</th>
            <th class="text-left" style="width:auto;">Comment</th>
            <th class="text-left" style="width:auto;">Reason</th>
            <th class="text-center" style="width:155px;">Report Date</th>
          </tr>
        </thead>
        <tbody> 

          <?php
              $sql = "SELECT COUNT(*) FROM reportcomment_table";
              $resultz = $conn->query($sql);
              $resultzz = $resultz->fetch_array();
              $count = ceil($resultzz[0]/9);

              $sql = "SELECT * FROM reportcomment_table ORDER BY report_date DESC LIMIT $min, $max";
              $result = $conn->query($sql);
              
              if ($result->num_rows > 0) {
                $num = 1 * $min + 1;
                while($row = $result->fetch_assoc()) {
                  $sql = "SELECT user_id, user_name 
                          FROM user_table 
                          WHERE user_id = (SELECT comment_by 
                                           FROM comment_table 
                                           WHERE comment_id = (SELECT comment_id 
                                                               FROM reportcomment_table 
                                                               WHERE report_id = $row[report_id]))";
                  $results = $conn->query($sql);
                  $user1 = $results->fetch_array();

                  $id = 'profile.php?user='.$row["report_by"];
                  $id1 = 'profile.php?user='.$user1[0];

                  $sql = "SELECT user_name FROM user_table WHERE user_id = '$row[report_by]'";
                  $result2 = $conn->query($sql);
                  $user = $result2->fetch_array();

                  $sql = "SELECT poll_id,comment FROM comment_table WHERE comment_id = '$row[comment_id]'";
                  $result3 = $conn->query($sql);
                  $comment = $result3->fetch_array();

                  $commenturl = "post.php?id=".$comment[0]."#comment".$row["comment_id"];


          ?>
          <tr>
            <td class="text-center"><?=$num?></td>
            <td class="text-center"><a href="<?=$id?>"><?=$user[0]?></a></td>
            <td class="text-center"><a href="<?=$id1?>"><?=$user1[1]?></a></td>
            <td class="text-left"><a href="<?=$commenturl?>"><?=$comment[1]?></a></td>
            <td class="text-left"><?=$row["reason"]?></td>
            <td class="text-center"><?=$row["report_date"]?></td>

          </tr>

          <?php
                $num++;
                }
              }
            } 
          ?>
        </tbody>
      </table>
    </div>

    <div class="text-center">
      <nav>
        <ul class="pagination">
          <?php if($_GET["page"]==1){ ?>
          <li class="disabled">
            <a>&laquo;</a>
          </li>
          <?php } else{ ?>
          <li>
            <a href="<?='reportlist.php?category='.$_GET['category'].'&page='.$prev?>" name="<?=$prev?>">&laquo;</a>
          </li>
          <?php } ?>

          <?php for($x = 0; $x<$count; $x++){
            if($_GET["page"] == $x+1){?>

          <li class="active">
            <a name="<?=($x+1)?>"><?=($x+1)?><span class="sr-only">(current)</span></a>
            <?php } else{ ?>

          <li>
            <a name="<?=($x+1)?>" href="<?='reportlist.php?category='.$_GET['category'].'&page='.($x+1)?>"><?=($x+1)?><span class="sr-only">(current)</span></a>
            <?php } ?>
            
          </li>
          <?php } ?>

          <?php if($_GET["page"]==$count || $count==0){ ?>
          <li class="disabled">
            <a>&raquo;</a>
          </li>
          <?php } else{ ?>
          <li>
            <a href="<?='reportlist.php?category='.$_GET['category'].'&page='.$next?>" name="<?=$next?>">&raquo;</a>
          </li>
          <?php } ?>
        </ul>

      </nav>
    </div>

  </div>

  <footer>
    <a href="processor/change-theme.php">Change Theme</a><br>
    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017
  </footer>

  <script>
    $(document).ready(function(){ 
          $("#index").tablesorter(); 
      } 
    ); 
  </script>

</body>
</html>