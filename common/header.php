<?php 
session_start();
function state(){
  $status = session_status();
  switch ($status) {
    case PHP_SESSION_DISABLED:
      echo 'PHP is scompiled with disabled stuff';
      break;
    case PHP_SESSION_NONE:
      echo "no active session";
      break;
    case PHP_SESSION_ACTIVE:
      echo "active session";
      break;
  }   
}
// state();
// var_dump($_SESSION['login_user']);
// die();
if (!isset($_SESSION['login_user'])) {
  // var_dump($_SESSION['login_user']); die();
  header("location: /socialflikx/Flikx/index.php");
}
//one users stuff
function userData($login_user,$db){
  return $db->get_row("select * from user where username = '".$login_user."'");
}
$user = $db->get_row("select * from user where username = '".$_SESSION['login_user']."'");

userData($_SESSION['login_user'],$db);

// dd($user);
$profile = $db->get_row("select * from profile where userId = '".$user->userId."'");
// dd($profile);
$personalPosts = $db->get_results("select * from post where userId = '".$user->userId."' order by date_created");
// dd($personalPosts7;
$usersGroups = $db->get_results("select * from group_table where userId = '".$user->userId."'");
// dd($usersGroups);
$groupsUserIn = $db->get_results("SELECT group_table.group_name FROM group_table JOIN group_members ON group_table.g_id = group_members.g_id WHERE group_members.userID = '".$user->userId."'");
// dd($groupsUserIn);
$allGroups = $db->get_results("select * from group_table");
// dd($allGroups);
//variable  for storing all existing friends
$friends = $db->get_results("select userId,firstname, lastname from profile join friends_of on profile.userId = friends_of.friends_owner where friends_of.friends_owner = '".$user->userId."'");
// dd($friends);
function dd($var){
	echo "<pre>";print_r($var);echo "</pre>";	
	die();
}
function newPostForm($userId){
return '
<form name="postEnterForm" method="POST" action="post/insertNewPost.php">

<div>
	<input type="hidden" name="thisUserIdField" size="20" value="'.$userId.'">
	<div>Title : <input type="text" name="thisTitleField" size="20" value="" style="width:100%;"">  </div> 
	<div>Text body :</div>
	<div><textarea name="thisText_bodyField" style="width:100%; height:100px;" id="thisText_bodyField"></textarea></div>
	<div> <input type="hidden" name="thisDate_createdField" size="20" value="'.date("Y-m-d").'">  </div> 
	<br>
</div>

<input type="submit" name="submit" value="Insert">
<input type="reset" name="resetForm" value="Clear Form">

</form>';

}
function showPanel($name,$item){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.'</h4></div>
	            <div class="panel-body">';
	$v .= 	        $item;
	$v .= '		</div>
			</div>';
	return $v;
}
function showItemsPanel($name,$item,$newItem=null){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.' <span class="pull-right">+</span></h4></div>
	            <div class="panel-body">';
	            $v .= ($newItem) ? $newItem : "" ;
	$v .= 	        $item;
	$v .= '		</div>
			</div>';
	return $v;
}
function showProfile($profile)
{
	$v = '<div class="col-md-4">';
	$v .= '<p>'.$profile->firstname.' '.$profile->lastname.'</p>';
	$v .= '<p>'.$profile->status.'</p>';
	$v .= '<p>'.$profile->email.'</p>';
	$v .= '<p>'.$profile->dob.'</p>';
	$v .= '</div>';
	$v .= '<span class="pull-right"><img src="'.$profile->profile_pic.'" width="100" height="100" /></span>';
	return $v;
}
function relatedData($data)
{
	if (isset($data))
	{
//		dd($data);
                $d = '<ul>';
		foreach ($data as $key => $value) {
			$d .= '<li>'.$key.': '.$value.'</li>';
		}
		$d .= '</ul>';
		
		return $d;
	}
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
        <li><a href="/socialflikx/profile/"><i class="glyphicon glyphicon-th-list"></i> My Profile</a></li>
        <li><a href="/socialflikx/post/"><i class="glyphicon glyphicon-pencil"></i> My Posts</a></li>
        <li><a href="/socialflikx/groups/"><i class="glyphicon glyphicon-link"></i> My Groups</a></li>
        <!-- <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li> -->
      </ul>
      
      <hr>
      
    </div><!-- /span-3 -->
    <div class="col-md-9">
        
      <!-- column 2 --> 

