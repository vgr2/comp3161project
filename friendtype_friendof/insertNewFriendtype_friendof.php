<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisFriendtype_friendofId = addslashes($_REQUEST['thisFriendtype_friendofIdField']);
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);

?>
<?php 
$sqlQuery = "INSERT INTO friendtype_friendof (friendtype_friendofId , friendId , friend_typeId ) VALUES ('$thisFriendtype_friendofId' , '$thisFriendId' , '$thisFriend_typeId' )";
$result = MYSQL_QUERY($sqlQuery);

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>Friendtype_friendofId : </b></td>
	<td><?php echo $thisFriendtype_friendofId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>FriendId : </b></td>
	<td><?php echo $thisFriendId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Friend_typeId : </b></td>
	<td><?php echo $thisFriend_typeId; ?></td>
</tr>
</table>

<?php
include_once("../common/footer.php");
?>