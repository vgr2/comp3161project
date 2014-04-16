<?php
include_once("../common/setup.php");
include_once("../common/dbConnection.php");
//include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
        $thisUserId = mysql_real_escape_string($_REQUEST['thisUserIdField']);
	$thisGroup_name = mysql_real_escape_string($_REQUEST['thisGroup_nameField']);
	$thisDate_created = mysql_real_escape_string($_REQUEST['thisDate_createdField']);

?>
<?php 
$sqlQuery = "INSERT INTO group_table ( userId , group_name , date_created ) VALUES ( '$thisUserId' , '$thisGroup_name' , '$thisDate_created' )";
$result = $db->query($sqlQuery);
header("location: ../dashboard.php");
exit();
?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

<?php
include_once("../common/footer.php");
?>