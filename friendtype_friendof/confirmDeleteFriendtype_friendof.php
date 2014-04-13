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

<h2>Confirm Record Deletion</h2><br><br>

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

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="friendtype_friendofEnterForm" method="POST" action="deleteFriendtype_friendof.php">
<input type="hidden" name="thisFriendtype_friendofIdField" value="<?php echo $thisFriendtype_friendofId; ?>">
<input type="submit" name="submitConfirmDeleteFriendtype_friendofForm" value="Delete  from Friendtype_friendof">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>