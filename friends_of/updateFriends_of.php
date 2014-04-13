<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriends_owner = addslashes($_REQUEST['thisFriends_ownerField']);
	$thisFriend = addslashes($_REQUEST['thisFriendField']);

?>
<?php 
$sql = "UPDATE friends_of SET friendId = '$thisFriendId' , friends_owner = '$thisFriends_owner' , friend = '$thisFriend'  WHERE friendId = '$thisFriendId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>FriendId : </b></td>
	<td><?php echo $thisFriendId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Friends_owner : </b></td>
	<td><?php echo $thisFriends_owner; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Friend : </b></td>
	<td><?php echo $thisFriend; ?></td>
</tr>
</table>
<br><br><a href="listFriends_of.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>