<?php
  session_start();
  require 'config/db-config.php';
  require 'config/theme-config.php';
  if (isset($_SESSION['isLoggedIn'])){
  }
  else{
    header('Location: '.'login.php', TRUE, 302);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Create Poll</title>
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
      margin-top: 60px;
      height: 60px;    
      bottom:0;
      width:100%;
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
      margin-top: 60px;
      height: 60px;    
      bottom: 0;
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
    <h1>Create Poll</h1><br>
    <form method="post" action="processor/post-poll.php">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="poll_name">Poll Name</label> 
            <input class="form-control" id="poll_name" name="poll_name" placeholder="Poll Name" type="text" value="">
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="poll_type">Poll type</label> 
            <select class="form-control" id="poll_type" name="poll_type"  >
              <option value="">
                [Poll Type]
              </option>
              <option value="0">
                Single
              </option>
              <option value="1">
                Multi
              </option>
            </select>
          </div>
        </div>
      </div> 

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="poll_question">Poll Question</label> 
            <input class="form-control" id="poll_question" name="poll_question" placeholder="Poll Question" type="text" value="">
          </div>
        </div>
      </div>

      <div class ="row">
        <div class="col-md-6" id="option_place">
          <label class="control-label" for="option">Poll Option</label>
          <div class="input-group" id="1">
            <input type="text" class="form-control option" name="option[]" id="option1" placeholder="Option">
            <div class="input-group-btn">
              <button class="btn btn-default delete" type="button" id="delete1">Delete</button>
            </div>
          </div>
          <br id="br1">
          <div class="input-group" id="2">
            <input type="text" class="form-control option" name="option[]" id="option2" placeholder="Option">
            <div class="input-group-btn">
              <button class="btn btn-default delete" type="button" id="delete2">Delete</button>
            </div>
          </div>
          <br id="br2">
          <button class="btn btn-default new" type="button" id="new">New Option</button>
        </div>      
      </div> 
      <br>

      <div class="row">
        <div class="form-group col-md-4">
          <input class="btn btn-primary" type="submit" id="post" value="Post">
          &nbsp;
          <input class="btn btn-warning" type="button" id="reset" value="Reset">
        </div>        
      </div>

    </form>
  </div>

  <footer>
    <a href="processor/change-theme.php">Change Theme</a><br>
    Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017
  </footer>

  <script>
    var count = 2;
    var id = 2;
    $(function(){
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    });

    $(function(){
      $('#new').click(function(){
        count++;
        id++;
        $('<div class="input-group" id="'+id+'">'+
            '<input type="text" class="form-control option" name="option[]" id="option'+id+'" placeholder="Option">'+
            '<div class="input-group-btn">'+
              '<button class="btn btn-default delete" type="button" id="delete'+id+'">Delete</button>'+
            '</div>'+
          '</div>'+
          '<br id="br'+id+'">').insertBefore($('#new'));
      });
    });

    $(function(){
      $('#reset').click(function(){
        location.reload();
      });
    });

    $(function(){
      $(document).on('click', '.delete', function(){
        var id2 = (this.id).replace("delete", "");
        if(count>2){
          $("#"+id2).remove();
          $("#br"+id2).remove();
          count--;
        }
        else{
          alert("Minimum Option is 2")
        }
      });
    });

    $(function(){
      $('#post').click(function(event){   
        var post = true;
        if($('#poll_type').val()==""){
          alert("Please specify Poll Type.");          
          event.preventDefault();
        }
        if($('#poll_name').val()==""){
          alert("Poll Name is empty.");
          event.preventDefault();
        }
        var arr = $(".option");
        var str = "`;`";
        for(var i = 0; i < count; i++){
          if($(arr[i]).val()==""){
           alert("Option "+(i+1)+" has empty option.");
           post = false;
           break;
          }
          else if($(arr[i]).val().indexOf(';') != -1){
            alert('Option '+(i+1)+' contain invalid character.');
            post = false;
            break;
          }
        }
        if(post == false){
           event.preventDefault();
        }
        else{
          if($('#poll_question').val()==""){
            $('#poll_question').val($("#poll_name").val());
          }
          $('#post').submit();
        }
      });
    });

  </script>
</body>
</html>