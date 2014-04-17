<?php
include_once("../common/dbConnection.php");
include_once("../common/setup.php");
?>
<?php
    // Retreiving Form Elements from Form
    $thisG_id = mysql_real_escape_string($_REQUEST['thisG_idField']);
    $thisUser_added = mysql_real_escape_string($_REQUEST['thisUser_addedField']);
    $thisDate_added = mysql_real_escape_string($_REQUEST['thisDate_addedField']);
?>
<?php 
$sqlQuery = "INSERT INTO group_editors ( g_id, user_added , date_added ) VALUES ( '$thisG_id', '$thisUser_added' , '$thisDate_added' )";
$result = $db->query($sqlQuery);
header("Location: ../group_table/viewGroup_table.php?g_idField=".$thisG_id);
?>

<?php
include_once("../common/footer.php");
?>