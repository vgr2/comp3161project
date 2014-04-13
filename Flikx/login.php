
<?php
  
include 'config.php';
session_start();

$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

$mypassword = hash('ripemd160', $mypassword);
//echo '<meta http-equiv="refresh" content="0; url=admin.php" >';



$sql="SELECT * FROM user JOIN profile ON profile.userId = user.userId WHERE user.username = '$myusername' AND user.password = '$mypassword'; ";
$result=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_assoc($result);

//echo '<pre>'.print_r($row).'</pre>';die();
// $count=mysql_num_rows($result);


//check if user is admin
$adminsql = "select user.userId from user join admin on user.userId = admin.userId where user.userId = '".$row['userId']."';";
$adminres = mysql_query($adminsql) or die(mysql_error());
$adminrow = mysql_fetch_assoc($adminres);

if ($adminrow) {
  session_register("profile");
  $_SESSION['login_user'] = $row['username'];
  $_SESSION['userId'] = $row['userId'];
  header("location: ".$baseURL."../dashboard.php");
} else 
// If result matched $myusername and $mypassword, table row must be 1 row
if($row){
  session_register("profile");
  $_SESSION['login_user'] = $row['username'];
  header("location: profile.php");
} else {
  $error="Your Login Name or Password is invalid.";
  header("location: index.php?error=".$error);
}

?>