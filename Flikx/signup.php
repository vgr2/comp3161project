<?php
session_start();  
include 'config.php';

  
$myusername=mysql_real_escape_string($_POST['username']); 
$mypassword=mysql_real_escape_string($_POST['password']); 
$firstname=mysql_real_escape_string($_POST['firstname']); 
$lastname=mysql_real_escape_string($_POST['lastname']); 
$email=mysql_real_escape_string($_POST['email']); 
$dob=mysql_real_escape_string($_POST['dob']); 


// $userIdGenerator = 'U'.rand(10,10000);
// $userIdG = $userIdGenerator;

$mypassword = hash('ripemd160', $mypassword);

$sql = "INSERT INTO user (username, password) VALUES('$myusername', '$mypassword');"; 
$result=mysql_query($sql) or die("Error 1: ".mysql_error());
$userId = mysql_insert_id();
$sql = "INSERT INTO profile (userId, firstname, lastname, email, dob) VALUES( '$userId', '$firstname', '$lastname', '$email', '$dob');";
$result=mysql_query($sql) or die("Error 2: ".mysql_error());
$result = mysql_query("select username from user where username = '$myusername'");
$row = mysql_fetch_row($result);
$count=count($row);


// If result matched $myusername and $mypassword, table row must be 1 row
if($row)
{
	$_SESSION['login_user']= $myusername;
?>
	<script type="text/javascript">alert('SQL Query Works!');</script>
<?php
	header('Location: ../index.php');
}
else 
{
	$error="Your Login Name or Password is invalid ";
}

?>
