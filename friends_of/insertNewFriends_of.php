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
$sqlQuery = "INSERT INTO friends_of (friendId , friends_owner , friend ) VALUES ('$thisFriendId' , '$thisFriends_owner' , '$thisFriend' )";
$result = MYSQL_QUERY($sqlQuery);

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

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

<?php
include_once("../common/footer.php");
?>