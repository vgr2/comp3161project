<?php
include_once("../common/dbConnection.php");
include_once("../common/setup.php");
//include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = mysql_real_escape_string($_REQUEST['thisG_idField']);
	$thisUserId = mysql_real_escape_string($_REQUEST['thisUserIdField']);
	$thisDate_added = mysql_real_escape_string($_REQUEST['thisDate_addedField']);

?>
<?php 
$sql = "DELETE FROM group_members WHERE g_id = '$thisG_id' and userId = '$thisUserId'";
$result = $db->query($sql);
header("Location: ../index.php");
?>

<?php
include_once("../common/footer.php");
?>