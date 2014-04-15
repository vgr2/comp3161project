<?php
  
include 'config.php';
// include '../common/setup.php';
session_start();

$myusername=mysql_real_escape_string($_POST['username']); 
$mypassword=mysql_real_escape_string($_POST['password']); 

$mypassword = hash('ripemd160', $mypassword);
//echo '<meta http-equiv="refresh" content="0; url=admin.php" >';


$sql=sprintf("SELECT * FROM user JOIN profile ON profile.userId = user.userId WHERE user.username = '%s' AND user.password = '%s' ", $myusername, $mypassword);
$result=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_assoc($result);

//echo '<pre>'.print_r($row).'</pre>';die();
// $count=mysql_num_rows($result);


//check if user is admin
$adminsql = "select user.userId from user join admin on user.userId = admin.userId where user.userId = '".$row['userId']."';";
$adminres = mysql_query($adminsql) or die(mysql_error());
$adminrow = mysql_fetch_assoc($adminres);

// if ($adminrow) {
//   // session_register("profile");
//   $_SESSION['login_user'] = $row['username'];
//   $_SESSION['userId'] = $row['userId'];
//   header("location: ".$baseURL."../dashboard.php");
// } else 
// If result matched $myusername and $mypassword, table row must be 1 row
if($row){
  $_SESSION['login_user'] = $row['username'];
  // print_r($_SESSION); die();
  header("location: ../dashboard.php");
} else {
  $error="Your Login Name or Password is invalid.";
  header("location: index.php?error=".$error);
}

?>