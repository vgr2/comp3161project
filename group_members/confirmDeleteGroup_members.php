<?php
include_once("../common/dbConnection.php");
include_once("../common/setup.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField'];
$thisUserId = $_REQUEST['userIdField'];
//$thisG_id = $_REQUEST['g_idField'];
?>
<?php
$sql = "SELECT   * FROM group_members WHERE g_id = '$thisG_id' and userId = '$thisUserId'";
$result = $db->get_row($sql);
$numberOfRows = count($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisG_id = $result->g_id;
	$thisUserId = $result->userId;
	$thisDate_added = $result->date_added;

}
?>

<h2>Confirm Leaving Group</h2><br><br>

<table>
<tr height="30">
	<td><h3><?php echo $name = $db->get_var("select group_name from group_table where g_id = '$thisG_id'") ; ?></h3></td>
</tr>
<!--<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>-->
<tr height="30">
	<td align="right"><b>Date joined : </b></td>
	<td><?php echo $thisDate_added; ?></td>
</tr>
</table>

<h4>If you are sure you want to leave this group, please press the "continue" button below.</h4><br><br>
<form name="group_membersEnterForm" method="POST" action="deleteGroup_members.php">
<input type="hidden" name="thisG_idField" value="<?php echo $thisG_id; ?>">
<input type="hidden" name="thisUserIdField" value="<?php echo $thisUserId; ?>">
<input type="submit" name="submitConfirmDeleteGroup_membersForm" value="Continue">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>