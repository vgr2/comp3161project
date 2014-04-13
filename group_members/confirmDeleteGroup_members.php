<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_members WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisG_id = MYSQL_RESULT($result,$i,"g_id");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisDate_added = MYSQL_RESULT($result,$i,"date_added");

}
?>

<h2>Confirm Record Deletion</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>G_id : </b></td>
	<td><?php echo $thisG_id; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_added : </b></td>
	<td><?php echo $thisDate_added; ?></td>
</tr>
</table>

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="group_membersEnterForm" method="POST" action="deleteGroup_members.php">
<input type="hidden" name="thisG_idField" value="<?php echo $thisG_id; ?>">
<input type="submit" name="submitConfirmDeleteGroup_membersForm" value="Delete  from Group_members">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>