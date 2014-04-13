<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);
	$thisType = addslashes($_REQUEST['thisTypeField']);

?>
<?php 
$sql = "UPDATE friend_type SET friend_typeId = '$thisFriend_typeId' , type = '$thisType'  WHERE friend_typeId = '$thisFriend_typeId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>Friend_typeId : </b></td>
	<td><?php echo $thisFriend_typeId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Type : </b></td>
	<td><?php echo $thisType; ?></td>
</tr>
</table>
<br><br><a href="listFriend_type.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>