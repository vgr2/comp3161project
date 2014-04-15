<?php
include_once '../common/setup.php';
?>
<?php
	// Retreiving Form Elements from Form
	$thisPostId = mysql_real_escape_string($_POST['thisPostIdField']);
	$thisUserId = mysql_real_escape_string($_POST['thisUserIdField']);
	$thisTitle = mysql_real_escape_string($_POST['thisTitleField']);
	$thisPost_type = mysql_real_escape_string($_POST['thisPost_typeField']);
	$thisImage_path = mysql_real_escape_string($_POST['thisImage_pathField']);
	$thisText_body = mysql_real_escape_string($_POST['thisText_bodyField']);
	$thisDate_created = mysql_real_escape_string($_POST['thisDate_createdField']);

?>
<?php 
$sql = "INSERT INTO post (postId , userId , title , post_type , image_path , text_body , date_created ) VALUES ('$thisPostId' , '$thisUserId' , '$thisTitle' , '$thisPost_type' , '$thisImage_path' , '$thisText_body' , '$thisDate_created' )";
$result = $db->query($sql);

header("Location: ../dashboard.php");
?>