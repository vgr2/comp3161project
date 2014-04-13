<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = addslashes($_REQUEST['thisG_idField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisDate_added = addslashes($_REQUEST['thisDate_addedField']);

?>
<?php 
$sql = "DELETE FROM group_members WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);

?>
Record  has been deleted from database. Here is the deleted record :-<br><br>

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

<?php
include_once("../common/footer.php");
?>