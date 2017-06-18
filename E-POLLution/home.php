<?php

  session_start();

  require 'config/db-config.php';

  require 'config/theme-config.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Home</title>

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

      margin-top: 50px;

      border-style: solid;

      border-color: #cccccc;

      border-width: 1px;  

    }

    .carousel-caption {

    color: #3d3d3d;

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

      margin-top: 50px;

      border-style: solid;

      border-color: black;

      border-width: 1px;

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

      .carousel-caption {

      top: 0;

      bottom: auto;

      }

      div .item{

        padding-left: 80px;

        padding-right: 80px;

      }

      div .table-responsive{

        margin-bottom: 100px;

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



  <?php

  if (isset($_SESSION['registerAlert']) && $_SESSION['registerAlert'] == TRUE) {

  ?>

  <div class="container">

    <div class="alert alert-success alert-dismissable fade in">

      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

      <p><strong>Register Success!</strong></p>

      <p>Please <a href="login.php" class="alert-link">log-in</a> to continue.</p>

    </div>

  </div>

  <?php

  }

  else if(isset($_SESSION['alreadyLogin'])&& $_SESSION['alreadyLogin'] == TRUE){

  ?>

    <div class="container">

      <div class="alert alert-warning alert-dismissable fade in">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <p><strong>You already logged in!</strong></p>

      </div>

    </div>

  <?php  

  }

  ?>



  <div class="container">

    <div class="row text-center">

      <h3>W e l c o m e &nbsp; To</h3>

      <h3><strong>E - P O L L u t i o n</strong></h3>

      A place where you can vote or create your own poll freely!

    </div>

    <hr>

    <?php 

      $sql = "SELECT COUNT(*) FROM poll_table WHERE status!=2";

      $result1 = $conn->query($sql);

      $count1 = $result1->fetch_array(); 



      $sql = "SELECT COUNT(*) FROM user_table";

      $result2 = $conn->query($sql);

      $count2 = $result2->fetch_array(); 

    ?>

    Total Created Poll: <?=$count1[0];?><br>

    Total Registered User: <?=$count2[0];?><br><br>

    <div class="row">

      <div class="col-md-3 hidden-xs">

      </div>

      <div class="col-md-6 hidden-xs text-center">

        <a href="createpost.php"><button type="button" class="btn btn-primary">Create your own Poll now</button></a> &nbsp; or &nbsp; 

        <a href="index.php"><button type="button" class="btn btn-info">Browse existing Poll</button></a>

      </div>

      <div class="col-md-3 hidden-xs">

      </div>

        <div class="col-xs-12 visible-xs text-center">

          <a href="createpost.php"><button type="button" class="btn btn-primary">Create your own Poll now</button></a>

        </div>

        <div class="col-xs-12 visible-xs text-center">

          or

        </div>

        <div class="col-xs-12 visible-xs text-center">

          <a href="index.php"><button type="button" class="btn btn-info">Browse existing Poll</button></a>

        </div>

    </div>

    <br><br><br>



  </div>





  <div class="container text-center">

    <h3><strong>P o l l &nbsp; H i g h l i g h t</strong></h3>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <!-- Indicators -->

      <ol class="carousel-indicators">

        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

        <li data-target="#myCarousel" data-slide-to="1"></li>

        <li data-target="#myCarousel" data-slide-to="2"></li>

      </ol>



      <!-- Wrapper for slides -->

      <div class="carousel-inner">



        <div class="item active">



          <div class="carousel-caption">

            <h4>Top 5 Most Voted Poll</h4>

          </div>

          <br><br><br><br><br>

          <div class="table-responsive">

            <table id="index1" class="tablesorter table table-inverse table-bordered table-hover table-striped">

              <thead>

                <tr>

                  <th class="text-center" style="width:30px;">No</th>

                  <th class="text-center" style="width:auto;">Post By</th>

                  <th class="text-left" style="width:auto;">Poll Name</th>

                  <th class="text-center" style="width:155px;">Post Date</th>

                  <th class="text-center" style="width:30px;">Participant</th>

                  <th class="text-center" style="width:30px;">Type</th>

                  <th class="text-center" style="width:30px;">Comment</th>

                </tr>

              </thead>

              <tbody>

              <?php 

                $sql = "SELECT poll_table.*, (SELECT COUNT(*) FROM comment_table WHERE comment_table.poll_id = poll_table.poll_id) as c,

                        (SELECT COUNT(*) FROM participate_table WHERE participate_table.poll_id = poll_table.poll_id) as p

                        FROM poll_table WHERE poll_table.status=0 ORDER BY p DESC LIMIT 5";

                $result = $conn->query($sql);

                if($result->num_rows > 0){ 

                  $num = 1;

                  while($row = $result->fetch_assoc()) { 



                    $post = 'post.php?id='.$row["poll_id"];

                    $id = 'profile.php?user='.$row["post_by"];



                    $sql = "SELECT user_name FROM user_table WHERE user_id = '$row[post_by]'";

                    $result2 = $conn->query($sql);

                    $user = $result2->fetch_array();



                    if($row["type"] == '0'){

                      $row["type"] = 'Single';

                    }

                    else{

                      $row["type"] = 'Multi';

                    } ?>



                <td class="text-center"><?=$num?></td>

                <td class="text-center"><a href="<?=$id?>"><?=$user[0]?></a></td>

                <td class="text-left"><a href="<?=$post?>"><?=$row["poll_name"]?></a></td>

                <td class="text-center"><?=$row["post_date"]?></td>

                <td class="text-center"><?=$row["p"]?></td>

                <td class="text-center"><?=$row["type"]?></td>

                <td class="text-center"><?=$row["c"]?></td>

              </tbody>



              <?php 

                    $num++;

                  }

                } ?>

            </table>

          </div>

          

        </div>



        <div class="item">

          <div class="carousel-caption">

            <h4>Top 5 Most Commented Poll</h4>

          </div>

          <br><br><br><br><br>

          <div class="table-responsive">

            <table id="index2" class="tablesorter table table-inverse table-bordered table-hover table-striped">

              <thead>

                <tr>

                  <th class="text-center" style="width:30px;">No</th>

                  <th class="text-center" style="width:auto;">Post By</th>

                  <th class="text-left" style="width:auto;">Poll Name</th>

                  <th class="text-center" style="width:155px;">Post Date</th>

                  <th class="text-center" style="width:30px;">Participant</th>

                  <th class="text-center" style="width:30px;">Type</th>

                  <th class="text-center" style="width:30px;">Comment</th>

                </tr>

              </thead>

              <tbody>

              <?php 

                $sql = "SELECT poll_table.*, (SELECT COUNT(*) FROM comment_table WHERE comment_table.poll_id = poll_table.poll_id) as c,

                        (SELECT COUNT(*) FROM participate_table WHERE participate_table.poll_id = poll_table.poll_id) as p

                        FROM poll_table WHERE poll_table.status=0 ORDER BY c DESC LIMIT 5";



                $result = $conn->query($sql);

                if($result->num_rows > 0){ 

                  $num = 1;

                  while($row = $result->fetch_assoc()) { 



                    $post = 'post.php?id='.$row["poll_id"];

                    $id = 'profile.php?user='.$row["post_by"];



                    $sql = "SELECT user_name FROM user_table WHERE user_id = '$row[post_by]'";

                    $result2 = $conn->query($sql);

                    $user = $result2->fetch_array();



                    if($row["type"] == '0'){

                      $row["type"] = 'Single';

                    }

                    else{

                      $row["type"] = 'Multi';

                    } ?>



                <td class="text-center"><?=$num?></td>

                <td class="text-center"><a href="<?=$id?>"><?=$user[0]?></a></td>

                <td class="text-left"><a href="<?=$post?>"><?=$row["poll_name"]?></a></td>

                <td class="text-center"><?=$row["post_date"]?></td>

                <td class="text-center"><?=$row["p"]?></td>

                <td class="text-center"><?=$row["type"]?></td>

                <td class="text-center"><?=$row["c"]?></td>

              </tbody>



              <?php 

                    $num++;

                  }

                } ?>

            </table>

          </div>



        </div>

      

        <div class="item">

          <div class="carousel-caption">

            <h4>Top 5 Most Recent Poll</h4>

          </div>

          <br><br><br><br><br>

          <div class="table-responsive">

            <table id="index3" class="tablesorter table table-inverse table-bordered table-hover table-striped">

              <thead>

                <tr>

                  <th class="text-center" style="width:30px;">No</th>

                  <th class="text-center" style="width:auto;">Post By</th>

                  <th class="text-left" style="width:auto;">Poll Name</th>

                  <th class="text-center" style="width:155px;">Post Date</th>

                  <th class="text-center" style="width:30px;">Participant</th>

                  <th class="text-center" style="width:30px;">Type</th>

                  <th class="text-center" style="width:30px;">Comment</th>

                </tr>

              </thead>

              <?php 

                $sql = "SELECT * FROM poll_table WHERE status=0 ORDER BY post_date DESC LIMIT 5";

                $result = $conn->query($sql);

                if($result->num_rows > 0){ 

                  $num = 1;

                  while($row = $result->fetch_assoc()) { 



                    $post = 'post.php?id='.$row["poll_id"];

                    $id = 'profile.php?user='.$row["post_by"];



                    $sql = "SELECT user_name FROM user_table WHERE user_id = '$row[post_by]'";

                    $result2 = $conn->query($sql);

                    $user = $result2->fetch_array();



                    $sql = "SELECT COUNT(*) FROM participate_table WHERE poll_id = $row[poll_id]";

                    $result3 = $conn->query($sql);

                    $participant  = $result3->fetch_array();



                    $sql = "SELECT COUNT(*) FROM comment_table WHERE poll_id = $row[poll_id]";

                    $result7 = $conn->query($sql);

                    $comment  = $result7->fetch_array();



                    if($row["type"] == '0'){

                      $row["type"] = 'Single';

                    }

                    else{

                      $row["type"] = 'Multi';

                    } ?>



              <tbody>

                <td class="text-center"><?=$num?></td>

                <td class="text-center"><a href="<?=$id?>"><?=$user[0]?></a></td>

                <td class="text-left"><a href="<?=$post?>"><?=$row["poll_name"]?></a></td>

                <td class="text-center"><?=$row["post_date"]?></td>

                <td class="text-center"><?=$participant[0]?></td>

                <td class="text-center"><?=$row["type"]?></td>

                <td class="text-center"><?=$comment[0]?></td>

              </tbody>



              <?php 

                  $num++;

                  }

                } ?>

            </table>

          </div>



      </div>



      <!-- Left and right controls -->

      <a class="left carousel-control" href="#myCarousel" data-slide="prev">

        <span class="glyphicon glyphicon-chevron-left"></span>

        <span class="sr-only">Previous</span>

      </a>

      <a class="right carousel-control" href="#myCarousel" data-slide="next">

        <span class="glyphicon glyphicon-chevron-right"></span>

        <span class="sr-only">Next</span>

      </a>



    </div>

  </div>

  <br><br><br><br>



  <div id="about" class="container text-center">

    <h3><strong> A b o u t &nbsp; U s </strong></h3>

    <br>

    <div class="row">

      <div class="col-sm-4">

        <p class="text-center"><strong>Bobby</strong></p><br>

        <a href="#demo" data-toggle="collapse">

          <img src="image/bobby.jpg" class="img-circle person" width="255" height="255">

        </a>

        <div id="demo" class="collapse">

        <br>

          <p>Bobby Kwariawan</p>

          <p>26415067</p>

        </div>

      </div>

      <div class="col-sm-4">

        <p class="text-center"><strong> Stevanus </strong></p><br>

        <a href="#demo2" data-toggle="collapse">

          <img src="image/nus.jpg" class="img-circle person" width="255" height="255">

        </a>

        <div id="demo2" class="collapse">

          <br>

          <p>Stevanus</p>

          <p>26415071</p>

        </div>

      </div>

      <div class="col-sm-4">

        <p class="text-center"><strong>Yoel</strong></p><br>

        <a href="#demo3" data-toggle="collapse">

          <img src="image/yul.jpg" class="img-circle person" width="255" height="255">

        </a>

        <div id="demo3" class="collapse">

          <br>

          <p>Howard Christopher Yoel Unsong</p>

          <p>26415082</p>

        </div>

      </div>

    </div>

  </div>

  <br><br><br>

  <div id="contact" class="container">

    <h3 class="text-center">Contact</h3>

    <div class="row">

      <div class="col-md-12 text-center">

        <p><span class="glyphicon glyphicon-map-marker"></span>Surabaya, Indonesia</p>

        <p><span class="glyphicon glyphicon-phone"></span>Phone: +62 8123456789</p>

        <p><span class="glyphicon glyphicon-envelope"></span>  Email: mail@mail.com</p>

      </div>

    </div>

  </div>



  </div>



  <footer>

    <a href="processor/change-theme.php">Change Theme</a><br>

    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017

  </footer>



  



  <?php

    if (isset($_SESSION["registerAlert"])){

      unset($_SESSION["registerAlert"]);

    }

    if (isset($_SESSION["alreadyLogin"])){

      unset($_SESSION["alreadyLogin"]);

    }

  ?>

</body>

</html>