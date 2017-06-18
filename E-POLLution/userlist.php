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

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>User List</title>

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

    <div class="table-responsive">

      <table id="index" class="tablesorter table table-inverse table-bordered table-hover table-striped">

        <thead>

          <tr>

            <th class="text-center" style="width:50px;">ID</th>

            <th class="text-center" style="width:150px;">Username</th>

            <th class="text-center" style="width:150px;">Email</th>

            <th class="text-center" style="width:50px;">Poll</th>

            <th class="text-center" style="width:50px;">Vote</th>

            <th class="text-center" style="width:50px;">Comment</th>

            <th class="text-center" style="width:50px;">Report</th>

            <th class="text-center" style="width:155px;">Created On</th>

          </tr>

        </thead>

        <tbody> 

          <?php              

              $next = $_GET["page"] + 1;

              $prev = $_GET["page"] - 1;

              $min = $_GET["page"]*10-10;

              $max = 10;



              $sql = "SELECT COUNT(*) FROM user_table";

              $results = $conn->query($sql);

              $resultz = $results->fetch_array();

              $count = ceil($resultz[0]/10);



              $sql = "SELECT * FROM user_table ORDER BY user_id ASC LIMIT $min, $max";

              $result = $conn->query($sql);



              if ($result->num_rows > 0) {

                $num = 1 * $min + 1;

                while($row = $result->fetch_assoc()) {

                  $id = 'profile.php?user='.$row["user_id"];



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

          ?>

          <tr>

            <td class="text-center"><?=$row['user_id']?></td>

            <td class="text-center"><a href="<?=$id?>"><?=$row['user_name']?></a></td>

            <td class="text-center"><?=$row["email"]?></td>

            <td class="text-center"><?=$poll[0]?></td>

            <td class="text-center"><?=$vote[0]?></td>

            <td class="text-center"><?=$comment[0]?></td>

            <td class="text-center"><?=$report[0]?></td>

            <td class="text-center"><?=$row["create_on"]?></td>

          </tr>

          <?php 

                }

              } ?>

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

            <a href="<?='userlist.php?page='.$prev?>" name="<?=$prev?>">&laquo;</a>

          </li>

          <?php } ?>



          <?php for($x = 0; $x<$count; $x++){

            if($_GET["page"] == $x+1){?>



          <li class="active">

            <a name="<?=($x+1)?>"><?=($x+1)?><span class="sr-only">(current)</span></a>

            <?php } else{ ?>



          <li>

            <a name="<?=($x+1)?>" href="<?='userlist.php?page='.($x+1)?>"><?=($x+1)?><span class="sr-only">(current)</span></a>

            <?php } ?>

            

          </li>

          <?php } ?>



          <?php if($_GET["page"]==$count || $count==0){ ?>

          <li class="disabled">

            <a>&raquo;</a>

          </li>

          <?php } else{ ?>

          <li>

            <a href="<?='userlist.php?page='.$next?>" name="<?=$next?>">&raquo;</a>

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