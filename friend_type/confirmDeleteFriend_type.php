<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriend_typeId = $_REQUEST['friend_typeIdField']
?>
<?php
$sql = "SELECT   * FROM friend_type WHERE friend_typeId = '$thisFriend_typeId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
	$thisType = MYSQL_RESULT($result,$i,"type");

}
?>

<h2>Confirm Record Deletion</h2><br><br>

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

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="friend_typeEnterForm" method="POST" action="deleteFriend_type.php">
<input type="hidden" name="thisFriend_typeIdField" value="<?php echo $thisFriend_typeId; ?>">
<input type="submit" name="submitConfirmDeleteFriend_typeForm" value="Delete  from Friend_type">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>