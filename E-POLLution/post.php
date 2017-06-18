<?php

  session_start();

  require 'config/db-config.php';

  require 'config/constant-config.php';

  require 'config/theme-config.php';

  $post_id = $_GET["id"];

  $_SESSION["post_id"] = $post_id;

  $sql = "SELECT status FROM poll_table WHERE poll_id = $post_id";

  $rslt = $conn->query($sql);

  $stat = $rslt->fetch_array();

  $status = $stat[0];

  if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1){



  }

  else{

    if($status==2){

      header('Location: '.'index.php', TRUE, 302);

    }

  }



  $sql = "SELECT COUNT(*) FROM comment_table WHERE poll_id = $_GET[id]";

  $comment = $conn->query($sql);

  $totalcomment = $comment->fetch_array();

   

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Browse</title>

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

      border-style: solid;

      border-color: #cccccc;

      border-width: 1px;

    }

    div.progress{

      background-color: #f0f0f0;

    }  



    <?php } else{ ?>

    body{

      color: #aaaaaa;

      background-color: #2b2b2b; 

      font-size: 15px;  

      } 



    footer{

      background-color: #1f1f1f;

      color: #aaaaaa;

      text-align: center;

      padding-top: 10px;

      height: 60px;    

      width:100%;

      border-style: solid;

      border-color: black;

      border-width: 1px;

    }



    .form-control{

      background-color: #2b2b2b;

      border-color: #4f4f4f;

      color: #efefef;

    }

    .panel{

      background-color: #2b2b2b;

      border-color: #4f4f4f;

      color: #efefef;

    }

    .panel-default > .panel-heading {

      background-color: #1f1f1f;

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

    div.progress{

      background-color: #4f4f4f;

    } 

    #comment{

      background-color: #2b2b2b;

    }  

    <?php } ?>

    .modal{

      color: #707070; 

      font-size: 15px;   

    }

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

    .comment-panel{

      margin-left: 5px;

      margin-right: 5px;

      margin-top: 5px;

    }

    textarea{

      resize: none;

    } 

    #report{

      background-color: white;

      color: black;

    }  

    .test{

      background-color: gold;

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

  

  <?php if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]==TRUE){

    

  }

  else{ ?>

    <div class="container">

      <div class="alert alert-danger alert-dismissable fade in">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <p><strong>You haven't logged in!</strong></p>

        <p>You need to <a href="login.php" class="alert-link">login</a> to vote.</p>

      </div>

    </div>

  <?php

  }



  ?>



  <?php

    if (isset($_SESSION['voteAlert']) && $_SESSION['voteAlert'] == TRUE) { ?>

    <div class="container">

      <div class="alert alert-success alert-dismissable fade in">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <p><strong>Vote Success!</strong></p>

      </div>

    </div>

  <?php

    } else if(isset($_SESSION['reportAlert']) && $_SESSION['reportAlert'] == TRUE){ ?>

    <div class="container">

      <div class="alert alert-warning alert-dismissable fade in">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <p><strong>Report Success!</strong></p>

      </div>

    </div>

  <?php } ?>



  <?php

    if ($post_id == "") {

      die("Invalid Request");

    }



    $_SESSION["id"] = $post_id;



    $sql = "SELECT COUNT(*) FROM reportpoll_table WHERE poll_id = $post_id";

    $reportresult = $conn->query($sql);

    $reportpoll = $reportresult->fetch_array();





    $sql = "SELECT COUNT(*) FROM participate_table WHERE poll_id = $post_id";

    $result = $conn->query($sql);

    $participant = $result->fetch_array();



    $sql = "SELECT * FROM poll_table WHERE poll_id = $post_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {





        $sql = "SELECT user_name FROM user_table WHERE user_id = $row[post_by]";

        $result2 = $conn->query($sql);

        $user = $result2->fetch_array();

        $id = 'profile.php?user='.$row["post_by"];



        if($row["type"] == '0'){

          $row["type"] = 'Single';

          }

        else{

          $row["type"] = 'Multi';

        }

        $option = explode(";",$row["poll_option"]);

        $_SESSION["option"] = $option;

        $value = explode(";",$row["value"]);

        $total = array_sum($value);

  ?> 

    <div class="container">

      <form method="post" action="processor/submit.php">

        <div class="panel panel-default">

          <div class="panel-heading clearfix">

            <div class="row header">

              <div class="col-md-11">

                <h3 class="panel-title"><?=$row["poll_name"]?></h3>

              </div>

              <?php if(isset($_SESSION["isLoggedIn"]) && $_SESSION["admin"]==FALSE){ ?>

              <div class="col-md-1 text-right visible-lg">

                <a href="#reportpollModal" data-toggle="modal">Report</a>

              </div>

              <div class="col-md-1 hidden-lg">

                 <a href="#reportpollModal" data-toggle="modal">Report</a>

              </div>



              <div id="reportpollModal" class="modal fade text-center" role="dialog">

                <div class="modal-dialog">

                  <div class="modal-content">

                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                      <h4 class="modal-title">Report Poll</h4>

                    </div>

                    <div class="modal-body">

                       <div class="form-group text-left">

                        <label for="comment">Report reason:</label>

                        <textarea class="form-control" rows="5" id="report" name="reasons"></textarea>

                      </div> 

                    </div>

                    <div class="modal-footer">

                      <button type="submit" name="reportpoll" class="btn btn-danger pull-left">Report</button>

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>

                  </div>

                </div>

              </div>

             <?php } else if(isset($_SESSION["isLoggedIn"]) && $_SESSION["admin"]==TRUE){ ?> 

              <div class="col-md-1 text-right visible-lg">

                Reported:<?=$reportpoll[0]?>

              </div>

              <div class="col-md-1 hidden-lg">

                Reported:<?=$reportpoll[0]?>

              </div>

              <?php } ?>

            </div>

          </div>

          <div class="panel-body">

            <div class="row">

              <div class="col-md-1">

                Post By:

              </div>

              <div class="col-md-5">

                <a href="<?=$id?>"><?=$user[0]?></a>

              </div>

               <div class="col-md-1">

                Participant:

              </div>

              <div class="col-md-5">

                <?=$participant[0]?>

              </div>

            </div>

            <div class="row">

              <div class="col-md-1">

                Post On:

              </div>

              <div class="col-md-5">

                <?=$row["post_date"]?>

              </div>

               <div class="col-md-1">

                Comment:

              </div>

              <div class="col-md-5">

                <?=$totalcomment[0]?>

              </div>

            </div>

            <div class="row">

              <div class="col-md-1">

                Poll Type:

              </div>

              <div class="col-md-5">

                <?=$row["type"]?> Option

              </div>

               <div class="col-md-1">

                Status:

              </div>

              <div class="col-md-5">

                <?php if($status==0){ ?>

                  <font color="green">Open</font>

                <?php } else if($status==1){ ?>

                  <font color="Red">Closed</font>

                <?php } else{ ?>

                  Disabled

                <?php } ?>

              </div>

            </div>

          </div>

        </div>

        <div class="panel panel-default text-center">

          <div class="panel-body" id="poll_section">

            <h2><?=$row["poll_question"]?></h2>

            <hr>

            <?php

              for ($x = 0; $x < count($option); $x++) {

            ?>

            <div class="row text-left prog">

              <div class="col-md-3">

              </div>

              <div class="col-md-9">

                <?php if($row["type"]=='Single'){ ?>

                <div class="radio">

                  <input type="hidden" name="optradio[]" id="<?=$x?>" class="hiddenradio" value="0">

                  <label><input type="radio" name="optradio[]" id="<?=$x?>" class="radiobutton" value="1"><?=$option[$x]?></label>

                </div>

                <?php 

                }

                else{ 

                ?>

                <div class="checkbox">

                  <input type="hidden" name="optradio[]" id="<?=$x?>" class="hiddencheck" value="0">

                  <label><input type="checkbox" name="optradio[]" id="<?=$x?>" class="checkbox" value="1"><?=$option[$x]?></label>

                </div>

                <?php

                  }

                ?>

              </div>

            </div>

            <?php    

              }

            ?>

            <hr> 

            <div class="row">

              <div class="col-md-4">

              <?php 

              if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]==TRUE){

                $sql = "SELECT COUNT(*) FROM participate_table WHERE poll_id = $post_id AND user_id = $_SESSION[user_id]";

                $result4 = $conn->query($sql); 

                $count = $result4->fetch_array();



                $sql = "SELECT vote_on FROM participate_table WHERE poll_id = $post_id AND user_id = $_SESSION[user_id]";

                $result5 = $conn->query($sql);

                $time = $result5->fetch_array();



                if($count[0]>0 || $status == 1 || $status == 2){ ?>

                  <input class="btn btn-primary submit" type="submit" value="Submit" disabled>

              <?php

                }

                else{ ?>

                  <input class="btn btn-primary submit" name="vote" type="submit" value="Submit">

              <?php

                }

              }

              else{

              ?>

                <input class="btn btn-primary submit" type="submit" value="Submit" disabled="disabled">

              <?php

              }

              ?> 

                &nbsp;

                <input class="btn btn-info result" type="button" value="View Result" data-toggle="modal" data-target="#viewModal">



                <div class="modal fade" id="viewModal" role="dialog">

                  <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Poll Result</h4>

                      </div>

                      <div class="modal-body">

                        <?php

                          for ($x = 0; $x < count($option); $x++) {

                            if($value[$x]==0){

                              $percent = 0;

                            }

                            else{

                              $percent = round(($value[$x]/$total)*100);

                            }

                        ?>

                        <div class="row text-left prog">

                          <div class="col-md-1">

                          </div>                

                          <div class="col-md-5 text-center">

                            <?=$option[$x]?>

                          </div>

                          <div class="col-md-3 prog">

                            <div class="progress">

                              <div class="progress-bar" role="progressbar" style="width:<?=$percent?>%">

                                <?=$percent?>%

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3 prog">

                            <?=$value[$x]?> Vote

                          </div>

                        </div>

                        <?php } ?>

                        <br>

                        <div class="row">

                          <div class="col-md-12">

                          Total Vote : <?=$total?>

                          </div>

                        </div>

                      </div>

                      <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>



                <?php if(isset($_SESSION["isLoggedIn"]) && ($_SESSION["admin"]==1)){ ?>

                &nbsp;

                <input class="btn btn-success" type="button" value="Show Voters" data-toggle="modal" data-target="#showModal">

                <div class="modal fade" id="showModal" role="dialog">

                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Voters</h4>
                      </div>

                      <div class="modal-body">

                      <?php $sql = "SELECT user_id FROM participate_table WHERE poll_id = $post_id";

                        $id = $conn->query($sql);

                          if ($id->num_rows > 0) {

                            while($row = $id->fetch_assoc()) {

                              $sql = "SELECT user_name, avatar FROM user_table WHERE user_id = $row[user_id]";

                              $user = $conn->query($sql);

                              if ($user->num_rows > 0) { 

                                while($row2 = $user->fetch_assoc()) {  

                                 ?>

                        <div class="row text-left prog">

                          <div class="col-md-1 text-left">

                          </div>

                          <div class="col-md-9 text-left">

                            <a href="profile.php?user=<?=$row['user_id']?>"><img src="<?=$row2['avatar']?>" class="img-rounded" width="50px"> 

                              <?=$row2["user_name"]?>

                            </a>

                          </div>

                        </div>

                        <?php }}}} ?>

                      </div>

                      <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>



                <?php } ?>

              </div>

              <div class="col-md-4">

              <?php if($status == 1){ ?>

                <p>This poll is already closed.</p>

              <?php } ?>

              <?php if(isset($_SESSION["isLoggedIn"]) && $count[0]>0){ ?>

                You already voted this poll on <?=$time[0]?>

              <?php } else if(isset($_SESSION["isLoggedIn"]) && $count[0]==0){ 

              } else {?>

                You need to login to vote.

              <?php } ?>

              </div>

              <?php 

              if(isset($_SESSION["isLoggedIn"]) && ($_SESSION["admin"]==1) && $status!=2){ ?>

              <div class="col-md-4">

                <input class="btn btn-default" type="submit" name="edit" value="Edit">

                &nbsp;

                <?php if($status == 0){ ?>

                <input class="btn btn-warning" name="close" type="button" value="Close" data-toggle="modal" data-target="#closeModal">



                <div class="modal fade" id="closeModal" role="dialog">

                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Close Poll</h4>

                      </div>

                      <div class="modal-body">

                        <p>Are you sure you want to close this poll?</p>

                      </div>

                      <div class="modal-footer">

                        <button type="submit" class="btn btn-warning pull-left" name="close">Close Poll</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>



                &nbsp;

                <?php } ?>

                <input class="btn btn-danger" type="button" value="Delete" data-toggle="modal" data-target="#deleteModal">



                <div class="modal fade" id="deleteModal" role="dialog">

                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Close Poll</h4>

                      </div>

                      <div class="modal-body">

                        <p>Are you sure you want to delete this poll?</p>

                      </div>

                      <div class="modal-footer">

                        <button type="submit" class="btn btn-danger pull-left" name="delete">Delete Poll</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>



              </div>

              <?php

              } 

              else if(isset($_SESSION["isLoggedIn"]) && $_SESSION["user_id"]==$row["post_by"]){ ?>

              <div class="col-md-4">

              <?php if($status<2){ if($status==0){ ?>

                <input class="btn btn-default" type="submit" name="edit" value="Edit">

                &nbsp;

                <input class="btn btn-warning" type="button" value="Close" data-toggle="modal" data-target="#closeModal">



                <div class="modal fade" id="closeModal" role="dialog">

                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Close Poll</h4>

                      </div>

                      <div class="modal-body">

                        <p>Are you sure you want to close this poll?</p>

                      </div>

                      <div class="modal-footer">

                        <button type="submit" class="btn btn-warning pull-left" name="close">Close Poll</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>

              <?php } if($status==0 || $status==1){ ?>

                &nbsp;

                <input class="btn btn-danger" type="button" value="Delete" data-toggle="modal" data-target="#deleteModal">



                <div class="modal fade" id="deleteModal" role="dialog">

                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Delete Poll</h4>

                      </div>

                      <div class="modal-body">

                        <p>Are you sure you want to delete this poll?</p>

                      </div>

                      <div class="modal-footer">

                        <button type="submit" class="btn btn-danger pull-left" name="delete">Delete Poll</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                      </div>

                    </div>

                  </div>

                </div>

            <?php } } ?>

              </div>    

             <?php  } ?>

            </div>

          </div>

        </div>

        <div class="panel panel-default">

          <div class="panel-heading">

            <h3 class="panel-title">Comments - <?=$totalcomment[0]?></h3>

          </div>

          <?php 

          $sql = "SELECT * FROM comment_table WHERE poll_id = $_GET[id] ORDER BY comment_on ASC";

          $result3 = $conn->query($sql);

          if ($result3->num_rows > 0) {    

            while($row = $result3->fetch_assoc()){



              $user = "profile.php?user=".$row["comment_by"];

              $sql = "SELECT user_name, avatar, privilege FROM user_table WHERE user_id = $row[comment_by]";

              $result6 = $conn->query($sql);

              if ($result6->num_rows > 0) {

                while($row2 = $result6->fetch_assoc()){

          ?>

          <div class="panel panel-default comment-panel">

            <div class="panel-body comment" id="comment<?=$row["comment_id"]?>">

            <?php if($row["status"]==1){ ?>



              <div class="col-md-2">

               <p><a href="<?=$user?>"><?=$row2['user_name']?></a></p>

               <img src="<?=$row2["avatar"]?>" class="img-rounded" width="100px">

              </div>



              <div class="col-md-9">

                <div class="row">

                  <?=$row["comment_on"]?>

                </div>

                <div class="row">

                  <div class="comment-content">

                    <?=$row["comment"]?>

                  </div>

                </div>

              </div>



              <div class="col-md-1 text-right">

                <div>

                 <?php if(isset($_SESSION["isLoggedIn"])){ ?>

                <?php if($_SESSION["admin"]==0){ ?>

                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#reportModal<?=$row["comment_id"]?>">Report</button>

                  <div id="reportModal<?=$row["comment_id"]?>" class="modal fade text-center" role="dialog">

                    <div class="modal-dialog">

                      <div class="modal-content">

                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                          <h4 class="modal-title">Report <a href="<?=$user?>"><?=$row2['user_name']?></a>'s comment?</h4>

                        </div>

                        <div class="modal-body">

                           <div class="form-group text-left">

                            <label for="comment">Report reason:</label>

                            <textarea class="form-control" rows="5" id="report" name="reason<?=$row["comment_id"]?>"></textarea>

                          </div> 

                        </div>

                        <div class="modal-footer">

                          <button type="submit" name="reportcomment" class="btn btn-danger pull-left" value="<?=$row['comment_id']?>">Report</button>

                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                        </div>

                      </div>

                    </div>

                  </div>





                  <?php } else{ ?>

                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#delcomModal<?=$row["comment_id"]?>">Delete</button>

                  <div id="delcomModal<?=$row["comment_id"]?>" class="modal fade text-center" role="dialog">

                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                          <h4 class="modal-title">Delete <a href="<?=$user?>"><?=$row2['user_name']?></a>'s comment?</h4>

                        </div>

                        <div class="modal-body">

                          <p>Are you sure you want to delete this comment?</p>

                        </div>

                        <div class="modal-footer">

                          <button type="submit" name="deletecomment" class="btn btn-danger pull-left" value="<?=$row['comment_id']?>">Delete</button>

                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                        </div>

                      </div>

                    </div>

                  </div>

                  <?php }} ?>



                </div>

              </div>

              <?php } 

                else{ 

                  if(isset($_SESSION["isLoggedIn"]) && $_SESSION["admin"]==1) {?>

                <div class="col-md-2">

                 <p><a href="<?=$user?>"><?=$row2['user_name']?></a></p>

                 <img src="<?=$row2["avatar"]?>" class="img-rounded" width="100px">

                </div>

                <div class="col-md-9">

                  <div class="row">

                    <?=$row["comment_on"]?> <b>[DELETED]</b>

                  </div>

                  <div class="row">

                    <div class="comment-content">

                      <?=$row["comment"]?>

                    </div>

                  </div>

                </div>

              <?php } 

                  else{ ?>

               <i>This comment has been deleted.</i>

              <?php } }?>

            </div>

          </div>

          <?php   

                }

              }

            }

          } 



          if(isset($_SESSION["isLoggedIn"]) && $status==0){ ?>

           <div class="form-group comment-panel">

            <label for="comment">Comment:</label>

            <textarea class="form-control" name="comments" rows="5" id="comment" placeholder="Comment"></textarea>

          </div>

          <div class="row comment-panel">

            <input class="btn btn-success" name="comment" type="submit" value="Submit">

            &nbsp;

            <input class="btn btn-warning" type="button" value="Clear" id="clear">

          </div>

          <br>

          <?php } ?>

        </div>

      </form>

    </div>

  <?php

      }

    }

    else{

  ?>

     <h1>Not Found</h1>

     <?php 

    }

  ?>

    

  <footer>

    <a href="processor/change-theme.php">Change Theme</a><br>

    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017

  </footer>



  <script>

    var view = false;

    $(function(){

      $(document).ready(function(){

        

        if($( "div" ).hasClass( "checkbox" )){

          $('.hiddencheck').attr("disabled", false);

        }

        else{
          $('.hiddenradio').attr("disabled", false);

        }

      });

    });



    $(function(){

      $('.submit').click(function(event){

        if($( "div" ).hasClass( "checkbox" )){

          if($('.checkbox:checked').length > 0){

            $("input:checkbox:checked").each(function(){

              var id = $(this).attr("id");

              $(".hiddencheck").each(function(){

                if($(this).attr("id")==id){

                  $(this).attr("disabled", true);

                }

              });

            });

            $('.submit').submit();

          }

          else{

            event.preventDefault();

            alert("Select at least 1 vote option.")

          }

        }



        else{

          if($('.radiobutton:checked').length > 0){

            $("input:radio:checked").each(function(){

              var id = $(this).attr("id");

              $(".hiddenradio").each(function(){

                if($(this).attr("id")==id){

                  $(this).attr("disabled", true);

                }

              });

            });

            $('.submit').submit();

          }

          else{

            event.preventDefault();

            alert("Select at least 1 vote option.")

          }

        }



      });

    });





    $(function(){

      $('#clear').click(function(){

        $('#comment').val('');

      });

    });

  </script>



  <?php     

    if (isset($_SESSION["voteAlert"])){

      unset($_SESSION["voteAlert"]);

    } 

    if(isset($_SESSION['reportAlert'])){

      unset($_SESSION["reportAlert"]);

    }

  ?>



</body>

</html>