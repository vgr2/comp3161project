<?php 
session_start();
if (!isset($_SESSION['login_user']){
  header("location: /socialflikx/Flikx/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>SocialFlikx - <?php echo $pageTitle ?></title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" type="text/css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->










        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
            .navbar-static-top {
        margin-bottom:20px;
      }

      i {
        font-size:18px;
      }
        
      footer {
        margin-top:20px;
        padding-top:20px;
        padding-bottom:20px;
        background-color:#efefef;
      }

      .nav>li .count {
        position: absolute;
        bottom: 12px;
        right: 8px;
        font-size: 10px;
        font-weight: normal;
        background: rgba(51,200,51,0.55);
        color: rgba(255,255,255,0.9);
        line-height: 1em;
        padding: 2px 4px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
        border-radius: 10px;
      }
        </style>
    <script type="text/javascript" src="/socialflikx/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea#thisText_bodyField",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        menubar: false,
        statusbar: false,
        relative_urls: false
    });
    </script>        
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body  >
        
        <!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="#">Control Panel</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
            <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['login_user'];?> <span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li><a href="#">My Profile</a></li>
            <li><a href="/socialflikx/flikx/logout.php"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
<!-- upper section -->
  <div class="row">
  <div class="col-md-3">
      <!-- left -->
      <a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> Toolbox</strong></a>

      <ul class="nav nav-pills nav-stacked">
        <li><a href="#"><i class="glyphicon glyphicon-flash"></i> Manage Users</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
      </ul>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="#"><i class="glyphicon glyphicon-th-list"></i> Profile</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Posts</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-link"></i> Groups</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>
      </ul>
      
      <hr>
      
    </div><!-- /span-3 -->
    <div class="col-md-9">
        
      <!-- column 2 --> 

