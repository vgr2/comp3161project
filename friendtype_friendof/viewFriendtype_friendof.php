<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriendtype_friendofId = $_REQUEST['friendtype_friendofIdField']
?>
<?php
$sql = "SELECT   * FROM friendtype_friendof WHERE friendtype_friendofId = '$thisFriendtype_friendofId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriendtype_friendofId = MYSQL_RESULT($result,$i,"friendtype_friendofId");
	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");

}
?>

View Record<br><br>

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