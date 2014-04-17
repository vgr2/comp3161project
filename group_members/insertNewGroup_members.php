<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
//include_once("../common/header.php");
?>
<?php
    // Retreiving Form Elements from Form
    $thisGroupId = mysql_real_escape_string($_REQUEST['thisGroupIdField']);
    $thisUserId = mysql_real_escape_string($_REQUEST['thisUserIdField']);
    $thisDate_added = mysql_real_escape_string($_REQUEST['thisDate_addedField']);

?>
<?php 
$sqlQuery = "INSERT INTO group_members (g_id, userId , date_added ) VALUES ('$thisGroupId', '$thisUserId' , '$thisDate_added' )";
$result = $db->query($sqlQuery);
//$db->vardump($result);
header("Location: ../index.php");
//exit();
?>

<?php
include_once("../common/footer.php");
?>