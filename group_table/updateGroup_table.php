<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = addslashes($_REQUEST['thisG_idField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisGroup_name = addslashes($_REQUEST['thisGroup_nameField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

?>
<?php 
$sql = "UPDATE group_table SET g_id = '$thisG_id' , userId = '$thisUserId' , group_name = '$thisGroup_name' , date_created = '$thisDate_created'  WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

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
	<td align="right"><b>Group_name : </b></td>
	<td><?php echo $thisGroup_name; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_created : </b></td>
	<td><?php echo $thisDate_created; ?></td>
</tr>
</table>
<br><br><a href="listGroup_table.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>