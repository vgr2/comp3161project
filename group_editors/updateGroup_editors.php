<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = addslashes($_REQUEST['thisG_idField']);
	$thisUser_added = addslashes($_REQUEST['thisUser_addedField']);
	$thisDate_added = addslashes($_REQUEST['thisDate_addedField']);

?>
<?php 
$sql = "UPDATE group_editors SET g_id = '$thisG_id' , user_added = '$thisUser_added' , date_added = '$thisDate_added'  WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>G_id : </b></td>
	<td><?php echo $thisG_id; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>User_added : </b></td>
	<td><?php echo $thisUser_added; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_added : </b></td>
	<td><?php echo $thisDate_added; ?></td>
</tr>
</table>
<br><br><a href="listGroup_editors.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>