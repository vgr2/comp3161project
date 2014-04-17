<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
?>
<?php
	// Retreiving Form Elements from Form
	$thisFriends_owner = addslashes($_REQUEST['thisFriends_ownerField']);
	$thisFriend = addslashes($_REQUEST['thisFriendField']);

?>
<?php 
$sqlQuery = "INSERT INTO friends_of (friends_owner , friend ) VALUES ( '$thisFriends_owner' , '$thisFriend' )";
$result = $db->query($sqlQuery); 

header("Location: ../index.php");
exit();?>

<?php
include_once("../common/footer.php");
?>