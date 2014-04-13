<?php
$baseURL = 'http://localhost/socialflikx/';
$dbName = "socialdb";
$pageName = 'profile/';
$tableName = "profile";
$pageTitle = "My Profile";

//include './common/setup.php';

include_once './common/header.php';
include_once './common/VCrud.class.php';

include 'ezsql/ez_sql_core.php';
include 'ezsql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','crunch',$dbName,'localhost');

//print_r($_SESSION);

//one users stuff
$user = $db->get_row("select * from user where userId = '".$_SESSION['userId']."'");
print_r($user);
$profile = $db->get_row("select * from profile where userId = '".$_SESSION['userId']."'");
print_r($profile);
$personalPosts = $db->get_results("select * from posts where userId = '".$_SESSION['userId']."'");
print_r($personalPosts);
$usersGroups = $db->get_results("select * from group_table where userId = '".$_SESSION['userId']."'");
print_r($usersGroups);
$groupsUserIn = $db->get_results("select ");
$allGroups = $db->get_results("select * from group_table");

//variable  for storing all existing friends
$friends = $db->get_results("select userId,firstname, lastname from profile join friends_of on profile.userId = friends_of.friends_owner where friends_of.friends_owner = '".$_SESSION['userId']."'");
print_r($friends);


include_once './common/footer.php';


?>
