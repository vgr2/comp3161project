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
$sql = "UPDATE group_members SET g_id = '$thisG_id' , userId = '$thisUserId' , date_added = '$thisDate_added'  WHERE g_id = '$thisG_id'";
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
	<td align="right"><b>Date_added : </b></td>
	<td><?php echo $thisDate_added; ?></td>
</tr>
</table>
<br><br><a href="listGroup_members.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>